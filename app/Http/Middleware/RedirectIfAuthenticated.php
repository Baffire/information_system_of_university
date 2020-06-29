<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 1]) ) {
            return redirect(RouteServiceProvider::ADMIN);
        } elseif ( Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 2]) ) {
            return redirect(RouteServiceProvider::STUDENT);
        } elseif ( Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 3]) ) {
            return redirect(RouteServiceProvider::TEACHER);
        } elseif ( Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 4]) ) {
            return redirect(RouteServiceProvider::EMPLOYEE);
        } elseif ( Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 6]) ) {
            return redirect(RouteServiceProvider::HEAD);
        } else {
            return $next($request);
        }
    }
}
