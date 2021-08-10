<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Helper::getTitlePage() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/_all-skins.min.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="main-content">
        <!-- Main content -->
        <section class="content-login container">
            <section class="wrap-error">
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

            @yield('content')
        </section>
        <!-- /.content -->
    </div>

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/assets/js/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/assets/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/script.js') }}"></script>
</body>
</html>
