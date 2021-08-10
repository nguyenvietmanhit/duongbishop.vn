
@extends('admins.layouts.main')
@section('page_title', 'Danh sách trang')
@section('content')
    <h1>Thêm mới nội dung trang</h1>
    <form action="{{ url('/admin/content/createSave') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Loại nội dung</label>
            @php
            $selected_static = '';
            $selected_dynamic = '';
            switch (old('type')) {
                case \App\Models\Content::TYPE_STATIC_FIXED: $selected_static = 'selected';break;
                case \App\Models\Content::TYPE_DYNAMIC_USER_INFO: $selected_dynamic = 'selected';break;
            }
            @endphp
            <select name="type" id="type" class="form-control">
                <option value="{{ \App\Models\Content::TYPE_STATIC_FIXED }}" {{ $selected_static }}>{{ \App\Models\Content::TYPE_STATIC_FIXED_TEXT }}</option>
                <option value="{{ \App\Models\Content::TYPE_DYNAMIC_USER_INFO }}" {{ $selected_dynamic }}>{{ \App\Models\Content::TYPE_DYNAMIC_USER_INFO_TEXT }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="page_number">Số trang (tương ứng trong file report mẫu)</label>
            <input type="number" id="page_number" min="1"
                   name="page_number" class="form-control" required value="{{ old('page_number') }}" />
        </div>
        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Lưu" class="btn btn-primary" />
            <a href="{{ url('admin/content/static') }}" class="btn btn-default">Về trang danh sách</a>
        </div>
    </form>
@endsection