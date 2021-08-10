@extends('admins.layouts.main')
@section('page_title', 'Danh sách user')
@section('content')
    <a href="{{ url('/admin/user/register') }}" class="btn btn-success">
        <i class="fa fa-plus"></i> &nbsp; Tạo user mới
    </a>
    <h1 class="list-user">
        Danh sách user
    </h1>
    <table class="table table-hover">
        <tr>
            <th>STT</th>
            {{--<th>Username</th>--}}
            <th>Username</th>
            <th>Email</th>
            <th>Quyền</th>
            {{--<th>Số báo cáo</th>--}}
            <th></th>
        </tr>
        @foreach ($users AS $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    {{ \App\Models\Role::getRoleName($user->role_id) }}
                </td>
                {{--<td>{{ $user->phone }}</td>--}}
                {{--<td>{{ $user->amount }}</td>--}}
                {{--<td>{{ $user->fullname }}</td>--}}
                {{--<td>{{ $user->info }}</td>--}}
                <td>
                    <a href="{{ url('admin/user/detail', ['id' => $user->id]) }}" title="Xem chi tiết">
                        <i class="fa fa-eye"></i>
                    </a> &nbsp;
                    <a href="{{ url('admin/user/edit', ['id' => $user->id]) }}" title="Sửa">
                        <i class="fa fa-pencil-alt"></i>
                    </a> &nbsp;
                    @if(!\App\Models\Role::isRoleAdmin($user->role_id))
                        <form class="delete" method="POST" action="{{ url('admin/user/delete', ['id' => $user->id]) }}">
                            @method('DELETE')
                            @csrf
                            <a href="#" title="Xóa" class="link-delete">
                                <i class="fa fa-trash"></i>
                            </a>
                            <input type="submit" name="delete" value="Delete" style="display: none"/>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
@endsection()