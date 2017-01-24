<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use App\Http\Requests;


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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('certificate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $certificate = new certificate([
          'fqdn' => $request->get('fqdn'),
          'port' => $request->get('port'),
          'memo' => $request->get('memo'),
      ]);
      $user = \Auth::user();
      $certificate->user()->associate($user->id);
      $certificate->save();
      \Log::info('Certificate 등록 성공',
          ['user-id'=> $user->id, 'certificate-id'=>$certificate->id]
      );
      return redirect('/list')
          ->with('message', $certificate->name . ' 이 생성되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $certificate = Certificate::findOrFail($id);
      $certificate->delete();   // 삭제
      return redirect('/list')
        ->with('message', 'Domain ' . $certificate->fqdn  . ' has been deleted.');
    }
}
