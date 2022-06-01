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
                                    <form action="{{ route('verify-login-tutor') }}" id="tutor-login" class="card-body" method="post">
                                        @csrf
                                        <div class="login-box form-data">
                                            <div>
                                                <h3 class="title">Tutor Login</h3>

                                            </div>
                                            <div>
                                                <div class="contact-form-area">
                                                    <div class="form-floating custom-float">
                                                        <input class="mb-0" type="text" name="email" id="email" placeholder="Email">
                                                        <img src="{{ asset('front/img/email1.svg')}}" alt="email icon" class="login-input">
                                                        <span style="color: red;" id="emailerror">{{ $errors->first('email') }}</span>
                                                    </div>
                                                    <div class="form-floating custom-float">
                                                        <input class="mb-0" type="password" id="password" name="password" placeholder="password">
                                                        <button id="toggle-password" class="pass-icons" type="button">
                                                            <img src="{{ asset('front/img/close-eye.svg')}}" alt="eye icon" class="icon1">
                                                            <img src="{{ asset('front/img/eye.svg')}}" alt="eye icon" class="icon2">
                                                        </button>
                                                        <span style="color: red;" id="passworderror">{{ $errors->first('password') }}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-check custom-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                    <div class="mb-30">
                                                        <a href="javascript:void(0)" class="link-text"> Forgot
                                                            Password?</a>

                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn1 btn-primary w-100 login1-btn">Login</button>
                                                <div class="text-center mt-20 account-text">

                                                    Don't have an account?<a href="#" class="link-text"> Register</a>
                                                </div>
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

        function ValidateEmail(email) {
            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            return expr.test(email);
        }

        $("#tutor-login").submit(function() {

            var temp = 0;
            var email = $("#email").val();
            var password = $("#password").val();
            if (email.trim() == "") {
                $('#emailerror').html("Please enter Email");
                temp++;
            } else if (!ValidateEmail(email)) {
                $('#emailerror').html("Invalid Email");
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