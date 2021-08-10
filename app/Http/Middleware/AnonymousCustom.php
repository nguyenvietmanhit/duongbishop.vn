<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class AnonymousCustom
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Closure $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {

//    $user = session()->get('user');
//    if ($user) {
//      if (Role::isRoleAdmin($user->role_id)) {
//        return redirect('admin/products');
//      }
//      return redirect('/');
//
//    }
    return $next($request);
  }
}
