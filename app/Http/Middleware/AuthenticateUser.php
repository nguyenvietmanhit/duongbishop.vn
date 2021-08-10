<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthenticateUser
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
//    $user = session()->get('user');
//    // Luôn lấy lại thông tin user, để đảm bảo khi admin update cập nhật user thì các thông tin đc update
//    if ($user) {
//      $user = User::findOrFail($user->id);
//      session()->put('user', $user);
//    }
//    if (!$user) {
////      session()->put('error', 'Bạn chưa đăng nhập');
//      return redirect('user/login');
//    }
//
//    // Phân quyền xem báo cáo cho từng user
//    if (Role::isCurrentAdmin()) {
//      return $next($request);
//    }
//
//    $report_id = $request->route('report_id');
//    if ($report_id && !User::isAccessReportUser($user, $report_id)) {
//      abort(403, 'Bạn không có quyền truy cập báo cáo này');
//      exit();
//    }

    return $next($request);
  }
}
