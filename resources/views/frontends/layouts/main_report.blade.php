@php
    $base_url = Helper::getDomain();
    $current_url = $base_url . $_SERVER['REQUEST_URI'];

//echo "<pre>" . __LINE__ . " " . __FILE__ . "<br />";print_r(storage_path('/fonts/SFUGoudyMedium.TTF'));echo "</pre>";die;
@endphp
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('/images/thansohoc_logo.jpg') }}" type="image/icon type">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Helper::getTitlePage() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    {{--<!-- Font Awesome -->--}}
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/style_report.css?v=' . time()) }}">

    <!-- Google Font -->
    {{--<link rel="stylesheet"--}}
    {{--href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}

    {{--<link rel="canonical" href="{{ $base_url }}"/>--}}
    {{--<link rel="alternate" href="{{ $base_url }}" hreflang="vi-vn"/>--}}

    {{--<meta name="robots" content="index,follow,noodp">--}}
    {{--<meta property="og:rich_attachment" content="true"/>--}}
    {{--<meta name="author" content="{{ $base_url }}">--}}
    {{--<meta name="copyright" content="{{ $base_url }}">--}}

    <!--    META FOR FACEBOOK-->
    {{--<meta property="og:url" content="{{ $current_url }}"/>--}}
    {{--<meta property="og:type" content="website"/>--}}
    {{--<meta property="og:title" content="{{ Helper::getSeoTitle() }}"/>--}}
    {{--<meta property="og:description" content="{{ Helper::getSeoDescription() }}"/>--}}
    {{--<meta property="og:image" content=""/>--}}
    {{--<!-- SEO META DESCRIPTION -->--}}
    {{--<meta name="title" content="{{ Helper::getSeoTitle() }}">--}}
    {{--<meta name="keywords" content="{{ Helper::getSeoKeyword() }}">--}}
    {{--<meta name="description" content="{{ Helper::getSeoDescription() }}"/>--}}
</head>
<body class="main-report">
{{--<a href="{{ Helper::$url_print_pdf }}" title="In file PDF">--}}
    {{--<img src="{{ asset('images/print-pdf.png') }}" class="print-pdf"/>--}}
{{--</a>--}}
<div class="wrap-content">
    @yield('content')
</div>
<!-- /.content -->


<!-- jQuery 3 -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/script.js?v=' . time()) }}"></script>
</body>
</html>
