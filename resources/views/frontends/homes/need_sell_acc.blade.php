@extends('frontends.layouts.main')
@section('content')
    <div class="container hover-show-edit">
        @include('includes.breadcrumb', ['breadcrumbs' => [
          0 => [
            'title' => 'Trang chủ',
            'link' => url('/')
        ],
        1 => [
        'title' => $need_sell_acc['name'],
            'active' => TRUE
        ],
        ]])


        @if($need_sell_acc)
            @include('includes.link_edit_admin', [
                      'link_edit' => url('admin/page/edit/' . $need_sell_acc['id']),
                      'title' => 'Chỉnh sửa trang này',
                    ])
            <h1 class="post-list-title ">
                {{ $need_sell_acc['name'] }}
            </h1>
            @if($need_sell_acc['avatar'])
                <img src="{{ asset('uploads/' . $need_sell_acc['avatar']) }}" class="intro-avatar img-responsive"/>
            @endif
            <div class="intro-content">
                {!! $need_sell_acc['content'] !!}
            </div>
        @endif
    </div>
@endsection()
