@extends('admins.layouts.main')
@section('content')
    <div class="update-form">
        <form action="{{ url('admin/category/editSave', ['id' => $category->id]) }}" method="post">
            @csrf
            @method('PUT')
            <h2 class="text-center">Sửa danh mục <b>{{ $category->name }}</b></h2>

            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" id="name"
                       name="name" class="form-control" required value="{{ old('name') ? old('name') : $category->name }}" />
            </div>
            <div class="form-group">
                <label for="description">Mô tả danh mục</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') ? old('description') : $category->description }}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Lưu" class="btn btn-primary" />
                <a href="{{ url('admin/categories') }}" class="btn btn-default">Về trang danh sách</a>
            </div>
        </form>
    </div>
@endsection