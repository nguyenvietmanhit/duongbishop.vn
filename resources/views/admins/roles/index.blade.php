@extends('admins.layouts.main')
@section('page_title', 'Danh sách content')
{{--@section('breadcrumb')--}}
    {{--@include('includes.breadcrumb', [ 'breadcrumbs' => [--}}
            {{--0 => [--}}
                {{--'link' => url('/admins/contents'),--}}
                {{--'title' => 'Danh sách report',--}}
            {{--],--}}
        {{--]--}}
    {{--])--}}
{{--@endsection()--}}
@section('content')
    <div class="content-list">
        <h1>
            Danh sách quyền trên hệ thống
        </h1>
        <table class="table table-hover">
            <tr>
                <th>Tên quyền</th>
                <th>Mô tả</th>
                <th></th>
            </tr>
            @foreach ($roles AS $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>
                        <a href="{{ url('admin/role/edit', ['id' => $role->id]) }}" title="Sửa">
                            <i class="fa fa-pencil-alt"></i>
                        </a> &nbsp;
                        {{--<form class="delete" method="POST"--}}
                              {{--action="{{ url('admin/content/delete', ['id' => $role->id]) }}">--}}
                            {{--@method('DELETE')--}}
                            {{--@csrf--}}
                            {{--<a href="#" title="Xóa" class="delete"--}}
                               {{--onclick="return confirm('Bạn chắc chắn muốn xóa trang này không?')">--}}
                                {{--<i class="fa fa-trash"></i>--}}
                            {{--</a>--}}
                            {{--<input type="submit" name="delete" value="Delete" style="display: none"/>--}}
                        {{--</form>--}}
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $roles->links() }}
    </div>
@endsection()