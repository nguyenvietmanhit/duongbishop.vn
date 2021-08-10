@extends('frontends.layouts.main')
@section('content')
    <div class="product-page container">
        @include('includes.breadcrumb', ['breadcrumbs' => [
          0 => [
            'title' => 'Trang chủ',
            'link' => url('/')
        ],
        1 => [
        'title' => 'Danh sách sản phẩm',
            'link' => url('danh-sach-san-pham.html')
        ],
        2 => [
        'title' => $product['name'],
            'active' => TRUE
        ],
        ]])
        <div class="row">
            <div class="detail-content-wrap con-md-8 col-sm-8 col-xs-12">
                <h2 class="news-title">
                    {{ $product['name'] }}
                </h2>
                <div class="avatar-product">
                    <img src="{{ asset('uploads/' . $product['avatar']) }}"
                         title="{{ $product['name'] }}"
                         alt="{{ $product['name'] }}"
                         class="img-responsive">
                </div>
                <div class="product-social">
                    @include('includes.social', ['current_url' => url()->current()])
                </div>
                {{--                <div id="showmore-1" data-showmore="" style="max-width:769.996px;">--}}
                <div class="detail-description">
                    {!! $product['content'] !!}
                </div>

                {{--                <div class="news-tags">--}}
                {{--                    <h5 class="tags-title">Tags: </h5>--}}
                {{--                    <h4 class="tags-item">--}}
                {{--                        <a href="/tags/ke-hoach-to-chuc-da-ngoai.2015.tgs" title="kế hoạch tổ chức dã ngoại"--}}
                {{--                           class="tags-link">--}}
                {{--                            kế hoạch tổ chức dã ngoại </a>--}}
                {{--                    </h4>--}}
                {{--                    <h4 class="tags-item">--}}
                {{--                        <a href="/tags/chuan-bi-gi-di-da-ngoai.2022.tgs" title="chuẩn bị gì đi dã ngoại"--}}
                {{--                           class="tags-link">--}}
                {{--                            chuẩn bị gì đi dã ngoại </a>--}}
                {{--                    </h4>--}}
                {{--                    <h4 class="tags-item">--}}
                {{--                        <a href="/tags/dia-diem-cam-trai-gan-ha-noi.2131.tgs" title="địa điểm cắm trại gần hà nội"--}}
                {{--                           class="tags-link">--}}
                {{--                            địa điểm cắm trại gần hà nội </a>--}}
                {{--                    </h4>--}}
                {{--                    <h4 class="tags-item">--}}
                {{--                        <a href="/tags/di-cam-trai-can-gi.2223.tgs" title="đi cắm trại cần gì" class="tags-link">--}}
                {{--                            đi cắm trại cần gì </a>--}}
                {{--                    </h4>--}}
                {{--                    <h4 class="tags-item">--}}
                {{--                        <a href="/tags/nhung-vat-dung-can-thiet-khi-di-cam-trai.2224.tgs"--}}
                {{--                           title="những vật dụng cần thiết khi đi cắm trại" class="tags-link">--}}
                {{--                            những vật dụng cần thiết khi đi cắm trại </a>--}}
                {{--                    </h4>--}}
                {{--                </div>--}}
                <div class="detail-comment">
                    <h4 class="link-category-item">Bình luận</h4>
                    <div class="fb-comments" data-href="<?php echo url()->current(); ?>" data-width="100%"
                         data-numposts="5"></div>
                </div>
            </div>
            <div class="news-relative-wrap col-md-4 col-sm-4 col-xs-12">
                <h2 class="link-category-item">Sản phẩm khác</h2>
                <ul class="news-relative">
                    @foreach($product_relatives AS $product)
                        <li>
                            <a href="{{ Helper::getUrlFriendlyProduct($product['name'], $product['id']) }}"
                               class="news-relative-link" title="{{ $product['name'] }}">
                                <img
                                    src="{{ asset('uploads/' . $product['avatar'] ) }}"
                                    alt="{{ $product['name'] }}" class="detail-relative-img"
                                    title="{{ $product['name'] }}">
                            </a>
                            <h2 class="detail-relative-content">
                                <a href="{{ Helper::getUrlFriendlyProduct($product['name'], $product['id']) }}">
                                {{ $product['name'] }}
                            </h2>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
