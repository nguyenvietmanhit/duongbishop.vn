@extends('admins.layouts.main')
@section('content')
    @include('includes.breadcrumb', ['breadcrumbs' => [
    0 => [
        'title' => 'Danh sách user',
        'link' => url('/admin/users'),
    ],
    1 => [
        'title' => 'Chi tiết user #' . $user->id,
        'active' => TRUE,
    ],
    ]

    ])
    <h1>Thông tin user #{{ $user->id }}</h1>
    <table class="table table-hover">
        <tr>
            <th width="20%">Username</th>
            <td>{{ $user->username }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>SĐT</th>
            <th>{{ $user->phone }}</th>
        </tr>
        <tr>
            <th>Số lượng report</th>
            <td>{{ $user->amount }}</td>
        </tr>
        <tr>
            <th>Họ tên</th>
            <td>{{ $user->fullname }}</td>
        </tr>
        <tr>
            <th>Quyền</th>
            <td>
                {{ \App\Models\Role::getRoleName($user->role_id) }}
            </td>
        </tr>
    </table>
    <a href="{{ url('/admin/users') }}" class="btn btn-default">Quay lại</a>
@endsection