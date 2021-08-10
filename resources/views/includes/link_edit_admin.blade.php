<?php

if (!isset($link_edit)) {
  $link_edit = '#';
}

if (!isset($title)) {
  $title = 'Chỉnh sửa nội dung này';
}

if (!isset($title_create)) {
  $title_create = 'Thêm mới nội dung kiểu này';
}
if (!isset($link_create)) {
  $link_create = '';
}
?>
@if (\App\Models\Role::isCurrentAdmin())
    <style>
        .hover-show-edit {
            position: relative;
            transition: all 0.5s;
        }

        .hover-show-edit:hover {
            box-shadow: 0px 0px 15px 5px #6f6d6dab;
            z-index: 120 !important;
        }
    </style>
    <a class="icon-edit" href="{{ $link_edit }}" title="{{ $title }}" target="_blank">
        <i class="fa fa-pencil-alt"></i>
    </a>

    @if ($link_create)
        <a class="icon-add icon-edit" href="{{ $link_create }}" title="{{ $title_create }}" target="_blank">
            <i class="fa fa-plus"></i>
        </a>
    @endif
@endif
