
@extends('admins.layouts.main')
@section('content')
    <h1>Thêm mới nội dung trang</h1>
    <form action="{{ url('/admin/category/createSave') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" id="name"
                   name="name" class="form-control" required value="{{ old('name') }}" />
        </div>
        <div class="form-group">
            <label for="description">Mô tả danh mục</label>
            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Lưu" class="btn btn-primary" />
            <a href="{{ url('admin/categories') }}" class="btn btn-default">Về trang danh sách</a>
        </div>
    </form>
@endsection