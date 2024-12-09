@extends('frontends.layouts.main')
@section('content')
    <div class="product-all container">
        @include('includes.breadcrumb', ['breadcrumbs' => [
          0 => [
            'title' => 'Trang chủ',
            'link' => url('/')
        ],
        1 => [
          'title' => isset($category) ? $category['name'] : isset($title) ? $title : '#',
            'link' => isset($category) ? Helper::getUrlFriendlyCategory($category['name'], $category['id']) : '#'
        ],
        2 => [
        'title' => 'Danh sách acc',
            'active' => TRUE
        ],
        ]])
        <h1 class="post-list-title hover-show-edit">
            {{ isset($title) ? $title : 'Tất cả acc' }}
            @if(isset($search) && $search)
                tìm thấy với từ khóa <strong>{{ $search }}</strong>
            @endif
            @if(isset($category))
                của danh mục <strong>{{ $category['name'] }}</strong>
            @endif
        </h1>
        @if($products->total() > 0)
{{--            <div class="note-product text-center">--}}
{{--                Để xem ảnh dạng slide, click vào ảnh. Xem chi tiết sản phẩm, click tên bài viết--}}
{{--            </div>--}}
            <div class="row">
                @foreach($products AS $product)
                    <div class="col-md-4 col-sm-4 col-xs-12 hover-show-edit product-item">
                        @include('includes.product_item', ['product' => $product])
                    </div>

                @endforeach
            </div>
            {{ $products->links() }}
        @else
            <h3 class="text-center">
                Không có sản phẩm nào
            </h3>
        @endif
    </div>
@endsection()
