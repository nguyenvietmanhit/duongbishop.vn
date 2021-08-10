@extends('admins.layouts.main')
@section('content')
    <h1>Cập nhật sản phẩm <strong>{{ $product->name }}</strong></h1>
    <form action="{{ url('/admin/product/editSave/' . $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" id="name"
                   name="name" class="form-control" required value="{{ old('name') ? old('name') : $product->name }}"/>
        </div>

        <div class="form-group">
            <label for="category_id">Chọn danh mục</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories AS $category_id => $category_name)
                    @php
                        $selected = '';
                        if ($category_id == $product->category_id) {
                            $selected = 'selected';
                        }
                    if (old('category_id') && old('category_id') == $category_id) {
                         $selected = 'selected';
                    }
                    @endphp
                    <option value="{{ $category_id }}" {{ $selected }}>
                        {{ $category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="price">Giá sản phẩm</label>
            <input type="number" id="price"
                   name="price" class="form-control" value="{{ old('price') ? old('price') : $product->price }}"/>
        </div>
        <div class="form-group">
            <label for="avatar">
                Ảnh đại diện
                &nbsp;<small class="red"><i class="fa fa-info-circle"></i> Để tải trang nhanh nhất, dung lượng file ảnh tải lên ko đc vượt quá 2MB</small>
            </label>
            <input type="file" id="avatar"
                   name="avatar" class="image-upload form-control" accept="image/*"/>
            <img class="image-preview" src="#" alt="" height="100" />
            @if($product->avatar)
                <img src="{{ asset('uploads/' . $product->avatar) }}" class="product-avatar" height="80px" />
            @endif
        </div>
        <div class="form-group">
            <label for="content">Chi tiết sản phẩm</label>
            <textarea class="form-control" name="content" id="content">{{ old('content') ? old('content') : $product->content }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Lưu" class="btn btn-primary"/>
            <a href="{{ url('admin/categories') }}" class="btn btn-default">Về trang danh sách</a>
        </div>
    </form>
@endsection
