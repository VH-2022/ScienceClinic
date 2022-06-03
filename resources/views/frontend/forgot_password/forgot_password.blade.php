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
                                    <form action="{{route('forgot-password-verify')}}" id="forgot-password" class="card-body" method="post">
                                        @csrf
                                        <div class="login-box form-data">
                                            <div>
                                                <h3 class="title">Forgot Password</h3>

                                            </div>
                                            <div>
                                                <div class="contact-form-area">
                                                    <div class="form-floating custom-float">
                                                        <input autocomplete="off" class="mb-0" type="text" name="email" id="email" placeholder="Email">
                                                        <img src="{{ asset('front/img/email1.svg')}}" alt="email icon" class="login-input">
                                                        <span style="color: red;" id="emailerror">{{ $errors->first('email') }}</span>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn1 btn-primary w-100 login1-btn">Send</button>
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
        function ValidateEmail(email) {
            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            return expr.test(email);
        }

        $("#forgot-password").submit(function() {

            var temp = 0;
            var email = $("#email").val();
            if (email.trim() == "") {
                $('#emailerror').html("Please enter Email");
                temp++;
            } else if (!ValidateEmail(email)) {
                $('#emailerror').html("Invalid Email");
                temp++;
            } else {
                $.ajax({
                    async: false,
                    global: false,
                    url: "{{ route('check.email') }}",
                    type: "get",
                    data: {
                        email: email
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            $('#emailerror').html("");
                        } else {
                            $('#emailerror').html("There isn’t any account associated with this email");
                            temp++;
                        }

                    }

                });
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