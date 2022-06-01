@extends('layouts.frontend')

@section('content')
<link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet" />
<div class="signinform mb-4" style="background: #616161;">
    <div class="row">

        <div class="reslog-img col-lg-6 col-md-12 parent-login-img">
            <img src="img/svg/2.jpg" class="log-img">
        </div>

        <div class="col-md-12 col-lg-12 parent-login">
            <div class="Login-main log reslog">
                <div class="container-fluid">


                    <div class="card login-main-box">
                        <form action="{{route('verify-login-parent')}}" method="POST" id="parent-login" class="card-body">
                            @csrf
                            <div class="login-box ">
                                <div>
                                    <h3 class="title">Parent Login</h3>

                                </div>
                                <div>
                                    <div class="contact-form-area ">
                                        <div class="form-floating custom-float">
                                            <input type="text" name="email" class="mb-0" id="email" placeholder="Email">
                                            <img src="{{asset('front/img/email1.svg')}}" alt="email icon" class="login-input">
                                            <span class="text-danger" id="error_email">{{ $errors->first('email') }}</span>
                                        </div>
                                        <div class="form-floating custom-float">
                                            <input type="password" class="mb-0" name="password" id="password" placeholder="password">
                                            <button id="toggle-password" class="pass-icons" type="button">
                                                <img src="{{asset('front/img/close-eye.svg')}}" alt="eye icon" class="icon1">
                                                <img src="{{asset('front/img/eye.svg')}}" alt="eye icon" class="icon2">
                                            </button>
                                            <span class="text-danger" id="error_password">{{ $errors->first('password') }}</span>

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
@endsection

@section('page-js')
<script type='text/javascript' src='https://d3a1eo0ozlzntn.cloudfront.net/assets/js/frontend-v2/widgets-v2.24a197bed6.v2.js' defer></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script>
    $('.hero_carousel').owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        autoplay: true,
        autoplayTimeout: 2200,

        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    })

    $('.testimonial-text').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 1500,
        // navText: ["<img src='./img/svg/left-arrow-test.png'>", "<img src='./img/svg/right-arrow-test.png'>"],
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })

    $('.associations-text').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 1950,
        // navText: ["<img src='./img/svg/left-arrow-test.png'>", "<img src='./img/svg/right-arrow-test.png'>"],
        dots: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    })
    $('.text_carousel').owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        autoplay: true,
        autoplayTimeout: 16000,

        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })


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

                // $("#toggle-password").removeClass("active");

            }
        });
    }

    function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    }
    $("#parent-login").submit(function() {

        var temp = 0;
        var email = $("#email").val();
        var password = $("#password").val();
        if (email.trim() == "") {
            $('#error_email').html("Please enter Email");
            temp++;
        } else if (!ValidateEmail(email)) {
            $('#error_email').html("Invalid Email");
            temp++;
        } else {
            $('#error_email').html("");
        }
        if (password.trim() == '') {
            $("#error_password").html("Please enter Password");
            temp++;
        } else {
            $("#error_password").html("");
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