@php
    $base_url = Helper::getDomain();
    $current_url = $base_url . $_SERVER['REQUEST_URI'];
$user = session()->get('user');
@endphp

    <!DOCTYPE html>
<html lang="en">
<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3166898655054428"
            crossorigin="anonymous"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3FB4PL8MCF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-3FB4PL8MCF');
    </script>

    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Helper::getSeoTitle() }}</title>
    <link rel="canonical" href="{{ $base_url }}"/>
    <link rel="alternate" href="{{ $base_url }}" hreflang="vi-vn"/>
    <meta name="robots" content="index,follow,noodp">
    <meta property="og:rich_attachment" content="true"/>
    <meta name="author" content="{{ Helper::getSeoTitle() }}">
    <meta name="copyright" content="{{ Helper::getSeoTitle() }}"/>

    <!--    META FOR FACEBOOK-->
    <meta property="og:url" content="{{ $base_url }}/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ Helper::getSeoTitle() }}"/>
    <meta property="og:description" content="{{ Helper::getSeoKeyword() }}"/>
    <meta property="og:image"
          content="{{ asset('images/favicon.png') }}"/>
    <!-- SEO META DESCRIPTION -->
    <meta name="title" content="{{ Helper::getSeoTitle() }}">
    <meta name="keywords" content="{{ Helper::getSeoKeyword() }}">
    <meta name="description" content="{{ Helper::getSeoDescription() }}"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700,900&amp;subset=latin-ext"
          rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Tooltip plugin (zebra) css file -->
    <link rel="stylesheet" href="{{ asset('css/zebra_tooltips.min.css') }}"/>
    <!-- Owl Carousel plugin css file. only used pages -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>

    <!-- Ideabox responsive css file -->
    <link rel="stylesheet" href="{{ asset('css/responsive-style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/swipebox.min.css') }}"/>
<!--    <link rel="stylesheet" href="{{ asset('') }}css/slider-pro.min.css"/>-->
    <!-- Ideabox main theme css file. you have to add all pages -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>

<body class="admin-group">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=538688320350821&autoLogAppEvents=1" nonce="mEHwIU4W"></script>

<!-- Messenger Plugin chat Code -->
{{--<div id="fb-root"></div>--}}
<!-- Your Chat Plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "108390100774855");
    chatbox.setAttribute("attribution", "biz_inbox");

    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v11.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<a href="#" class="scrollup"></a>
