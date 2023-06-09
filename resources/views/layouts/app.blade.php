
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>

    @vite('resources/sass/app.scss')
    @vite('resources/sass/adminlte.scss')



@yield("style")

</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center" style="height: 100vh; width:100%; background-color: white;">
        <img class="animation__shake" src="{{asset("dist/img/catch.png")}}" alt="AdminLTELogo" style=" z-index:5;" width="80" height="80">
    </div>
    <script>
        document.onreadystatechange = () => {
            if (document.readyState === "complete") {
                setTimeout(()=>{
                    document.querySelector(".preloader").style.display="none";
                },2000)
            }
        };
    </script>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route("index")}}" class="nav-link">Home</a>
            </li>
        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("partials.sidebar")
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield("header")</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield("breadcrumb")
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content pb-3">
            <div class="container-fluid ">
                @yield("content")
             </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          <strong>Free Palastine</strong>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020- {{ now()->format('Y') }} <a href="{{route("index")}}">Catch Dose</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@vite('resources/js/app.js')

@yield("extra")
@yield('scripts')
@include("partials._toast")
</body>
</html>
