<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Category;
use App\Models\News;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;

class NewsController extends AdminController
{


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $news = News::orderBy('updated_at', 'DESC')
      ->orderBy('created_at', 'DESC')
      ->paginate(10);

    return view('admins.news.index', [
      'news' => $news
    ]);
  }

  public function create()
  {
    \Helper::$title_page = 'Thêm tin tức';
//    $categories = Category::all()->pluck('name', 'id')->toArray();
    return view('admins.news.create', [
//      'categories' => $categories
    ]);
  }

  public function createSave(Request $request) {
    $requests = $request->all();
    $requests['seo_title'] = $requests['seo_description'] = $requests['name'];
    $requests['seo_keyword'] = implode(', ', explode(' ', $requests['name']));

    // Upload file
    $avatar = $request->avatar;
    $filename = '';
    if ($avatar instanceof UploadedFile) {
      $filename = time() . '-' . $avatar->getClientOriginalName();
      $avatar->move(public_path('uploads'), $filename);
    }
    $requests['avatar'] = $filename;
    $new = News::create($requests);
    if ($new) {
      \session()->flash('success', "Thêm mới tin tức thành công");
    } else {
      \session()->flash('error', "Thêm mới tin tức thất bại");
    }
    return redirect('admin/news');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    \Helper::$title_page = 'Sửa tin tức';
    $new = News::findOrFail($id);
//    $categories = Category::all()->pluck('name', 'id')->toArray();
    return view('admins.news.edit', [
//      'categories' => $categories,
      'new' => $new,
    ]);
  }


  public function editSave(Request $request, $id)
  {
    $new = News::findOrFail($id);
    $requests = $request->all();
    $requests['seo_title'] = $requests['seo_description'] = $requests['name'];
    $requests['seo_keyword'] = implode(', ', explode(' ', $requests['name']));
    // Upload file
    $avatar = $request->avatar;
    $filename = $new->avatar;
    if ($avatar instanceof UploadedFile) {
      @unlink(public_path('uploads/' . $filename));
      $filename = time() . '-' . $avatar->getClientOriginalName();
      $avatar->move(public_path('uploads'), $filename);
    }
    $requests['avatar'] = $filename;
    $is_update = $new->update($requests);
    if ($is_update) {
      \session()->flash('success', "Cập nhật tin tức thành công");
    } else {
      \session()->flash('error', "Cập nhật tin tức thất bại");
    }
    return redirect('admin/news');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $new = News::findOrFail($id);
//    dd($new);
    $is_delete = $new->delete();
    if ($is_delete) {
      \session()->flash('success', "Xóa bản ghi $id thành công");
    } else {
      \session()->flash('error', "Xóa bản ghi $id thất bại");
    }
    return redirect('admin/news');
  }

}
