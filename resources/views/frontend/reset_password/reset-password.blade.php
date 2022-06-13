@extends('layouts.frontend')
@section('content')
<style>
    .form-data .custom-float {
        margin-bottom: 23px;
    }
</style>
<link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet" />
<div class="as-mainwrapper">
    <!--Bg White Start-->
    <div class="bg-white">
        <!--Background Area Start-->
        <section>
            <div class="signinform mb-4" style="background: #616161;">
                <div class="row">
                    <!-- <div class="col-md-6">
                        <img src="img/svg/2.jpg" class="log-img">
                    </div> -->
                    <div class="reslog-img col-lg-6 col-md-12 parent-login-img">
                        <img src="{{asset('front/img/svg/2.jpg')}}" class="log-img">
                    </div>

                    <div class="col-md-12 col-lg-12 parent-login">
                        <div class="Login-main log reslog">
                            <div class="container-fluid">
                                <div class="card login-main-box">
                                    <form action="{{URL::to('update-user-password')}}/{{$otp}}" id="reset-password" class="card-body" method="post">
                                        @csrf
                                        <div class="login-box form-data">
                                            <div>
                                                <h3 class="title">Reset Password</h3>

                                            </div>
                                            <div>
                                                <div class="contact-form-area">
                                                    <div class="form-floating custom-float">
                                                        <input class="mb-0" type="password" id="password" name="password" placeholder="New Password">
                                                        <button id="toggle-password" class="pass-icons" type="button">
                                                            <img src="{{ asset('front/img/close-eye.svg')}}" alt="eye icon" class="icon1">
                                                            <img src="{{ asset('front/img/eye.svg')}}" alt="eye icon" class="icon2">
                                                        </button>
                                                        <span style="color: red;" id="passworderror">{{ $errors->first('password') }}</span>
                                                    </div>
                                                    <div class="form-floating custom-float">
                                                        <input class="mb-0" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                                        <button id="toggle-confirm-password" class="pass-icons" type="button">
                                                            <img src="{{ asset('front/img/close-eye.svg')}}" alt="eye icon" class="icon1">
                                                            <img src="{{ asset('front/img/eye.svg')}}" alt="eye icon" class="icon2">
                                                        </button>
                                                        <span style="color: red;" id="confirmpassworderror">{{ $errors->first('confirm_password') }}</span>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn1 btn-primary w-100 login1-btn">Reset Password</button>
                                            </div>
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!--End of Bg White-->

    </div>
    @endsection
    @section('page-js')
    <script src="{{ asset('front/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
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
            var expr =/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).{6,}$/;
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
    <script>
        @if(Session::has('success'))
        toastr.success("{{ session('success') }}");
        @endif

        @if(Session::has('error'))
        toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    @endsection