@extends('admins.layouts.main')
@section('page_title', 'Sửa thông tin user')
@section('breadcrumb')
    @include('includes.breadcrumb', [ 'breadcrumbs' => [
            0 => [
                'link' => url('/admin/users'),
                'title' => 'Danh sách user',
            ],
            1 => [
                'active' => TRUE,
                'title' => "Sửa thông tin user"
            ],
        ]
    ])
@endsection()
@section('content')
    <div class="update-form">
        <form action="{{ url('admin/user/editSave', ['id' => $user->id]) }}" method="post">
            @csrf
            @method('PUT')
            <h2 class="text-center">Sửa thông tin user: <strong>{{ $user->username }}</strong></h2>
            <div class="form-group">
                <label for="report_id">Phân quyền xem báo cáo cho user này</label> (
                <small>Để chọn nhiều báo cáo đồng thời, giữ phím Ctrl</small>
                )
                <br/>
              <?php
              $report_ids = explode(',', $user->report_id);
              ?>
                <select name="report_id[]" id="report_id" class="form-control" multiple>
                    @foreach ($reports AS $report_id => $report_name)
                    <?php
                    $selected = in_array($report_id, $report_ids) ? 'selected' : '';
                    ?>
                        <option value="{{ $report_id }}" {{ $selected }}>{{ $report_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') ? old('email') : $user->email }}" id="email">
            </div>
            <div class="form-group">
                <label for="phone">SĐT</label>
                <input type="text" id="phone" name="phone" class="form-control"
                       value="{{ old('phone') ? old('phone') : $user->phone }}">
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="amount">Số lượng báo cáo</label>--}}
                {{--<input type="number" id="amount" name="amount" class="form-control"--}}
                       {{--value="{{ old('amount') ? old('amount') : $user->amount }}">--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="fullname">Họ tên</label>
                <input type="text" id="fullname" name="fullname" class="form-control"
                       value="{{ old('fullname') ? old('fullname') : $user->fullname }}">
            </div>
            <div class="form-group">
                <label for="info">Thông tin liên hệ</label>
                <textarea id="info" name="info" class="form-control" rows="5">{{ old('info') ? old('info') : $user->info }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit">Lưu</button>
                <a href="{{ url('admin/users') }}" class="btn btn-default">Quay lại</a>
            </div>
        </form>
    </div>
@endsection