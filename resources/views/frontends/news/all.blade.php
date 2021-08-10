@extends('frontends.layouts.main')
@section('content')
    <div class="news-all container">
        @include('includes.breadcrumb', ['breadcrumbs' => [
          0 => [
            'title' => 'Trang chủ',
            'link' => url('/')
        ],
        1 => [
        'title' => 'Danh sách tin tức',
            'active' => TRUE
        ],
        ]])
        <h1 class="post-list-title hover-show-edit">
            Danh sách tin tức
        </h1>
{{--        <div class="note-news text-center">--}}
{{--            Để xem ảnh dạng slide, click vào ảnh. Xem chi tiết sản phẩm, click tên bài viết--}}
{{--        </div>--}}
        <div class="row">
            @foreach($news AS $new)
                <div class="col-md-4 col-sm-4 col-xs-12 hover-show-edit news-item">
                    @include('includes.news_item', ['new' => $new])
                </div>

            @endforeach
        </div>
        {{ $news->links() }}
    </div>
@endsection()
