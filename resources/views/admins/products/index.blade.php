@extends('admins.layouts.main')
{{--@section('breadcrumb')--}}
{{--@include('includes.breadcrumb', [ 'breadcrumbs' => [--}}
{{--0 => [--}}
{{--'link' => url('/admins/products'),--}}
{{--'title' => 'Danh sách report',--}}
{{--],--}}
{{--]--}}
{{--])--}}
{{--@endsection()--}}
@section('content')
    <div class="content-list">
        <a href="{{ url('admin/product/create') }}" class="btn btn-primary">Thêm sản phẩm mới</a>
        <h1>
            Danh sách sản phẩm
        </h1>
        <table class="table table-striped table-responsive">
            <tr>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Ảnh đại diện</th>
                <th>Giá</th>
                <th>Ngày tạo</th>
                <th></th>
            </tr>
            <?php

          ?>
            @foreach ($products AS $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ \App\Models\Category::getCategoryName($product->category_id) }}</td>
                    <td>
                        @if($product->avatar)
                            <img src="{{ asset('uploads/' . $product->avatar) }}" class="product-avatar" height="80px" />
                        @endif
                    </td>
                    <td>{{ number_format($product->price) }}</td>
                    <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>
                    <td>
                        <a href="{{ url('admin/product/edit', ['id' => $product->id]) }}" title="Sửa sản phẩm này">
                            <i class="fa fa-pencil-alt"></i>
                        </a> &nbsp;
                        <form class="delete" method="POST"
                              action="{{ url('admin/product/delete', ['id' => $product->id]) }}">
                            @method('DELETE')
                            @csrf
                            <a href="#" title="Xóa" class="link-delete" confirm="Bạn chắc chắn muốn xóa sản phẩm này?">
                                <i class="fa fa-trash"></i>
                            </a>
                            <input type="submit" name="delete" value="Delete" style="display: none"/>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $products->links() }}
    </div>
@endsection()