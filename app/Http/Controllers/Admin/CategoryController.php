<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Category;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CategoryController extends AdminController
{


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $categories = Category::orderBy('updated_at', 'DESC')
      ->orderBy('created_at', 'DESC')
      ->paginate(10);

    return view('admins.categories.index', [
      'categories' => $categories
    ]);
  }

  public function create()
  {
    \Helper::$title_page = 'Thêm danh mục';
    return view('admins.categories.create');
  }

  public function createSave(Request $request) {
//    $rules = [
//      'page_number' => 'required',
//      'role' => 'required',
//    ];
//    $messages = [
//      'page_number.required' => 'Số trang không được để trống',
//      'content.required' => 'Nội dung không được để trống',
//    ];
//    $request->validate($rules, $messages);
//    $category = new Category();
//    dd($request->all());
    $category = Category::create($request->all());
    if ($category) {
      \session()->flash('success', "Thêm mới  thành công");
    } else {
      \session()->flash('error', "Thêm mới thất bại");
    }
    return redirect('admin/categories');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    \Helper::$title_page = 'Sửa danh mục';
    $category = Category::findOrFail($id);
    return view('admins.categories.edit', [
      'category' => $category
    ]);
  }


  public function editSave(Request $request, $id)
  {
    $category = Category::findOrFail($id);
    $is_update = $category->update($request->all());
    if ($is_update) {
      \session()->flash('success', "Cập nhật thành công");
    } else {
      \session()->flash('error', "Cập nhật thất bại");
    }
    return redirect('admin/categories');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $category = Category::findOrFail($id);
//    dd($category);
    $is_delete = $category->delete();
    if ($is_delete) {
      \session()->flash('success', "Xóa bản ghi $id thành công");
    } else {
      \session()->flash('error', "Xóa bản ghi $id thất bại");
    }
    return redirect('admin/categories');
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
