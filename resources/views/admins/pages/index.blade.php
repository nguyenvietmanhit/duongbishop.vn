@extends('admins.layouts.main')
{{--@section('breadcrumb')--}}
{{--@include('includes.breadcrumb', [ 'breadcrumbs' => [--}}
{{--0 => [--}}
{{--'link' => url('/admins/pages'),--}}
{{--'title' => 'Danh sách report',--}}
{{--],--}}
{{--]--}}
{{--])--}}
{{--@endsection()--}}
@section('content')
    <div class="content-list">
        <a href="{{ url('admin/page/create') }}" class="btn btn-primary">Thêm trang tĩnh mới</a>
        <h1>
            Danh sách trang tĩnh
        </h1>
        <table class="table table-striped table-responsive">
            <tr>
                <th>Tên trangm</th>
{{--                <th>Danh mục</th>--}}
                <th>Ảnh đại diện</th>
{{--                <th>Giá</th>--}}
                <th>Ngày tạo</th>
                <th></th>
            </tr>
            @foreach ($pages AS $page)
                <tr>
                    <td>{{ $page->name }}</td>
{{--                    <td>{{ \App\Models\Category::getCategoryName($page->category_id) }}</td>--}}
                    <td>
                        @if($page->avatar)
                            <img src="{{ asset('uploads/' . $page->avatar) }}" class="page-avatar" height="80px" />
                        @endif
                    </td>
{{--                    <td>{{ number_format($page->price) }}</td>--}}
                    <td>{{ date('d-m-Y', strtotime($page->created_at)) }}</td>
                    <td>
                        <a href="{{ url('admin/page/edit', ['id' => $page->id]) }}" title="Sửa trang tĩnh này">
                            <i class="fa fa-pencil-alt"></i>
                        </a> &nbsp;
{{--                        <form class="delete" method="POST"--}}
{{--                              action="{{ url('admin/page/delete', ['id' => $page->id]) }}">--}}
{{--                            @method('DELETE')--}}
{{--                            @csrf--}}
{{--                            <a href="#" title="Xóa" class="link-delete" confirm="Bạn chắc chắn muốn xóa trang tĩnh này?">--}}
{{--                                <i class="fa fa-trash"></i>--}}
{{--                            </a>--}}
{{--                            <input type="submit" name="delete" value="Delete" style="display: none"/>--}}
{{--                        </form>--}}
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $pages->links() }}
    </div>
@endsection()
