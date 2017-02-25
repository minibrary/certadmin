<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Certificate;
use App\Http\Requests;
use App\X509;
use App\Http\Controllers\X509Controller;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }
}
