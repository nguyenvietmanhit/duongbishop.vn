@extends('admins.layouts.main')
{{--@section('breadcrumb')--}}
{{--@include('includes.breadcrumb', [ 'breadcrumbs' => [--}}
{{--0 => [--}}
{{--'link' => url('/admins/news'),--}}
{{--'title' => 'Danh sách report',--}}
{{--],--}}
{{--]--}}
{{--])--}}
{{--@endsection()--}}
@section('content')
    <div class="content-list">
        <a href="{{ url('admin/new/create') }}" class="btn btn-primary">Thêm tin tức mới</a>
        <h1>
            Danh sách tin tức
        </h1>
        <table class="table table-striped table-responsive">
            <tr>
                <th>Tên tin tức</th>
{{--                <th>Danh mục</th>--}}
                <th>Ảnh đại diện</th>
                <th>Ngày tạo</th>
                <th></th>
            </tr>
            <?php

          ?>
            @foreach ($news AS $new)
                <tr>
                    <td>{{ $new->name }}</td>
{{--                    <td>{{ \App\Models\Category::getCategoryName($new->category_id) }}</td>--}}
                    <td>
                        @if($new->avatar)
                            <img src="{{ asset('uploads/' . $new->avatar) }}" class="new-avatar" height="80px" />
                        @endif
                    </td>
                    <td>{{ date('d-m-Y', strtotime($new->created_at)) }}</td>
                    <td>
                        <a href="{{ url('admin/new/edit', ['id' => $new->id]) }}" title="Sửa tin tức này">
                            <i class="fa fa-pencil-alt"></i>
                        </a> &nbsp;
                        <form class="delete" method="POST"
                              action="{{ url('admin/new/delete', ['id' => $new->id]) }}">
                            @method('DELETE')
                            @csrf
                            <a href="#" title="Xóa" class="link-delete" confirm="Bạn chắc chắn muốn xóa tin tức này?">
                                <i class="fa fa-trash"></i>
                            </a>
                            <input type="submit" name="delete" value="Delete" style="display: none"/>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $news->links() }}
    </div>
@endsection()
