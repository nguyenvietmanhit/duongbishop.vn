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
        <a href="{{ url('admin/product/create') }}" class="btn btn-primary">Thêm acc mới</a>
        <h1>
            Danh sách acc
        </h1>

        <form method="GET" action="" class="form-search">
            <div class="">
                {{--                <div class="col-md-3 col-sm-3 col-12">--}}
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ request()->get('keyword') }}"
                           placeholder="Tìm theo mã acc, Thể loại, Thông tin acc, giá hoặc mô tả acc ..." class="form-control"/>
                </div>
                {{--                </div>--}}
                {{--                <div class="col-md-3 col-sm-3 col-12">--}}
                <div class="form-group">
                    <input type="submit" name="search" value="Tìm kiếm" class="btn-search btn btn-success"/>
                    <a href="{{ url('/admin/products') }}" class="btn btn-default">Hủy tìm</a>
                </div>
                {{--                </div>--}}
            </div>
        </form>

        <h3>Tổng số <span class="red">{{ $products->total() }} acc</span> được tìm thấy</h3>
        <br />
        <table class="table table-striped table-responsive">
            <tr>
                <th>Mã acc</th>
                <th>Thể loại</th>
                <th>Thông tin acc</th>
                <th>Ảnh đại diện</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th></th>
            </tr>
            <?php

            ?>
            @foreach ($products AS $product)
                <tr>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{!! $product->name !!}</td>
                    {{--                    <td>{{ \App\Models\Category::getCategoryName($product->category_id) }}</td>--}}
                    <td>
                        @if($product->avatar)
                            <img src="{{ asset('uploads/' . $product->avatar) }}" class="product-avatar" height="80px"/>
                        @endif
                    </td>
                    <td>{{ number_format($product->price) }}</td>
                    <td>
                        {{ Helper::getStatusText($product->status) }}
                    </td>
                    <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>
                    <td>
                        <a href="{{ url('admin/product/edit', ['id' => $product->id]) }}" title="Sửa acc này">
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
