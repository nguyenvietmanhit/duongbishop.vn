<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Category;
use App\Models\Page;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;

class PageController extends AdminController
{


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $pages = Page::orderBy('updated_at', 'DESC')
      ->orderBy('created_at', 'DESC')
      ->paginate(10);

    return view('admins.pages.index', [
      'pages' => $pages
    ]);
  }

  public function create()
  {
    \Helper::$title_page = 'Thêm trang tĩnh';
//    $categories = Category::all()->pluck('name', 'id')->toArray();
    return view('admins.pages.create', [
//      'categories' => $categories
    ]);
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
//    $page = new Page();
    $requests = $request->all();
//    $requests['seo_title'] = $requests['seo_description'] = $requests['name'];
//    $requests['seo_keyword'] = implode(', ', explode(' ', $requests['name']));

    // Upload file
    $avatar = $request->avatar;
    $filename = '';
    if ($avatar instanceof UploadedFile) {
      $filename = time() . '-' . $avatar->getClientOriginalName();
      $avatar->move(public_path('uploads'), $filename);
    }
    $requests['avatar'] = $filename;
//    $path = $request->file('avatar')->storeAs()
    $page = Page::create($requests);
    if ($page) {
      \session()->flash('success', "Thêm mới trang tĩnh thành công");
    } else {
      \session()->flash('error', "Thêm mới trang tĩnh thất bại");
    }
    return redirect('admin/pages');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    \Helper::$title_page = 'Sửa trang tĩnh';
    $page = Page::findOrFail($id);
//    $categories = Category::all()->pluck('name', 'id')->toArray();
    return view('admins.pages.edit', [
//      'categories' => $categories,
      'page' => $page,
    ]);
  }


  public function editSave(Request $request, $id)
  {
    $page = Page::findOrFail($id);
    $requests = $request->all();
//    $requests['seo_title'] = $requests['seo_description'] = $requests['name'];
//    $requests['seo_keyword'] = implode(', ', explode(' ', $requests['name']));
    // Upload file
    $avatar = $request->avatar;
    $filename = $page->avatar;
    if ($avatar instanceof UploadedFile) {
      @unlink(public_path('uploads/' . $filename));
      $filename = time() . '-' . $avatar->getClientOriginalName();
      $avatar->move(public_path('uploads'), $filename);
    }
    $requests['avatar'] = $filename;
    $is_update = $page->update($requests);
    if ($is_update) {
      \session()->flash('success', "Cập nhật trang tĩnh thành công");
    } else {
      \session()->flash('error', "Cập nhật trang tĩnh thất bại");
    }
    return redirect('admin/pages');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $page = Page::findOrFail($id);
//    dd($page);
    $is_delete = $page->delete();
    if ($is_delete) {
      \session()->flash('success', "Xóa bản ghi $id thành công");
    } else {
      \session()->flash('error', "Xóa bản ghi $id thất bại");
    }
    return redirect('admin/pages');
  }

}
