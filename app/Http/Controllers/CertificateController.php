<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use App\Http\Requests;
use App\X509;
use App\Http\Controllers\X509Controller;



class CertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $user = \Auth::user();
      $certificates = Certificate::where('user_id', $user->id)->get();
      return view('certificate.list')->with('certificates', $certificates);
    }

    public function warning()
    {
      $user = \Auth::user();
      $certificates = Certificate::where('user_id', $user->id)->whereBetween('daysleft', [30, 90])->get();
      return view('certificate.warning')->with('certificates', $certificates);
    }

    public function danger()
    {
      $user = \Auth::user();
      $certificates = Certificate::where('user_id', $user->id)->where('daysleft', '<', '30')->get();
      return view('certificate.danger')->with('certificates', $certificates);
    }

    public function create()
    {
      return view('certificate.create');
    }

    public function store(Request $request)
    {
      $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE, 'verify_peer' => false, 'verify_peer_name' => false)));
      stream_socket_client("ssl://".$request->get('fqdn').":".$request->get('port'), $errno, $errstr, 10, STREAM_CLIENT_ASYNC_CONNECT, $get);
      // Save input into certificates table //
      $certificate = new certificate([
          'fqdn' => $request->get('fqdn'),
          'port' => $request->get('port'),
          'memo' => $request->get('memo'),
      ]);
      $user = \Auth::user();
      $certificate->user()->associate($user->id);
      $certificate->save();
      // Save input into x509s table //
      $x509 = X509::firstOrNew([
          'fqdn' => $request->get('fqdn'),
          'port' => $request->get('port'),
      ]);
      $x509->save();
      CertificateController::parse_store($request->get('fqdn'), $request->get('port'));

      \Log::info('Certificate stored successfully',
          ['user-id'=> $user->id, 'certificate-id'=>$certificate->id]
      );
      return redirect('/list')->with('message', 'Certificate for ' . $certificate->fqdn . ' has been created.');
    }

    public function show($id)
    {
      $certificate = Certificate::findOrFail($id);
      $certificatedetail = X509::where('fqdn', $certificate->fqdn)->first();
      if($certificatedetail == null) {
        abort(404, $id . ' Cannot find model.');
      }
      return view('certificate.detail')->with('certificatedetail', $certificatedetail);
    }

    public function edit($id)
    {
      $certificate = Certificate::findOrFail($id);
      return view('certificate.edit')->with('certificate', $certificate);
    }

    public function update(Request $request, $id)
    {
      $certificate = Certificate::findOrFail($id);
      $certificate->update([
      'fqdn' => $request->get('fqdn'),
      'port' => $request->get('port'),
      'memo' => $request->get('memo'),
      ]);
      CertificateController::parse_store($request->get('fqdn'), $request->get('port'));
      return redirect('/list')->with('message', 'Certificate for ' . $certificate->fqdn . ' has been modified.');
    }

    public function destroy($id)
    {
      $certificate = Certificate::findOrFail($id);
      $certificate->delete();
      return redirect('/list')->with('message', 'Certificate for ' . $certificate->fqdn . ' has been deleted.');
    }

    public static function parse_store($fqdn, $port)
    {
      $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE, 'verify_peer' => false, 'verify_peer_name' => false)));
      $read = stream_socket_client("ssl://".$fqdn.":".$port, $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $get);
      $cert = stream_context_get_params($read);
      // Parse Certificate and make it array //
      $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
      // Array multi dimension into one dimension, by dot //
      $certinfo = array_dot($certinfo);
      // Input NULL if Index not exist //
      $keys = array_keys($certinfo);
      $desired_keys = array(
        'name',
        'subject.C',
        'subject.ST',
        'subject.L',
        'subject.O',
        'subject.CN',
        'hash',
        'issuer.C',
        'issuer.O',
        'issuer.CN',
        'version',
        'serialNumber',
        'validFrom',
        'validTo',
        'validFrom_time_t',
        'validTo_time_t',
        'signatureTypeSN',
        'signatureTypeLN',
        'signatureTypeNID',
        'extensions.extendedKeyUsage',
        'extensions.subjectAltName',
        'extensions.keyUsage',
        'extensions.authorityInfoAccess',
        'extensions.subjectKeyIdentifier',
        'extensions.basicConstraints',
        'extensions.authorityKeyIdentifier',
        'extensions.certificatePolicies',
        'extensions.crlDistributionPoints'
      );
      foreach($desired_keys as $desired_key){
         if(in_array($desired_key, $keys)) continue;  // already set
         $certinfo[$desired_key] = '';
      }
      // Calculate Certifiace valid date //
      $today = time();
      $validTo_time_t = date($certinfo['validTo_time_t']);
      $difference = $validTo_time_t - $today;
      $daysleft = floor($difference / (60*60*24));

        X509::where('fqdn', $fqdn)
        ->update([
          'daysleft' => $daysleft,
          'name' => $certinfo['name'],
          'subject_C' => $certinfo['subject.C'],
          'subject_ST' => $certinfo['subject.ST'],
          'subject_L' => $certinfo['subject.L'],
          'subject_O' => $certinfo['subject.O'],
          'subject_CN' => $certinfo['subject.CN'],
          'hash' => $certinfo['hash'],
          'issuer_C' => $certinfo['issuer.C'],
          'issuer_O' => $certinfo['issuer.O'],
          'issuer_CN' => $certinfo['issuer.CN'],
          'version' => $certinfo['version'],
          'serialNumber' => $certinfo['serialNumber'],
          'validFrom' => $certinfo['validFrom'],
          'validTo' => $certinfo['validTo'],
          'validFrom_time_t' => $certinfo['validFrom_time_t'],
          'validTo_time_t' => $certinfo['validTo_time_t'],
          'signatureTypeSN' => $certinfo['signatureTypeSN'],
          'signatureTypeLN' => $certinfo['signatureTypeSN'],
          'signatureTypeNID' => $certinfo['signatureTypeNID'],
          'extensions_extendedKeyUsage' => $certinfo['extensions.extendedKeyUsage'],
          'extensions_subjectAltName' => $certinfo['extensions.subjectAltName'],
          'extensions_keyUsage' => $certinfo['extensions.keyUsage'],
          'extensions_authorityInfoAccess' => $certinfo['extensions.authorityInfoAccess'],
          'extensions_subjectKeyIdentifier' => $certinfo['extensions.subjectKeyIdentifier'],
          'extensions_basicConstraints' => $certinfo['extensions.basicConstraints'],
          'extensions_authorityKeyIdentifier' => $certinfo['extensions.authorityKeyIdentifier'],
          'extensions_certificatePolicies' => $certinfo['extensions.certificatePolicies'],
          'extensions_crlDistributionPoints' => $certinfo['extensions.crlDistributionPoints'],
        ]);

        Certificate::where('fqdn', $fqdn)
          ->update([
            'daysleft' => $daysleft,
        ]);
      return redirect('/list');
    }
}
