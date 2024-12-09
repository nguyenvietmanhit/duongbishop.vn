@extends('frontends.layouts.main')
@section('content')
    <div class="container hover-show-edit">
        @include('includes.breadcrumb', ['breadcrumbs' => [
          0 => [
            'title' => 'Trang chủ',
            'link' => url('/')
        ],
        1 => [
        'title' => $change_info_acc['name'],
            'active' => TRUE
        ],
        ]])


        @if($change_info_acc)
            @include('includes.link_edit_admin', [
                      'link_edit' => url('admin/page/edit/' . $change_info_acc['id']),
                      'title' => 'Chỉnh sửa trang này',
                    ])
            <h1 class="post-list-title ">
                {{ $change_info_acc['name'] }}
            </h1>
            @if($change_info_acc['avatar'])
                <img src="{{ asset('uploads/' . $change_info_acc['avatar']) }}" class="intro-avatar img-responsive"/>
            @endif
            <div class="intro-content">
                {!! $change_info_acc['content'] !!}
            </div>
        @endif
    </div>
@endsection()
