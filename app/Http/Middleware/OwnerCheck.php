<?php
namespace App\Http\Middleware;
use App\Certificate;
use Closure;
class OwnerCheck
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
            // get certificate id from current route
            $cid = \Route::current()->parameter('list');
            if (isset($cid)) {
                $certificate = Certificate::find($cid);
                $user = \Auth::user();
                if ($certificate->user->id != $user->id) {
                    \Log::error('Bad Access: ', [
                        'user-id' => $user->id,
                        'name'=> $user->name,
                        'certificate-id' => $certificate->id,
                    ]);
                    return redirect('/dashboard')
                        ->with('message', 'Bad Access: You can access only your own.');
                }
            }
        }
        return $next($request);
    }
}
