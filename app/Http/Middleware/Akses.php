<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Akses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$akses)
    {
        if (in_array('A', $akses)) {

            if (!empty(Session::get('user')['id'])) {

                if (Session::get('user')['role'] != 'A') {
                    if (Session::get('user')['role'] == 'G') {
                        return redirect('/guest');
                    }
                }
            } else {

                Session::forget('user');
                return redirect('/');
            }
        } elseif (in_array('G', $akses)) {
            if (!empty(Session::get('user')['id'])) {
                if (Session::get('user')['role'] != 'G') {
                    if (Session::get('user')['role'] == 'A') {
                        return redirect('/admin');
                    }
                }
            } else {

                Session::forget('user');
                return redirect('/');
            }
        }
        return $next($request);
    }
}
