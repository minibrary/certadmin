<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\X509;
use App\Certificate;
use App\Http\Requests;


class X509Controller extends Controller
{
    public function parse(){
      $fqdn = X509::where('fqdn')->get();
      $port = X509::where('port')->get();
      $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE, 'verify_peer' => false, 'verify_peer_name' => false)));
      $read = stream_socket_client("ssl://".$fqdn.":".$port, $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
      $cert = stream_context_get_params($read);
      $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
      $today = time();
      $validTo_time_t = date($certinfo['validTo_time_t']);
      $difference = $validTo_time_t - $today;
      $days_left = floor($difference / (60*60*24));

    }

    public function update(){
      $certinfo = X509::parse()->get($certinfo);
      $certinfo->update([
        'name' => 'name'
        'subject_c' => 'subject_c'
      ])



    }



}
