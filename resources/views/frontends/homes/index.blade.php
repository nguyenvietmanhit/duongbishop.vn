@extends('frontends.layouts.main')
@section('content')
    <div class="home-page page-common">
        <div class="intro-wrap">
            @if($page_top)
                <div class="intro container hover-show-edit">
                    @include('includes.link_edit_admin', [
                      'link_edit' => url('admin/page/edit/' . $page_top['id']),
                      'title' => 'Chỉnh sửa khối nội dung này',
                    ])
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-12">
                            <img src="{{ asset('uploads/' . $page_top['avatar']) }}" class="img-responsive"/>
                        </div>
                        <div class="col-md-7 col-sm-7 col-12">
                            {!! $page_top['content'] !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>


        <div class="product-wrap">
            <div class="product container">
                <h1 class="post-list-title ">
                    Danh sách sản phẩm mẫu <a href="{{ url('san-pham.html') }}" class="link-all">Xem tất cả</a>
                </h1>
                <div class="note-product text-center">
                    Để xem ảnh dạng slide, click vào ảnh. Xem chi tiết sản phẩm, click tên bài viết
                </div>
                <div class="row">
                    @foreach($products AS $product)
                        <div class="col-md-4 col-sm-4 col-xs-12 hover-show-edit product-item">
                            @include('includes.product_item', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @foreach ($product_by_categories AS $categories)
                <div class="product-wrap">
                    <div class="product container">
                        <h1 class="post-list-title ">
                            Sản phẩm theo danh mục
                            <strong>{{ $categories['category_name'] }}</strong>
                            <a href="{{ Helper::getUrlFriendlyCategory($categories['category_name'], $categories['category_id']) }}" class="link-all">Xem tất cả</a>
                        </h1>
                        <div class="note-product text-center">
                            Để xem ảnh dạng slide, click vào ảnh. Xem chi tiết sản phẩm, click tên bài viết
                        </div>
                        <div class="row">
                            @foreach($categories['products'] AS $product)
                                @php($product['is_product_by_category'] = TRUE)
                                <div class="col-md-4 col-sm-4 col-xs-12 hover-show-edit product-item">
                                    @include('includes.product_item', ['product' => $product])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        @endforeach

        <div class="news-wrap">
            <div class="news container">
                <h1 class="post-list-title ">
                    <a href="{{ asset('tin-tuc.html') }}" class="link-category-item">TIN TỨC MỚI NHẤT</a>
                </h1>

                <div class="row">
                    @foreach ($news AS $new)
                        <div class="col-md-4 col-sm-4 col-xs-12 category-two-item ">
                            <a href="{{ Helper::getUrlFriendlyNews($new['name'], $new['id']) }}"
                               class="two-item-link-heading">
                            <span class="new-image-content">
                                    <img src="{{ asset('uploads/' . $new['avatar']) }}"
                                         title="{{ $new['name']  }}"
                                         alt="{{ $new['name']  }}"
                                         class="post-image-avatar img-responsive">
                            </span>
                            </a>
                            <div class="news-content-wrap">
                                <h2 class="category-heading timeline-post-title text-center">
                                    <a href="{{ Helper::getUrlFriendlyNews($new['name'], $new['id']) }}">
                                        {{ $new['name']  }}
                                    </a>
                                </h2>
                                {{--                                <div class="news-description">--}}

                                {{--                                </div>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="map-wrap">
            <div class="map container">
                @include('includes.map_item')
            </div>
        </div>
    </div>    <!--    END MAIN CONTENT-->
@endsection()
