@extends('frontends.layouts.main')
@section('content')
    <div class="container">
        <h3 class="create-report text-center">Tài khoản</h3>
        <form action="{{ url('/user/profileSave') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" name="username" value="{{ $user->username }}"
                                   class="form-control" id="username" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" value="{{ $user->fullname }}"
                                   class="form-control" id="fullname"/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ $user->email }}"
                                   class="form-control" id="email"/>
                        </div>
                        <div class="form-group">
                            <label for="phone">SĐT</label>
                            <input type="text" name="phone" value="{{ $user->phone }}"
                                   class="form-control" id="phone"/>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="password">Mật khẩu mới</label>
                            <input type="password" name="password" value=""
                                   class="form-control" id="password"/>
                        </div>
                        <div class="form-group">
                            <label for="password_confirm">Nhập lại mật khẩu</label>
                            <input type="password" name="password_confirm" value=""
                                   class="form-control" id="password_confirm"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group text-center form-submit">
                <button type="submit" name="submit" class="btn btn-success">
                    Cập nhật
                </button>
            </div>

        </form>
    </div>
@endsection()