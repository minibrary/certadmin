<?php
namespace App\Http\Middleware;
use App\Certificate;
use Closure;
use App\User;
class ProfileCheck
{
    /**
     * Validate Certificat owner = current loggen in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (\Auth::guard($guard)->check()) {
            // get current user id from current route
            $cid = \Route::current()->parameter('profile');
            if (isset($cid)) {
                $cuser = User::find($cid);
                $user = \Auth::user();
                if ($cuser->id != $user->id) {
                    \Log::error('Bad Access: ', [
                        'user-id' => $user->id,
                        'name'=> $user->name,
                        'tried to access' => $user->id,
                    ]);
                    return redirect('/dashboard')
                        ->with('message', 'Bad Access: You can access only your own.');
                }
            }
        }
        return $next($request);
    }
}
