<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;

class ProductController extends AdminController
{


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $products = Product::orderBy('updated_at', 'DESC')
      ->orderBy('created_at', 'DESC')
      ->paginate(10);

    return view('admins.products.index', [
      'products' => $products
    ]);
  }

  public function create()
  {
    \Helper::$title_page = 'Thêm sản phẩm';
    $categories = Category::all()->pluck('name', 'id')->toArray();
    return view('admins.products.create', [
      'categories' => $categories
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
//    $product = new Product();
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
//    $path = $request->file('avatar')->storeAs()
    $product = Product::create($requests);
    if ($product) {
      \session()->flash('success', "Thêm mới sản phẩm thành công");
    } else {
      \session()->flash('error', "Thêm mới sản phẩm thất bại");
    }
    return redirect('admin/products');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    \Helper::$title_page = 'Sửa sản phẩm';
    $product = Product::findOrFail($id);
    $categories = Category::all()->pluck('name', 'id')->toArray();
    return view('admins.products.edit', [
      'categories' => $categories,
      'product' => $product,
    ]);
  }


  public function editSave(Request $request, $id)
  {
    $product = Product::findOrFail($id);
    $requests = $request->all();
    $requests['seo_title'] = $requests['seo_description'] = $requests['name'];
    $requests['seo_keyword'] = implode(', ', explode(' ', $requests['name']));
    // Upload file
    $avatar = $request->avatar;
    $filename = $product->avatar;
    if ($avatar instanceof UploadedFile) {
      @unlink(public_path('uploads/' . $filename));
      $filename = time() . '-' . $avatar->getClientOriginalName();
      $avatar->move(public_path('uploads'), $filename);
    }
    $requests['avatar'] = $filename;
    $is_update = $product->update($requests);
    if ($is_update) {
      \session()->flash('success', "Cập nhật sản phẩm thành công");
    } else {
      \session()->flash('error', "Cập nhật sản phẩm thất bại");
    }
    return redirect('admin/products');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $product = Product::findOrFail($id);
//    dd($product);
    $is_delete = $product->delete();
    if ($is_delete) {
      \session()->flash('success', "Xóa bản ghi $id thành công");
    } else {
      \session()->flash('error', "Xóa bản ghi $id thất bại");
    }
    return redirect('admin/products');
  }

}
