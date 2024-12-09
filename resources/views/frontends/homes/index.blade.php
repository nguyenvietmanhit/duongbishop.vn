@extends('frontends.layouts.main')
@section('content')
    <div class="home-page page-common">
        <div class="intro-wrap">
            @if($page_top)
                <div class="intro container ">

                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-12 hover-show-edit">
                            @include('includes.link_edit_admin', [
                      'link_edit' => url('admin/page/edit/' . $page_top['id']),
                      'title' => 'Chỉnh sửa khối nội dung này',
                    ])
                            <div class="top-content-left">
                                {!! $page_top['content'] !!}
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-12 hover-show-edit">
                            @include('includes.link_edit_admin', [
                      'link_edit' => url('admin/page/edit/' . $page_top_video['id']),
                      'title' => 'Chỉnh sửa video này',
                    ])
                            {!! $page_top_video['content'] !!}
                            {{--                            <img src="{{ asset('uploads/' . $page_top['avatar']) }}" class="img-responsive"/>--}}
{{--                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/0nc0CzIGrxA"--}}
{{--                                    title="YouTube video player" frameborder="0"--}}
{{--                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
{{--                                    allowfullscreen></iframe>--}}
                        </div>

                    </div>
                </div>
            @endif
        </div>


        <div class="product-wrap">
            <div class="product container">
                <h1 class="post-list-title ">
                    Acc Shop Còn
                    {{--                    <a href="{{ url('danh-sach-acc.html') }}" class="link-all">Xem tất cả acc</a>--}}
                </h1>
                <form method="GET" action="" class="form-search">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-12">
                            <input type="text" name="name" value="{{ $price = app('request')->input('name') }}"
                                   placeholder="Tìm theo mã acc, VD: 01" class="form-control"/>
                        </div>
                        <div class="col-md-3 col-sm-3 col-12">
                            <select name="price" class="form-control">
                                @php
                                    $price = app('request')->input('price');
                                    $price_none = $price_1 = $price_2 = $price_3 = $price_4 = '';
                                    switch ($price) {
                                      case -1: $price_none = 'selected';break;
                                      case 1: $price_1 = 'selected';break;
                                      case 2: $price_2 = 'selected';break;
                                      case 3: $price_3 = 'selected';break;
                                      case 4: $price_4 = 'selected';break;
                                    }
                                @endphp
                                <option value="-1" {{ $price_none }}>--Tìm theo khoảng giá--</option>
                                <option value="1" {{ $price_1 }}>Dưới 1 triệu</option>
                                <option value="2" {{ $price_2 }}>Từ 1 - 2 triệu</option>
                                <option value="3" {{ $price_3 }}>Từ 2 - 3 triệu</option>
                                <option value="4" {{ $price_4 }}>Trên 3 triệu</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-12">
                            @php
                                $vip_ingame = app('request')->input('vip_ingame');
                            @endphp
                            <select name="vip_ingame" class="form-control">
                                <option value="-1">--Tìm Vip Ingame--</option>
                                @for($i = 1; $i <= 8; $i++)
                                    @php
                                        $selected = $vip_ingame == $i ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $i }}" {{ $selected }}>Vip {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-12">
                            <input type="submit" name="search" value="Tìm kiếm" class="btn-search btn btn-primary"/>
                            <a href="{{ url('/') }}" class="btn btn-default">Hủy tìm</a>
                        </div>
                    </div>
                </form>
                {{--                <div class="note-product text-center">--}}
                {{--                    Để xem ảnh dạng slide, click vào ảnh. Xem chi tiết sản phẩm, click tên bài viết--}}
                {{--                </div>--}}
                @if(count($products) > 0)
                    {{ $products->links() }}
                    <div class="row">
                        @foreach($products AS $product)
                            <div class="col-md-3 col-sm-3 col-xs-12 hover-show-edit product-item">
                                @include('includes.product_item', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                    {{ $products->links() }}
                @else
                    <h3 class="text-center">Không tìm thấy acc nào</h3>
                @endif
            </div>
        </div>


        {{--        @foreach ($product_by_categories AS $categories)--}}
        {{--            <div class="product-wrap">--}}
        {{--                <div class="product container">--}}
        {{--                    <h1 class="post-list-title ">--}}
        {{--                        Sản phẩm theo danh mục--}}
        {{--                        <strong>{{ $categories['category_name'] }}</strong>--}}
        {{--                        <a href="{{ Helper::getUrlFriendlyCategory($categories['category_name'], $categories['category_id']) }}"--}}
        {{--                           class="link-all">Xem tất cả</a>--}}
        {{--                    </h1>--}}
        {{--                    <div class="note-product text-center">--}}
        {{--                        Để xem ảnh dạng slide, click vào ảnh. Xem chi tiết sản phẩm, click tên bài viết--}}
        {{--                    </div>--}}
        {{--                    <div class="row">--}}
        {{--                        @foreach($categories['products'] AS $product)--}}
        {{--                            @php($product['is_product_by_category'] = TRUE)--}}
        {{--                            <div class="col-md-4 col-sm-4 col-xs-12 hover-show-edit product-item">--}}
        {{--                                @include('includes.product_item', ['product' => $product])--}}
        {{--                            </div>--}}
        {{--                        @endforeach--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        @endforeach--}}

        {{--        <div class="news-wrap">--}}
        {{--            <div class="news container">--}}
        {{--                <h1 class="post-list-title ">--}}
        {{--                    <a href="{{ asset('tin-tuc.html') }}" class="link-category-item">TIN TỨC MỚI NHẤT</a>--}}
        {{--                </h1>--}}

        {{--                <div class="row">--}}
        {{--                    @foreach ($news AS $new)--}}
        {{--                        <div class="col-md-4 col-sm-4 col-xs-12 category-two-item ">--}}
        {{--                            <a href="{{ Helper::getUrlFriendlyNews($new['name'], $new['id']) }}"--}}
        {{--                               class="two-item-link-heading">--}}
        {{--                            <span class="new-image-content">--}}
        {{--                                    <img src="{{ asset('uploads/' . $new['avatar']) }}"--}}
        {{--                                         title="{{ $new['name']  }}"--}}
        {{--                                         alt="{{ $new['name']  }}"--}}
        {{--                                         class="post-image-avatar img-responsive">--}}
        {{--                            </span>--}}
        {{--                            </a>--}}
        {{--                            <div class="news-content-wrap">--}}
        {{--                                <h2 class="category-heading timeline-post-title text-center">--}}
        {{--                                    <a href="{{ Helper::getUrlFriendlyNews($new['name'], $new['id']) }}">--}}
        {{--                                        {{ $new['name']  }}--}}
        {{--                                    </a>--}}
        {{--                                </h2>--}}
        {{--                                --}}{{--                                <div class="news-description">--}}

        {{--                                --}}{{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    @endforeach--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}


        {{--        <div class="map-wrap">--}}
        {{--            <div class="map container">--}}
        {{--                @include('includes.map_item')--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>    <!--    END MAIN CONTENT-->
@endsection()
