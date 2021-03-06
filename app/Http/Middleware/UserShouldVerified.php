<?php

namespace App\Http\Middleware;

use Session;
use Closure;

class UserShouldVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $response = $next($request);

      if (auth()->check() && !auth()->user()->is_verified)
      {
        $link = url('auth/resend-verification') . '?email=' .
        urlencode(auth()->user()->email);

        auth()->logout();

        Session::flash('flash_notification',[
          'level' => 'warning',
          'message' => "Akun anda belum aktif, silahkan klik link verifikasi yang telah dikirim ke email anda.
          <a class='alert-link' href='$link'>kirim ulang verifikasi</a>"
          ]);

        return redirect('/login');
      }

      return $response;
    }

}
