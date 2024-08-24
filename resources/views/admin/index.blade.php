<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @include('system_title')
    @include('admin.head')

    @include('common.loading')


    <script src="{{ asset('common/common.js') }}"></script>

</head>

<body>

    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div>
                    <h3 class="text-white"><b>E-LMS</b></h3>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    @include('admin.nav')
                </div>
            </div>
        </div>
        <div class="main-content">
            <!-- header area start -->
            @include('admin.header-area')
            <!-- header area end -->
            <!-- page title area start -->
            @include('admin.page-title-area')
            <!-- page title area end -->
            <div class="main-content-inner bg-white">
                <div class="row bg-white">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->

    @include('admin.scripts')
    @include('common.notification')


</body>
@if(Auth::check())
<script>
    $('#btn_logout').on('click', function(e) {

        e.preventDefault()
        loading_body()

        function before() {}

        function success(res) {
            stop_loading_body()
            window.location.replace(res.link)
        }

        function error(err) {
            stop_loading_body()
            showNotification('alert', err.responseJSON)
        }

        var dataObject = {
            _token: "{{ csrf_token() }}"
        }

        sendAjaxRequest("/user-logout", 'post', dataObject, before, success, error)
    })
</script>
@endif

</html>