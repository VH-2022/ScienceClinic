<!DOCTYPE html>

<html lang="en">

<!--begin::Head-->

<head>

    <base href="../../../../">

    <meta charset="utf-8" />

    <title>Reset Password</title>

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

                    <!--begin::Login Sign in form-->

                    <div class="login-signin">

                        <div class="mb-10">

                            <h3>Reset Password ?</h3>

                            <div class="text-muted font-weight-bold">Enter password to change your password</div>

                        </div>

                        <form class="form" id="reset-password" method="POST" action="{{URL::to('update-admin-password')}}/{{$otp}}" onsubmit="return validate();">

                            @csrf

                            <div class="form-floating custom-float position-relative mb-5">
                                <input class="form-control mb-0" type="password" id="password" name="password" placeholder="New Password">
                                <button id="toggle-password" class=" pass-icons" type="button">
                                    <img src="{{ asset('front/img/close-eye.svg')}}" alt="eye icon" class="icon1">
                                    <img src="{{ asset('front/img/eye.svg')}}" alt="eye icon" class="icon2">
                                </button>
                                <span style="color: red;" id="passworderror">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="form-floating custom-float position-relative">
                                <input class="mb-0 form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                <button id="toggle-confirm-password" class=" pass-icons" type="button">
                                    <img src="{{ asset('front/img/close-eye.svg')}}" alt="eye icon" class="icon1">
                                    <img src="{{ asset('front/img/eye.svg')}}" alt="eye icon" class="icon2">
                                </button>
                                <span style="color: red;" id="confirmpassworderror">{{ $errors->first('confirm_password') }}</span>
                            </div>

                            <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Reset Password</button>

                        </form>

                    </div>

                    <!--end::Login Sign in form-->

                </div>

            </div>

        </div>

        <!--end::Login-->

    </div>

    <!--end::Main-->

    <!--begin::Global Config(global config for global JS scripts)-->

    <!--end::Global Config-->

    <!--begin::Global Theme Bundle(used by all pages)-->

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>

    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>

    <script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>

    <!--end::Global Theme Bundle-->

    <script>
        var togglePassword = document.getElementById("toggle-password");

        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                    $(this).addClass("active");
                } else {
                    x.type = "password";
                    $(this).removeClass("active");

                    // $("#toggle-password" <!--Background Area Start-->).removeClass("active");

                }
            });
        }
        var confirmtogglePassword = document.getElementById("toggle-confirm-password");

        if (confirmtogglePassword) {
            confirmtogglePassword.addEventListener('click', function() {
                var x = document.getElementById("confirm_password");
                if (x.type === "password") {
                    x.type = "text";
                    $(this).addClass("active");
                } else {
                    x.type = "password";
                    $(this).removeClass("active");

                    // $("#toggle-password" <!--Background Area Start-->).removeClass("active");

                }
            });
        }

        function ValidatePassword(password) {
            var expr = /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).{6,}$/;
            return expr.test(password);
        }
        $("#reset-password").submit(function() {
            var temp = 0;
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();
            if (password.trim() == '') {
                $("#passworderror").html("Please enter Password");
                temp++;
            } else if (!ValidatePassword(password)) {
                $("#passworderror").html("Password should include 6 charaters, alphabets, numbers and special characters");
                temp++;
            } else {
                $("#passworderror").html("");
            }
            if (confirmPassword.trim() == '') {
                $("#confirmpassworderror").html("Please enter Confirm Password");
                temp++;
            } else if (password != confirmPassword) {
                $("#confirmpassworderror").html("New password and Confirm password does not match");
                temp++;
            } else {
                $("#confirmpassworderror").html("");
            }
            if (temp == 0) {
                return true;
            } else {
                return false;
            }
        });
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