<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends AdminController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::orderBy('created_at', 'DESC')->paginate(10);
//        dd($users);
    return view('admins.users.index', [
      'users' => $users
    ]);
  }

  public function register()
  {
    return view('admins.users.register');
  }

  public function registerSave(Request $request)
  {
    $rules = [
      'username' => 'required|unique:users',
      'email' => 'required|email',
      'password' => 'required|min:6',
      'password_confirm' => 'required|same:password',
    ];
    $messages = [
      'username.required' => 'Username không được để trống',
      'email.required' => 'Email không được để trống',
      'email.email' => 'Email chưa đúng định dạng',
      'username.unique' => 'Username nãy đã tồn tại',
      'password.required' => 'Password không được để trống',
      'password.min' => 'Password cần ít nhất 6 ký tự',
      'password_confirm.required' => 'Trường nhập lại mật khẩu không được để trống',
      'password_confirm.same' => 'Mật khẩu nhập lại chưa đúng',
    ];
    $request->validate($rules, $messages);
    $requests = $request->all();
    $requests['password'] = password_hash($request->get('password'), PASSWORD_DEFAULT);
    $user = User::create($requests);

    if ($user) {
      \session()->flash('success', 'Tạo user thành công');
    } else {
      \session()->flash('error', 'Tạo user thất bại');
    }
    return redirect('admin/users');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    \Helper::$title_page = 'Sửa thông tin user';
    $user = User::findOrFail($id);

    $reports = Report::all()->pluck('name', 'id')->toArray();

    return view('admins.users.edit', [
      'user' => $user,
      'reports' => $reports
    ]);
  }

  public function detail($id)
  {
    \Helper::$title_page = 'Chi tiết user';
    $user = User::findOrFail($id);
    return view('admins.users.detail', [
      'user' => $user
    ]);


  }


  public function editSave(Request $request, $id)
  {
    $user = User::findOrFail($id);

    $requests = $request->all();
    $report_id = $request->get('report_id') ? $request->get('report_id') : [];
    $requests['report_id'] = implode(',', $report_id);
    $is_update = $user->update($requests);
    if ($is_update) {
      \session()->flash('success', "Cập nhật user {$user->username} thành công");
    } else {
      \session()->flash('error', "Cập nhật bản ghi {$user->username} thất bại");
    }
    return redirect('admin/users');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $user = User::findOrFail($id);

    if (Role::isRoleAdmin($user->role_id)) {
      abort(403, 'Không thể xóa admin');
    }
    $is_delete = $user->delete();
    if ($is_delete) {
      \session()->flash('success', "Xóa user $id thành công");
    } else {
      \session()->flash('error', "Xóa user $id thất bại");
    }
    return redirect('admin/users');
  }

  public function login()
  {
    \Helper::$title_page = 'Đăng nhập';
    return view('admins.users.login');
  }

  public function loginProcess(Request $request)
  {

    $rules = [
      'username' => 'required',
      'password' => 'required',
    ];
    $messages = [
      'username.required' => 'Username không được để trống',
      'password.required' => 'Password không được để trống',
    ];

    $request->validate($rules, $messages);
    $user = User::where('username', $request->get('username'))->first();

    if (!$user) {
      session()->put('error', 'Tài khoản này không tồn tại');
      return redirect('user/login');
    }

//    if (Role::isRoleUser($user->role_id)) {
//      session()->put('error', 'Tài khoản này không có quyền quản trị');
//      return redirect('user/login');
//    }

    if (password_verify($request->get('password'), $user->password)) {
//      session()->put('success', 'Đăng nhập thành công');
      session()->put('user', $user);
      return redirect('admin/products');
    } else {
      session()->put('error', 'Sai tài khoản hoặc mật khẩu');
      return redirect('user/login');
    }
  }

  public function logout()
  {
    session()->forget('user');
    session()->put('success', 'Đăng xuất thành công');
    return redirect('user/login');
  }

  public function profile()
  {
    return view('admins.users.profile');
  }


}
