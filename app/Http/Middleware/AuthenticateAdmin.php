<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  public function handle(Request $request, Closure $next)
  {
//      session()->put('user', User::find(1)->first());
    $user = session()->get('user');
    if (!$user) {
      session()->put('error', 'Bạn chưa đăng nhập');
      return redirect('user/login');
    }
    if ($user && !Role::isRoleAdmin($user->role_id)) {
//      session()->put('error', 'Tài khoản này không có quyền quản trị');
      return redirect('/');
    }
    return $next($request);
  }
}
