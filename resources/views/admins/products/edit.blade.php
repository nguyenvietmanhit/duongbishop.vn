@extends('admins.layouts.main')
@section('content')
    <h1>Cập nhật thông tin acc <strong>{{ $product->name }}</strong></h1>
    <form action="{{ url('/admin/product/editSave/' . $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Mã acc</label>
            <input type="text" id="code"
                   name="code" class="form-control" placeholder="VD: Bi64" value="{{ old('code') ? old('code') : $product->code }}"/>
        </div>
        <div class="form-group">
            <label for="name">Thể loại</label>
                        <input type="text" id="type"
                               name="type" class="form-control" placeholder="VD: Zombie Nano"
                               value="{{ old('type') ? old('type') : $product->type }}"/>
        </div>
        <div class="form-group">
            <label for="name">Thông tin acc</label>
{{--            <input type="text" id="name"--}}
{{--                   name="name" class="form-control" required value="{{ old('name') ? old('name') : $product->name }}"/>--}}
            <textarea id="name"
                      name="name" class="form-control" required>{{ old('name') ? old('name') : $product->name }}</textarea>
        </div>

{{--        <div class="form-group">--}}
{{--            <label for="category_id">Chọn danh mục</label>--}}
{{--            <select name="category_id" id="category_id" class="form-control">--}}
{{--                @foreach($categories AS $category_id => $category_name)--}}
{{--                    @php--}}
{{--                        $selected = '';--}}
{{--                        if ($category_id == $product->category_id) {--}}
{{--                            $selected = 'selected';--}}
{{--                        }--}}
{{--                    if (old('category_id') && old('category_id') == $category_id) {--}}
{{--                         $selected = 'selected';--}}
{{--                    }--}}
{{--                    @endphp--}}
{{--                    <option value="{{ $category_id }}" {{ $selected }}>--}}
{{--                        {{ $category_name }}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
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
            <label for="summary">Ghi chú thêm cho acc</label>
            <textarea class="form-control" name="summary" id="summary">{{ old('summary') ? old('summary') : $product->summary }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Giá acc (VNĐ)</label>
            <input type="number" id="price"
                   name="price" class="form-control" value="{{ old('price') ? old('price') : $product->price }}"/>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12">
                    <label for="vip_total">Số vip</label>
                    <input type="number" id="vip_total"
                           name="vip_total" class="form-control" value="{{ old('vip_total') ? old('vip_total') : $product->vip_total }}"/>
                </div>
                <div class="col-md-6 col-sm-6 col-12">
                    <label for="vip_total">Vip ingame</label>
                    <input type="number" id="vip_ingame"
                           name="vip_ingame" class="form-control" value="{{ old('vip_ingame') ? old('vip_ingame') : $product->vip_ingame }}"/>
                </div>
            </div>

        </div>

        <div class="form-group">
            <label for="status">Trạng thái acc</label>
            <select name="status" id="status" class="form-control">
                @php
                    $selected_active = '';
                    $selected_disabled = '';
                    $selected_sold = '';
                    $status = old('status') ? old('status') : $product->status;
                    switch ($status) {
                      case -1: $selected_disabled = 'selected';break;
                      case 0: $selected_sold = 'selected';break;
                      case 1: $selected_active = 'selected';break;
                    }
                @endphp
                <option value="1" {{ $selected_active }}>
                    Hiển thị
                </option>
                <option value="-1" {{ $selected_disabled }}>
                    Không hiển thị
                </option>
                <option value="0" {{ $selected_sold }}>
                    Acc đã bán
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="content">Thông tin chi tiết acc</label>
            <textarea class="form-control" name="content" id="content">{{ old('content') ? old('content') : $product->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="name">Seo title</label>
            <input type="text" id="seo_title"
                   name="seo_title" class="form-control" required value="{{ old('seo_title') ? old('seo_title') : $product->seo_title }}"/>
        </div>
        <div class="form-group">
            <label for="name">Seo description</label>
            <input type="text" id="seo_description"
                   name="seo_description" class="form-control" required value="{{ old('seo_description') ? old('seo_description') : $product->seo_description }}"/>
        </div>
        <div class="form-group">
            <label for="name">Seo keywords</label>
            <input type="text" id="seo_keywords"
                   name="seo_keywords" class="form-control" required value="{{ old('seo_keywords') ? old('seo_keywords') : $product->seo_keywords }}"/>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Lưu" class="btn btn-primary"/>
            <a href="{{ url('admin/products') }}" class="btn btn-default">Về trang danh sách</a>
        </div>
    </form>
@endsection
