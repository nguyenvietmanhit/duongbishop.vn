@extends('frontends.layouts.main')
@section('content')
    <div class="product-page container">
        @include('includes.breadcrumb', ['breadcrumbs' => [
          0 => [
            'title' => 'Trang chủ',
            'link' => url('/')
        ],
        1 => [
        'title' => 'Danh sách tin tức',
            'link' => url('tin-tuc.html')
        ],
        2 => [
        'title' => $news['name'],
            'active' => TRUE
        ],
        ]])
        <div class="row">
            <div class="detail-content-wrap con-md-8 col-sm-8 col-xs-12">
                <h2 class="news-title">
                    {{ $news['name'] }}
                </h2>
                <div class="avatar-product">
                    <img src="{{ asset('uploads/' . $news['avatar']) }}"
                         title="{{ $news['name'] }}"
                         alt="{{ $news['name'] }}"
                         class="img-responsive">
                </div>
                <div class="product-social">
                    @include('includes.social', ['current_url' => url()->current()])
                </div>
                {{--                <div id="showmore-1" data-showmore="" style="max-width:769.996px;">--}}
                <div class="detail-description">
                    {!! $news['content'] !!}
                </div>
                <div class="detail-comment">
                    <h4 class="link-category-item">Bình luận</h4>
                    <div class="fb-comments" data-href="<?php echo url()->current(); ?>" data-width="100%"
                         data-numposts="5"></div>
                </div>
            </div>
            <div class="news-relative-wrap col-md-4 col-sm-4 col-xs-12">
                <h2 class="link-category-item">Tin tức khác</h2>
                <ul class="news-relative">
                    @foreach($news_relatives AS $news)
                        <li>
                            <a href="{{ Helper::getUrlFriendlyProduct($news['name'], $news['id']) }}"
                               class="news-relative-link" title="{{ $news['name'] }}">
                                <img
                                    src="{{ asset('uploads/' . $news['avatar'] ) }}"
                                    alt="{{ $news['name'] }}" class="detail-relative-img"
                                    title="{{ $news['name'] }}">
                            </a>
                            <h2 class="detail-relative-content">
                                <a href="{{ Helper::getUrlFriendlyProduct($news['name'], $news['id']) }}">
                                {{ $news['name'] }}
                            </h2>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
