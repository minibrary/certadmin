<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\User;
use App\Http\Requests;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show($id)
    {
      $profile = \Auth::user();
      return view('profile.show')->with('profile', $profile);
    }

    public function edit($id)
    {
      $profile = \Auth::user();
      return view('profile.edit')->with('profile', $profile);
    }

    public function update(Request $request, $id)
    {
      $profile = \Auth::user();
      $profile->update([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => bcrypt($request->get('password')),
      ]);
      return redirect()->route('profile.show', $profile->id)->with('message', 'Your profile has been modified.');
    }

    public function destroy($id)
    {
      //User::destroy($id);
      //return redirect('/')->with('message', 'Good Bye!');

      if($id != \Auth::user()->id){
        return redirect()->route('dashboard')->with('message', 'Do not kick out our member.');
      }
      if(User::find($id)){
          $user = User::findOrFail($id);
          $user->delete();
          return redirect('/');
      } else {
          return redirect()->route('dashboard');
      }
    }

    protected function send_email_verify()
    {
      \Auth::user()->update([
        'email_token' => str_random(10),
      ]);
      $user = \Auth::user();
      $email = new EmailVerification(new User(['email_token' => $user->email_token, 'name' => $user->name]));
      Mail::to($user->email)->send($email);
      DB::commit();
      return redirect()->route('dashboard')->with('message', 'We sent you verification mail. Please check your mailbox.');
    }

    public function email_verify($token)
    {
      // The verified method has been added to the user model and chained here
      // for better readability
      User::where('email_token', $token)->firstOrFail()->email_verified();
      return redirect()->route('dashboard')->with('message', 'Your E-mail address is verified.');
    }
}
