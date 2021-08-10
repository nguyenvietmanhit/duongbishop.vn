<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Role;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class RoleController extends AdminController
{
//  public function create()
//  {
//
//    return view('admins.roles.create');
//  }

//  public function createSave(Request $request) {
//    $rules = [
//      'page_number' => 'required',
//      'role' => 'required',
//    ];
//    $messages = [
//      'page_number.required' => 'Số trang không được để trống',
//      'content.required' => 'Nội dung không được để trống',
//    ];
//    $request->validate($rules, $messages);
////    $role = new Role();
////    dd($request->all());
//    $role = Role::create($request->all());
//    if ($role) {
//      \session()->flash('success', "Thêm mới nội dung thành công");
//    } else {
//      \session()->flash('error', "Thêm mới nội dung thất bại");
//    }
//    return redirect('admin/roles');
//  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $roles = Role::orderBy('id', 'ASC')->paginate(10);

    return view('admins.roles.index', [
      'roles' => $roles
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $role = Role::findOrFail($id);
    return view('admins.roles.edit', [
      'role' => $role
    ]);
  }


  public function editSave(Request $request, $id)
  {
    $role = Role::findOrFail($id);
    $is_update = $role->update($request->all());
    if ($is_update) {
      \session()->flash('success', "Cập nhật bản ghi $id thành công");
    } else {
      \session()->flash('error', "Cập nhật bản ghi $id thất bại");
    }
    return redirect('admin/roles');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $role = Role::findOrFail($id);
    $is_delete = $role->delete();
    if ($is_delete) {
      \session()->flash('success', "Xóa bản ghi $id thành công");
    } else {
      \session()->flash('error', "Xóa bản ghi $id thất bại");
    }
    return redirect('admin/roles');
  }

//  public function testPdf()
//  {
//    $pdf = App::make('dompdf.wrapper');
////      $pdf = PDF::loadView('test_pdf', []);
//    if ($pdf instanceof PDF) ;
////      return $pdf->download('invoice.pdf');
////      if ($pdf instanceof PDF)
////      dd($pdf);
//    $pdf->loadView('test_pdf');
////      $pdf->loadHTML('<h1>Mạnh Viết</h1>');
//
//    return $pdf->stream();
//  }
}
