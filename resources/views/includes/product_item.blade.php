@include('includes.link_edit_admin', [
  'link_edit' => url('admin/product/edit/' . $product['id']),
  'title' => 'Sửa acc này',
  'link_create' =>  url('admin/product/create'),
])
<div class="wrap-img">
    <a href="{{ url(Helper::getUrlFriendlyProduct($product['name'], $product['id'])) }}"
       {{--       rel="gallery-1" class="swipebox"--}}
       title="{{ $product['name'] }}">
        @if($product['code'])
            <span class="product-code">
            MS: {{ $product['code'] }}
        </span>
        @endif
        <div class="img-container">

            <img src="{{ asset('uploads/' . $product['avatar']) }}"
                 title="{{ $product['name'] }}"
                 alt="{{ $product['name'] }}"
                 class="img-responsive product-avatar">
        </div>

        {{--    @if(!isset($product['is_product_by_category']))--}}
        {{--        @php--}}
        {{--            $category = \App\Models\Category::where('id', $product['category_id'])->first()->toArray();--}}
        {{--        @endphp--}}
        {{--        <a href="{{ Helper::getUrlFriendlyCategory($category['name'], $category['id']) }}" class="category-link"--}}
        {{--           title="Xem tất cả sản phẩm của danh mục: {{ $category['name'] }}">--}}
        {{--            {{ $category['name'] }}--}}
        {{--        </a>--}}
        {{--    @endif--}}
            <div class="info-ul">
                <strong>Thể loại</strong>: <span
                    class="text-red">{{ $product['type'] }}</span>
            </div>
            <div class="info-ul">
                <strong>Thông tin</strong>: <span
                    class="text-red">{{  $product['name'] }}</span>
            </div>
{{--        <h3 class="product-title">--}}
{{--            --}}{{--        <a href="{{ url(Helper::getUrlFriendlyProduct($product['name'], $product['id'])) }}"--}}
{{--            --}}{{--           title="Xem chi tiết {{ $product['name'] }}">--}}
{{--            {{ Helper::truncateStringByDot($product['name']) }}--}}

{{--            --}}{{--        </a>--}}
{{--        </h3>--}}

        <div class="info-ul">
            <strong>Số Vip</strong>: <span
                class="text-red">{{ $product['vip_total'] ? $product['vip_total'] : 0 }}</span>
            | <strong>Vip Ingame</strong>: <span
                class="text-red">{{ $product['vip_ingame'] ? $product['vip_ingame'] : 0 }}</span>
        </div>
        {{--        <ul class="info-ul">--}}
        {{--            <li>--}}
        {{--                <strong>Số Vip</strong>: <span class="text-red">{{ $product['vip_total'] ? $product['vip_total'] : 0 }}</span>--}}
        {{--            </li>--}}
        {{--            <li>--}}
        {{--                <strong>Vip Ingame</strong>: <span class="text-red">{{ $product['vip_ingame'] ? $product['vip_ingame'] : 0 }}</span>--}}
        {{--            </li>--}}
        {{--        </ul>--}}

    </a>
    <div class="price-box">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-12">
                <div class="format-price menu-active btn btn-danger">
                    {{ number_format($product['price'], NULL, NULL, '.') }}đ
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <a class="btn-detail btn btn-danger"
                   href="{{ url(Helper::getUrlFriendlyProduct($product['name'], $product['id'])) }}">Chi tiết</a>
            </div>
        </div>
    </div>
</div>
