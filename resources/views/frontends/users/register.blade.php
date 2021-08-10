@extends('admins.layouts.main')
@section('content')
    @php
        $roles = \App\Models\Role::getRoles();
    @endphp
    <div class="login-form container">
        <form action="{{ url('admin/user/registerSave') }}" method="post">
            @csrf
            <h2 class="text-center">Tạo user mới</h2>

            <div class="form-group">
                <label for="username">Nhập username <span class="red">*</span> </label>
                <input type="text" placeholder="Nhập username có tính duy nhất trên hệ thống..."
                       name="username" class="form-control" id="username" {{ old('username') }} >
            </div>
            <div class="form-group">
                <label for="role_id">Chọn quyền <span class="red">*</span> </label>
                <select class="form-control" name="role_id" id="role_id">
                    @foreach($roles AS $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="email">Nhập email <span class="red">*</span> </label>
                <input type="text"
                       name="email" class="form-control" id="email" {{ old('email') }} >
            </div>
            <div class="form-group">
                <label for="password">Nhập password <span class="red">*</span> </label>
                <input type="password" id="password" name="password" class="form-control"
                placeholder="Nhập ít nhất 6 ký tự..." >
            </div>
            <div class="form-group">
                <label for="password-confirm">Nhập lại password <span class="red">*</span> </label>
                <input type="password" id="password-confirm" name="password_confirm" class="form-control" >
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ url('/admin/users') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
        {{--<p>Nếu đã có tài khoản, <a href="{{ url('/admin/login') }}">Đăng nhập</a> ngay</p>--}}
    </div>
@endsection