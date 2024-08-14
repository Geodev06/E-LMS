<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('auth.head')

    <style>
        .bg1 {
            background: url("{{ asset('assets/images/register-bg.png') }}") center/cover no-repeat;
            position: relative;
            z-index: 1;
        }

        .bg1:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
            height: 100%;
            width: 100%;
            background: #272727;
            opacity: 0.7;
        }
    </style>
</head>

<body>

    <!-- preloader area end -->
    <!-- login area start -->
    <div class="bg1">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-4 offset-xl-8 col-lg-6 offset-lg-6">
                    <div class="login-box-s2 ptb--100">
                        <form id="register_form">
                            <div class="login-form-head">
                                <h4>Sign up</h4>
                                <p>Hello there, Sign up and Join with Us</p>
                            </div>
                            <div class="login-form-body">
                                @csrf
                                <div class="form-gp">
                                    <label for="exampleInputName1">Full Name</label>
                                    <input type="text" id="exampleInputName1" name="fullname" autocomplete="off">
                                    <i class="ti-user"></i>
                                    <div class="text-danger err_fullname"></div>
                                </div>
                                <div class="form-gp">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" id="exampleInputEmail1" name="email" autocomplete="off">
                                    <i class="ti-email"></i>
                                    <div class="text-danger err_email"></div>
                                </div>
                                <div class="form-gp">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" id="exampleInputPassword1" name="password" autocomplete="off">
                                    <i class="ti-lock"></i>
                                    <div class="text-danger err_password"></div>
                                </div>
                                <div class="form-gp">
                                    <label for="exampleInputPassword2">Confirm Password</label>
                                    <input type="password" id="exampleInputPassword2" name="password_confirmation" autocomplete="off">
                                    <i class="ti-lock"></i>
                                    <div class="text-danger"></div>
                                </div>
                                <div class="submit-btn-area">
                                    <button id="form_submit"   type="submit" >Submit <i class="ti-arrow-right"></i></button>
                                </div>
                                <div class="form-footer text-center mt-5">
                                    <p class="text-muted">Already have an account? <a href="/login">Sign in</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login area end -->

    @include('auth.scripts')
    @include('common.notification')
    @include('common.loading')


    <script src="{{ asset('common/common.js') }}"></script>

    <script src="{{ asset('common/auth.js') }}"></script>

</body>

</html>