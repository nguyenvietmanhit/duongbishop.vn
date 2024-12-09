<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Helper::$title_page }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('css/style_report.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/style.css') }}">--}}
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/_all-skins.min.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo" title="thansohoc" target="_blank">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>{{ env('APP_NAME') }}</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>{{ env('APP_NAME') }}</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fa fa-bars"></i>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('admin/assets/images/user2-160x160.jpg')}}" class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs">{{ session()->get('user')->username }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset('admin/assets/images/user2-160x160.jpg')}}" class="img-circle"
                                     alt="User Image">

                                <p>
                                    {{ session()->get('user')->username }}
                                    {{--<small>Thành viên từ năm 2012</small>--}}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('user/profile') }}" class="btn btn-default btn-flat">Tài khoản</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('user/logout') }}" class="btn btn-default btn-flat">Thoát</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('admin/assets/images/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ session()->get('user')->username }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">LAOYOUT ADMIN</li>
{{--                <li>--}}
{{--                    <a href="{{ url('admin/categories') }}">--}}
{{--                        <i class="fa fa-list"></i> <span>Quản lý danh mục</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{ url('admin/products') }}">
                        <i class="fa fa-list"></i> <span>Quản lý acc</span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="{{ url('admin/news') }}">--}}
{{--                        <i class="fa fa-list"></i> <span>Quản lý tin tức</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{ url('admin/pages') }}">
                        <i class="fa fa-list"></i> <span>Quản lý trang tĩnh</span>
                    </a>
                </li>

                {{--<li>--}}
                    {{--<a href="{{ url('admin/campaigns') }}">--}}
                        {{--<i class="fa fa-list"></i> <span>Danh sách chiến dịch</span>--}}
                        {{--<span class="pull-right-container">--}}
              {{--<!--<small class="label pull-right bg-green">new</small>-->--}}
            {{--</span>--}}
                    {{--</a>--}}
                {{--</li>--}}

                {{--<li>--}}
                    {{--<a href="{{ url('admin/content/static') }}">--}}
                        {{--<i class="fa fa-th"></i> <span>Quản lý trang report</span>--}}
                        {{--<span class="pull-right-container">--}}
              {{--<!--<small class="label pull-right bg-green">new</small>-->--}}
            {{--</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li>
                    <a href="{{ url('admin/users') }}">
                        <i class="fa fa-user"></i> <span>Quản lý user</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/roles') }}">
                        <i class="fa fa-paint-roller"></i> <span>Quản lý quyền</span>
                    </a>
                </li>

                {{--<li>--}}
                {{--<a href="pages/widgets.html">--}}
                {{--<i class="fa fa-code"></i> <span>Quản lý user</span>--}}
                {{--<span class="pull-right-container">--}}
                {{--<!--<small class="label pull-right bg-green">new</small>-->--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--</li>--}}
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Breadcrumd Wrapper. Contains breadcrumb -->
{{--<div class="breadcrumb-wrap content-wrap content-wrapper">--}}
{{--<!-- Content Header (Page header) -->--}}
{{--<section class="content-header">--}}
{{--<nav aria-label="breadcrumb">--}}
{{--<ol class="breadcrumb">--}}
{{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--<li class="breadcrumb-item"><a href="#">Library</a></li>--}}
{{--<li class="breadcrumb-item active" aria-current="page">Data</li>--}}
{{--</ol>--}}
{{--</nav>--}}
{{--</section>--}}
{{--</div>--}}

<!-- Messaeg Wrapper. Contains messaege error and success -->
    <div class="message-wrap content-wrap content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @foreach ($errors->all() AS $error)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Thông báo!</strong> {{ $error }}
                </div>
            @endforeach
            @if(session()->get('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Thông báo!</strong> {{ session()->get('error') }}
                </div>
                @php(session()->forget('error'))
            @endif
            @if(session()->get('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Thông báo!</strong> {{ session()->get('success') }}
                </div>
                @php(session()->forget('success'))
            @endif
        </section>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            @yield('breadcrumb')
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.13-pre
        </div>
        <strong>Copyright &copy; reqport.mediaz.vn</strong>. All rights reserved.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script type="text/javascript">
    // Create global variables
    var url_base = '{{ env('APP_URL') }}';
</script>

<!-- jQuery 3 -->

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/assets/js/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
{{--<script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>--}}
<!-- AdminLTE App -->
<script src="{{ asset('admin/assets/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin/assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('admin/assets/js/script.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function () {
        CKEDITOR.config.contentsCss = [
            '{{ \Helper::getDomain() . '/css/bootstrap.min.css' }}',
            '{{ \Helper::getDomain() . '/css/style.css' }}'
        ];
    })
</script>
</body>
</html>
