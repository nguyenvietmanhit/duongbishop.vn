@php($page = isset($page) ? $page : 1)
{{--<div class="form-group">--}}
<div class="element-add-more">

    <label for="content">Trang {{ $page }}</label>
    @if($page > 1)
        <i class="link-remove fa fa-trash" title="Xóa trang này"></i>
    @endif
    <textarea class="form-control" name="{{ $textarea_name }}"
              id="{{ $textarea_id }}">{!! $textarea_value !!}</textarea>

    <div class="content-empty hide">
        <div class="page-26 page-dynamic page-common">
            <div class="page-26-content page-content">
                <div class="page-26-des"></div>
            </div>
        </div>

    </div>
</div>
{{--</div>--}}

<?php

?>