<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use App\Http\Requests;
use App\X509;



class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $user = \Auth::user();    // 1
      $certificates = Certificate::where('user_id', $user->id)->get();    // 2
      return view('certificate.list')->with('certificates', $certificates);    // 3
    }

    public function warning()
    {
      $user = \Auth::user();    // 1
      $certificates = Certificate::where('user_id', $user->id)->whereBetween('daysleft', [30, 90])->get();    // 2
      return view('certificate.warning')->with('certificates', $certificates);    // 3
    }

    public function danger()
    {
      $user = \Auth::user();    // 1
      $certificates = Certificate::where('user_id', $user->id)->where('daysleft', '<', '30')->get();    // 2
      return view('certificate.danger')->with('certificates', $certificates);    // 3
    }

    public function create()
    {
      return view('certificate.create');
    }

    public function store(Request $request)
    {
        $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE, 'verify_peer' => false, 'verify_peer_name' => false)));
        stream_socket_client("ssl://".$request->get('fqdn').":".$request->get('port'), $errno, $errstr, 15, STREAM_CLIENT_ASYNC_CONNECT, $get);
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

        \Log::info('Certificate 등록 성공',
            ['user-id'=> $user->id, 'certificate-id'=>$certificate->id]
        );
        return redirect('/list')->with('message', 'Certificate for ' . $certificate->fqdn . ' has been created.');
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
      return redirect('/list')->with('message', 'Certificate for ' . $certificate->fqdn . ' has been modified.');
    }

    public function destroy($id)
    {
      $certificate = Certificate::findOrFail($id);
      $certificate->delete();   // 삭제
      return redirect('/list')->with('message', 'Certificate for ' . $certificate->fqdn . ' has been deleted.');
    }
}
