@extends('frontends.layouts.main_login')
@section('content')
    <div class="container">
        <form action="{{ url('user/loginProcess') }}" method="post">
            @csrf
            <h3 class="text-center">Đăng nhập tài khoản</h3>
            <div class="form-group">
                <label for="username">Tên đăng nhập <span class="red">*</span> </label>
                <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu <span class="red">*</span> </label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </div>
        </form>
        {{--<p>Nếu chưa có tài khoản, <a href="{{ url('/admin/register') }}">Đăng ký</a> ngay</p>--}}
    </div>
@endsection