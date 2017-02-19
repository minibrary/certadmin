<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\X509;
use App\Certificate;
use App\Http\Requests;


class X509Controller extends Controller
{
    public function parse()
    {
      $x509s = X509::get();
      foreach ($x509s as $x509)
      {
        $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE, 'verify_peer' => false, 'verify_peer_name' => false)));
        $read = stream_socket_client("ssl://".$x509['fqdn'].":".$x509['port'], $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $get);
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

          X509::where('id', $x509['id'])
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
            'signatureTypeLN' => $certinfo['hash'],
            'signatureTypeNID' => $certinfo['hash'],
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

        Certificate::where('fqdn', $x509['fqdn'])
          ->update([
            'daysleft' => $daysleft,
          ]);
      };
      return redirect('/list');
    }
}
