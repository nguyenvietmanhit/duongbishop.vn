@extends('frontends.layouts.main')
@section('content')
    <div class="container hover-show-edit">
        @include('includes.breadcrumb', ['breadcrumbs' => [
          0 => [
            'title' => 'Trang chủ',
            'link' => url('/')
        ],
        1 => [
        'title' => $page_intro['name'],
            'active' => TRUE
        ],
        ]])


        @if($page_intro)
            @include('includes.link_edit_admin', [
                      'link_edit' => url('admin/page/edit/' . $page_intro['id']),
                      'title' => 'Chỉnh sửa trang giới thiệu này',
                    ])
            <h1 class="post-list-title ">
                {{ $page_intro['name'] }}
            </h1>
            @if($page_intro['avatar'])
                <img src="{{ asset('uploads/' . $page_intro['avatar']) }}" class="intro-avatar img-responsive"/>
            @endif
            <div class="intro-content">
                {!! $page_intro['content'] !!}
            </div>
        @endif
    </div>
@endsection()
