<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @include('system_title')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('index.head')
</head>

<body class="body-bg">

    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->
    <!-- preloader area end -->

    <div class="horizontal-main-wrapper">
        <!-- main header area start -->
        @if(Auth::check())
        @include('index.user_header')
        @else
        <div class="container-fluid" style="background-color: white;">
            <div class="row">
                <div class="col-lg-8 pt-5 pb-2 mx-auto">
                    <h3><b>E-LMS</b></h3>
                </div>
            </div>
        </div>
        @endif
        <!-- main header area end -->
        <!-- header area start -->
        @include('index.nav')
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="container">
                <div class="row">


                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- main wrapper start -->
    <!-- offset area start -->

    <!-- offset area end -->
    <!-- jquery latest version -->
    @include('index.scripts')
    @include('common.notification')
    @include('common.loading')

    <script src="{{ asset('common/common.js') }}"></script>
    
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
</body>

</html>