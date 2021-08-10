@extends('admins.layouts.main')
@section('page_title', 'Sửa thông tin user')
@section('content')
    <div class="update-form">
        <form action="{{ url('admin/role/editSave', ['id' => $role->id]) }}" method="post">
            @csrf
            @method('PUT')
            <h2 class="text-center">Sửa quyền <b>{{ $role->name }}</b></h2>

            <div class="form-group">
                <label for="name">Quyền</label>
                <input type="text" id="name" name="name" class="form-control"
                       value="{{ $role->name }}">
            </div>
            <div class="form-group">
                <label for="description">Mô tả quyền</label>
                <textarea class="form-control" id="description" name="description">{{$role->description}}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit">Lưu</button>
                <a href="{{ url('admin/roles') }}" class="btn btn-default">Về trang danh sách</a>
            </div>
        </form>
    </div>
@endsection