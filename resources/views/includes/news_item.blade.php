@include('includes.link_edit_admin', [
  'link_edit' => url('admin/new/edit/' . $new['id']),
  'title' => 'Sửa tin tức này',
  'link_create' =>  url('admin/new/create'),
])
<div class="wrap-img">
    <a href="{{ Helper::getUrlFriendlyNews($new['name'], $new['id']) }}"
       title="{{ $new['name'] }}">
        <img src="{{ asset('uploads/' . $new['avatar']) }}"
             title="{{ $new['name'] }}"
             alt="{{ $new['name'] }}"
             class="img-responsive product-avatar">
    </a>
    <h3 class="product-title">
        <a href="{{ Helper::getUrlFriendlyNews($new['name'], $new['id']) }}"
           title="Xem chi tiết {{ $new['name'] }}">
            {{ $new['name'] }}
        </a>
    </h3>
</div>
