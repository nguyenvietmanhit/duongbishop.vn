@extends('frontends.layouts.main')
@section('content')
    <div class="container hover-show-edit">
        @include('includes.breadcrumb', ['breadcrumbs' => [
          0 => [
            'title' => 'Trang chủ',
            'link' => url('/')
        ],
        1 => [
        'title' => $guide_buy_acc['name'],
            'active' => TRUE
        ],
        ]])


        @if($guide_buy_acc)
            @include('includes.link_edit_admin', [
                      'link_edit' => url('admin/page/edit/' . $guide_buy_acc['id']),
                      'title' => 'Chỉnh sửa trang này',
                    ])
            <h1 class="post-list-title ">
                {{ $guide_buy_acc['name'] }}
            </h1>
            @if($guide_buy_acc['avatar'])
                <img src="{{ asset('uploads/' . $guide_buy_acc['avatar']) }}" class="intro-avatar img-responsive"/>
            @endif
            <div class="intro-content">
                {!! $guide_buy_acc['content'] !!}
            </div>
        @endif
    </div>
@endsection()
