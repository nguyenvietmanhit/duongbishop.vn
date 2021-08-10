@extends('admins.layouts.main')
{{--@section('breadcrumb')--}}
    {{--@include('includes.breadcrumb', [ 'breadcrumbs' => [--}}
            {{--0 => [--}}
                {{--'link' => url('/admins/categorys'),--}}
                {{--'title' => 'Danh sách report',--}}
            {{--],--}}
        {{--]--}}
    {{--])--}}
{{--@endsection()--}}
@section('content')
    <div class="content-list">
        <a href="{{ url('admin/category/create') }}" class="btn btn-primary">Thêm danh mục mới</a>
        <h1>
            Danh sách danh mục
        </h1>
        <table class="table table-striped table-responsive">
            <tr>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Ngày tạo</th>
                <th></th>
            </tr>
            @foreach ($categories AS $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{!! $category->description !!}</td>
                    <td>{{ date('d-m-Y', strtotime($category->created_at)) }}</td>
                    <td>
                        <a href="{{ url('admin/category/edit', ['id' => $category->id]) }}" title="Sửa">
                            <i class="fa fa-pencil-alt"></i>
                        </a> &nbsp;
                        <form class="delete" method="POST"
                              action="{{ url('admin/category/delete', ['id' => $category->id]) }}">
                            @method('DELETE')
                            @csrf
                            <a href="#" title="Xóa" class="link-delete" confirm="Bạn chắc chắn muốn xóa danh mục này, các sản phẩm của danh mục này cũng sẽ bị xóa theo?">
                                <i class="fa fa-trash"></i>
                            </a>
                            <input type="submit" name="delete" value="Delete" style="display: none"/>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $categories->links() }}
    </div>
@endsection()