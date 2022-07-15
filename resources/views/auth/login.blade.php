<!DOCTYPE html>

<html lang="en">

<!--begin::Head-->

<head>

    <base href="../../../../">

    <meta charset="utf-8" />

    <title>Login</title>

    <meta name="description" content="Login" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!--begin::Fonts-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <!--end::Fonts-->

    <!--begin::Page Custom Styles(used by this page)-->

    <link href="{{ asset('assets/css/pages/login/classic/login-4.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->

    <link href="{{ asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{{ asset('front/img/favicon.ico')}}" />

</head>

<!--end::Head-->

<!--begin::Body-->



<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->

    <div class="d-flex flex-column flex-root">

        <!--begin::Login-->

        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">

            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset("assets/media/bg/bg-3.jpg")}}');">

                <div class="login-form text-center p-7 position-relative overflow-hidden">

                    <!--begin::Login Header-->

                    <div class="d-flex flex-center mb-15">

                        <a href="#">

                            <img src="{{ asset('front/img/logo2.png')}}" class="max-h-75px" alt="" />

                        </a>

                    </div>

                    <!--end::Login Header-->

                    <!--begin::Login Sign in form-->

                    <div class="login-signin">

                        <div class="mb-20">

                            <h3>Sign In To Admin</h3>

                            <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>

                        </div>

                        <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('verify-login') }}" onsubmit="return validate();">

                            @csrf

                            <div class="form-group mb-5">

                                <input class="form-control h-auto  py-4 px-8" type="text" placeholder="Email" id="email" name="email" autocomplete="off">

                                <span style="color: red;margin-right: 270px;" id="emailerror"></span>

                            </div>

                            <div class="form-group mb-5">

                                <input class="form-control h-auto  py-4 px-8" type="password" id="password" placeholder="Password" name="password" />

                                <span style="color:red;margin-right: 240px;" id="passworderror"></span>

                            </div>

                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center" style="float: right;">



                                <a href="{{ route('password.request') }}" id="kt_login_forgot" class="text-muted text-hover-primary dark-sign-color">Forgot Password?</a>

                            </div>

                            <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>

                        </form>

                    </div>

                    <!--end::Login Sign in form-->

                </div>

            </div>

        </div>

        <!--end::Login-->

    </div>

    <!--end::Main-->


    <!--begin::Global Theme Bundle(used by all pages)-->

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>

    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>

    <script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>

    <!--end::Global Theme Bundle-->

    <script>
        function ValidateEmail(email) {

            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

            return expr.test(email);

        }

        function validate() {

            var temp = 0;

            var email = $("#email").val();

            var password = $("#password").val();

            if (email.trim() == "") {

                $('#emailerror').html("Please enter Email");

                temp++;

            } else if (!ValidateEmail(email)) {

                $('#emailerror').html("Please enter valid Email");

                temp++;

            } else {

                $('#emailerror').html("");



            }

            if (password.trim() == '') {

                $("#passworderror").html("Please enter Password");

                temp++;

            } else {

                $("#passworderror").html("");

            }

            if (temp == 0) {

                return true;

            } else {

                return false;

            }

        }
    </script>

    @if(Session::has('success'))

    <script>
        Command: toastr["success"]('<?php echo Session::get('success') ?>')
    </script>

    @endif



    @if(Session::has('error'))

    <script>
        Command: toastr["error"]('<?php echo Session::get('error') ?>')
    </script>

    @endif

    <!--end::Page Scripts-->

</body>

<!--end::Body-->



</html>