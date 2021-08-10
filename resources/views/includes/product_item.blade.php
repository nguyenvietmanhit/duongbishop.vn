@include('includes.link_edit_admin', [
  'link_edit' => url('admin/product/edit/' . $product['id']),
  'title' => 'Sửa sản phẩm này',
  'link_create' =>  url('admin/product/create'),
])
<div class="wrap-img">
    <a href="{{ asset('uploads/' . $product['avatar']) }}"
       rel="gallery-1" class="swipebox"
       title="{{ $product['name'] }}">
        <img src="{{ asset('uploads/' . $product['avatar']) }}"
             title="{{ $product['name'] }}"
             alt="{{ $product['name'] }}"
             class="img-responsive product-avatar">

    </a>
    @if(!isset($product['is_product_by_category']))
        @php
            $category = \App\Models\Category::where('id', $product['category_id'])->first()->toArray();
        @endphp
        <a href="{{ Helper::getUrlFriendlyCategory($category['name'], $category['id']) }}" class="category-link"
           title="Xem tất cả sản phẩm của danh mục: {{ $category['name'] }}">
            {{ $category['name'] }}
        </a>
    @endif
    <h3 class="product-title">
        <a href="{{ url(Helper::getUrlFriendlyProduct($product['name'], $product['id'])) }}"
           title="Xem chi tiết {{ $product['name'] }}">
            {{ $product['name'] }}
        </a>
    </h3>
</div>