<div class="header-top nopc">
    <div class="container">
        <div class="row">
            <div class=" col-md-3 col-sm-3 col-xs-12">
                <div class="page">
                    <a href="{{ url('/') }}" class="home-link material-button submenu-toggle">
                        {{--                        <img src="/image_static/mg_sid_67/mg2e/1a18/mg2e1a18171a1d18/mg2e1a18171a1d18.png"--}}
                        {{--                             class="logo-banner">--}}
                        {{ env('APP_NAME') }}
                    </a>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <ul class="header-navigation" data-show-menu-on-mobile="">

                    <li class="">
                        <div class="phone-number">
                            <a class="phone-contact menu-active" title="Click trên điện thoại để gọi trực tiếp"
                               href="tel:0866776636"><i
                                    class="fa fa-phone-alt"></i> 08 6677 6636
                            </a>
                            <a class="phone-contact menu-active" title="Click để truy cập Fanpage" target="_blank"
                               href="https://www.facebook.com/DuongBiNano"><i
                                    class="fab icon-contact fa-facebook-square"></i> Fanpage
                            </a>
                        </div>
                    </li>
                    @if(!session()->get('user'))
                        <li>
                            <a href="{{ url('user/login') }}" class="contact-mail-top contact-link email-contact">
                                Đăng nhập
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Chào bạn, <strong>{{ session()->get('user')->username }}</strong>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ url('user/profile') }}">Thông tin tài khoản</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('user/logout') }}">Thoát</a>
                            </div>
                        </li>
                        @if(\App\Models\Role::isRoleAdmin(session()->get('user')->role_id))
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ url('admin/products') }}">
                                    Admin
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<span class="ajax-message"></span>
<!-- header start -->
<header class="header">

    <div class="header-wrapper container">
        <!--sidebar menu toggler start -->
        <div class="toggle-sidebar material-button">
            <i class="material-icons">&#xE5D2;</i>
        </div>
        <!--sidebar menu toggler end -->

        <!--logo start -->
        <div class="logo-box">
            <a href="/" class="logo">
                {{--                {{ env('APP_NAME') }}--}}
            </a>
        </div>
        <!--logo end -->


        <div class="header-menu">
            <ul class="header-navigation page" data-show-menu-on-mobile="">
                <li><a class='menu-link1' href='{{ url('/') }}'> Trang chủ</a></li>
                <li><a class='menu-link1' href='{{ url('huong-dan-mua-acc.html') }}'>Hướng dẫn mua acc</a></li>
                <li><a class='menu-link1' href='{{ url('huong-dan-thay-doi-tttk.html') }}'>Hướng dẫn đổi thông tin
                        acc</a></li>
                <li><a class='menu-link1' href='{{ url('can-ban-acc.html') }}'>Cần bán hay thuê acc CF?</a></li>
                <li><a class='menu-link1' href='{{ url('acc-da-ban.html') }}'>Các acc shop đã bán</a></li>
                {{--                --}}{{--                <li><a class='menu-link1' href='{{ url('danh-sach-acc.html') }}'> Sản phẩm</a></li>--}}
                {{--                <li><a class="material-button submenu-toggle menu-link1" href="{{ url('danh-sach-acc.html') }}">--}}
                {{--                        Sản phẩm <span class="fa fa-angle-down"></span></a>--}}
                {{--                    <div class="header-submenu">--}}
                {{--                        @php--}}
                {{--                            // Lấy danh sách danh mục đang có trên hệ thống--}}
                {{--                            $categories = \App\Models\Category::all()->pluck('name', 'id')->toArray();--}}
                {{--                        @endphp--}}
                {{--                        <ul>--}}
                {{--                            @foreach ($categories AS $category_id => $category_name)--}}
                {{--                                <li><a class="menu-link2"--}}
                {{--                                       href="{{ Helper::getUrlFriendlyCategory($category_name, $category_id) }}">--}}
                {{--                                        {{ $category_name }}--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}
                {{--                                @endforeach--}}
                {{--                                </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li><a class='menu-link1' href='{{ url('ban-do.html') }}'> Bản đồ</a></li>--}}
                {{--                <li><a class='menu-link1' href='{{ url('tin-tuc.html') }}'> Tin tức</a></li>--}}
            </ul>            <!-- header left menu end -->
        </div>
        <div class="header-right with-seperator">
            <div class="phone-number">
                <a class="phone-contact menu-active" title="Click trên điện thoại để gọi trực tiếp"
                   href="tel:0866776636"><i class="fa fa-phone-alt"></i> 08 6677 6636
                </a>
                <a class="phone-contact menu-active" title="Click để truy cập Fanpage" target="_blank"
                   href="https://www.facebook.com/DuongBiNano"><i class="fab icon-contact fa-facebook-square"></i>
                    Fanpage
                </a>
            </div>
            <!-- header right menu start -->
        {{--            <ul class="header-navigation">--}}
        {{--                <li>--}}
        {{--                    <a href="#" class="material-button search-toggle"><i class="material-icons"></i></a>--}}
        {{--                </li>--}}
        {{--            </ul>--}}
        <!-- header right menu end -->

        </div>

        {{--        <div class="search-bar">--}}
        {{--            <form class="search-form" action="{{ url('/tim-kiem-danh-sach-acc.html') }}" method="GET">--}}
        {{--                <div class="search-input-wrapper">--}}
        {{--                    <input type="text" name="search" placeholder="Nhập Thông tin acc..."--}}
        {{--                           class="search-input">--}}
        {{--                    <button type="submit" name="filter" class="search-submit"><i class="material-icons">&#xE5C8;</i>--}}
        {{--                    </button>--}}
        {{--                </div>--}}
        {{--                <span class="search-close search-toggle">--}}
        {{--						<i class="material-icons">&#xE5CD;</i>--}}
        {{--					</span>--}}
        {{--            </form>--}}
        {{--        </div>--}}

    </div>
</header>
<div class="sidebar">
    <div class="sidebar-wrapper">

        <!-- side menu logo start -->
        <div class="sidebar-logo">
            <a href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
            <div class="sidebar-toggle-button">
                <i class="material-icons">&#xE317;</i>
            </div>
        </div>
        <!-- side menu logo end -->
        <!-- mobile menu start -->
        <ul class="sidebar-menu">
            <li><a class='menu-link1' href='{{ url('/') }}'> Trang chủ</a></li>
            <li><a class='menu-link1' href='{{ url('huong-dan-mua-acc.html') }}'>Hướng dẫn mua acc</a></li>
            <li><a class='menu-link1' href='{{ url('huong-dan-thay-doi-tttk.html') }}'>Hướng dẫn đổi thông tin acc</a>
            </li>
            <li><a class='menu-link1' href='{{ url('can-ban-acc.html') }}'>Cần bán hay thuê acc CF?</a></li>
            <li><a class='menu-link1' href='{{ url('acc-da-ban.html') }}'>Các acc shop đã bán</a></li>
            {{--            <li><a class='menu-link1' href='{{ url('ban-do.html') }}'> Bản đồ</a></li>--}}
            {{--            <li><a class='menu-link1' href='{{ url('tin-tuc.html') }}'> Tin tức</a></li>--}}
        </ul>
        <ul class="sidebar-menu">
            @if(!session()->get('user'))
                <li>
                    <a href="{{ url('user/login') }}" class="contact-mail-top contact-link email-contact">
                        Đăng nhập
                    </a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Chào bạn, <strong>{{ session()->get('user')->username }}</strong>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ url('user/profile') }}">Thông tin tài khoản</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('user/logout') }}">Thoát</a>
                    </div>
                </li>
                @if(\App\Models\Role::isRoleAdmin(session()->get('user')->role_id))
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ url('admin/products') }}">
                            Admin
                        </a>
                    </li>
                @endif
            @endif
            <li>
                <a class="phone-contact menu-active" title="Click trên điện thoại để gọi trực tiếp"
                   href="tel:0866776636"><i
                        class="fa fa-phone-alt"></i> 08 6677 6636
                </a>
                <a class="phone-contact menu-active" title="Click để truy cập Fanpage" target="_blank"
                   href="https://www.facebook.com/DuongBiNano"><i class="fab icon-contact fa-facebook-square"></i>
                    Fanpage
                </a>
        </ul>

        <!-- sidebar menu end -->
    </div>
</div>
<div class="main-errors container">
    @include('includes.error')
</div>
<div class="main-content">
    @yield('content')
</div>
<!-- header end -->

<div class="footer">
    <!-- count particles -->
    <!--    <div class="footer-overlay">-->
    <!--    </div>-->

    <!-- particles.js container -->
    <!--    <div id="particles-js"></div>-->
    <div class="container footer-container">
        <div class="row">

            <div class="image-footer-wrap col-md-5 page">
                <strong>Thông tin liên hệ</strong>

                <table class="table table-responsive">
                    <tr>
                        <th class="page">
                            Điện thoại
                        </th>
                        <td>
                            <div class="page">
                                <a class="phone-contact menu-active" title="Click trên điện thoại để gọi trực tiếp"
                                   href="tel:0866776636"><i
                                        class="fa fa-phone-alt"></i> 08 6677 6636
                                </a>
                                <a class="phone-contact menu-active" title="Click để truy cập Fanpage" target="_blank"
                                   href="https://www.facebook.com/DuongBiNano"><i
                                        class="fab icon-contact fa-facebook-square"></i> Fanpage
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="info-custom hover-show-edit">
                    @php
                        $page_top_info_custom = \App\Models\Page::where("key", \App\Models\Page::KEY_TOP_PAGE_CONTENT_CUSTOM_INFO)->first();
                    @endphp
                    @include('includes.link_edit_admin', [
                      'link_edit' => url('admin/page/edit/' . $page_top_info_custom['id']),
                      'title' => 'Chỉnh sửa nội dung này',
                    ])
                    {!! $page_top_info_custom['content'] !!}
                </div>
                {{--<a class="contact-mail-top contact-link" title="Click to send mail"--}}
                {{--href="mailto:congnghedakim@gmail.com">--}}
                {{--Contact mail</a>--}}
                {{--<a class="contact-mail-top contact-link" title="Click to send mail with Gmail"--}}
                {{--href="https://mail.google.com/mail/?view=cm&fs=1&to=congnghedakim@gmail.com" target="_blank">--}}
                {{--Contact gmail--}}
                {{--</a>--}}
            </div>
            <div class="address-footer-wrap col-md-3 page">
                <strong>Links</strong>
                <ul class="footer-service">
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li><a class='menu-link1' href='{{ url('huong-dan-mua-acc.html') }}'>Hướng dẫn mua acc</a></li>
                    <li><a class='menu-link1' href='{{ url('huong-dan-thay-doi-tttk.html') }}'>Hướng dẫn đổi thông tin
                            acc</a></li>
                    <li><a class='menu-link1' href='{{ url('can-ban-acc.html') }}'>Cần bán hay thuê acc CF?</a></li>
                    <li><a class='menu-link1' href='{{ url('acc-da-ban.html') }}'>Các acc shop đã bán</a></li>
                </ul>
            </div>
            <div class="social-footer-wrap col-md-4">
                <strong>Kết nối fanpage</strong>
                <ul>
                    <li>
                        {{--                        <a href="https://www.facebook.com/DuongBiNano" target="_blank">--}}
                        {{--                            <i class="color fab fa-facebook" title="Link Fanpage" aria-hidden="true"></i>--}}
                        {{--                        </a>--}}
                        <div class="fb-page" data-href="https://www.facebook.com/DuongBiNano/" data-tabs="timeline" data-width="" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/DuongBiNano/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/DuongBiNano/">Dượng Bi Nano</a></blockquote></div>
                    </li>
                    {{--                    <li>--}}
                    {{--                        <a href="https://www.youtube.com/c/D%C6%B0%E1%BB%A3ngBiNano" title="Youtube" target="_blank">--}}
                    {{--                            <i class="color fab fa-youtube" aria-hidden="true"></i>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                </ul>
            </div>
        </div>
        <p class="footer-copyright page">
            <!--              Copyright 2020 by Site test. All rights reserved-->
            &copy 2021 by <span class="menu-active">duongbishop.vn</span>. All rights reserved. Design by <a target="_blank" href="https://www.facebook.com/nanocrossfire/" class="menu-active">Nvmanh Nano Thủ cửa V4 C4</a> </p>
    </div>
</div>

<div class="overlay"></div>

<ul class="icon-service-wrap">
    <li data-toggle="tooltip" data-placement="left" title="Click để gọi">
        <a href="https://chat.zalo.me/?phone=0866776636">
            <img src="{{ asset('images/icon-phone.png') }}" class="icon-service-img"/>
        </a>
    </li>
    <li data-toggle="tooltip" data-placement="left" title="Chat qua Zalo">
        <a href="//zalo.me/0866776636" target="_blank">
            <img src="{{ asset('images/icon-zalo.png') }}" class="icon-service-img"/>
        </a>
    </li>
{{--    <li data-toggle="tooltip" data-placement="left" title="Gửi tin nhắn qua Fanpage">--}}
{{--        <a href="https://www.facebook.com/DuongBiNano" target="_blank">--}}
{{--            <i class="icon-fb-messeger fab fa-facebook-messenger"></i>--}}
{{--        </a>--}}
{{--    </li>--}}
    {{--<li data-toggle="tooltip" data-placement="left" title="Click to send mail">--}}
    {{--<a href="mailto:congnghedakim@gmail.com">--}}
    {{--<img src="{{ asset('') }}images/icon-mail.png" class="icon-service-img"/>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--    <li data-toggle="tooltip" data-placement="left" title="Xem bản đồ">--}}
    {{--        <a href="/ban-do.html">--}}
    {{--            <img src="{{ asset('images/icon-map.png') }}" class="icon-service-img"/>--}}
    {{--        </a>--}}
    {{--    </li>--}}
</ul>


<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Tooltip plugin (zebra) js file -->
<script src="{{ asset('js/zebra_tooltips.min.js') }}"></script>


<!-- Owl Carousel plugin js file -->
{{--<script src="{{ asset('js/owl.carousel.min.js') }}"></script>--}}

<!-- Ideabox theme js file. you have to add all pages. -->
{{--<script src="{{ asset('js/jquery.show-more.js') }}"></script>--}}
{{--<script src="{{ asset('js/jquery.swipebox.min.js') }}"></script>--}}
{{--<!--<script src="{{ asset('') }}js/jquery.sliderPro.min.js"></script>-->--}}


{{--<script src="{{ asset('js/particles.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--<script src="{{ asset('js/stats.js') }}"></script>--}}

<script src="https://sp.zalo.me/plugins/sdk.js"></script>

<script src="{{ asset('js/script.js') }}"></script>



</body>

</html>

