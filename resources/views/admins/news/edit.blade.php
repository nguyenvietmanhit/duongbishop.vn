@extends('admins.layouts.main')
@section('content')
    <h1>Cập nhật tin tức <strong>{{ $new->name }}</strong></h1>
    <form action="{{ url('/admin/new/editSave/' . $new->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên tin tức</label>
            <input type="text" id="name"
                   name="name" class="form-control" required value="{{ old('name') ? old('name') : $new->name }}"/>
        </div>

{{--        <div class="form-group">--}}
{{--            <label for="category_id">Chọn danh mục</label>--}}
{{--            <select name="category_id" id="category_id" class="form-control">--}}
{{--                @foreach($news AS $category_id => $category_name)--}}
{{--                    @php--}}
{{--                        $selected = '';--}}
{{--                        if ($category_id == $new->category_id) {--}}
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
            @if($new->avatar)
                <img src="{{ asset('uploads/' . $new->avatar) }}" class="new-avatar" height="80px" />
            @endif
        </div>
        <div class="form-group">
            <label for="content">Chi tiết tin tức</label>
            <textarea class="form-control" name="content" id="content">{{ old('content') ? old('content') : $new->content }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Lưu" class="btn btn-primary"/>
            <a href="{{ url('admin/news') }}" class="btn btn-default">Về trang danh sách</a>
        </div>
    </form>
@endsection
