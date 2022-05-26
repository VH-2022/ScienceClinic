<html class="no-js" lang="en">



<head>

  <meta charset="utf-8">

  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Science Clinic Project</title>

  <meta name="description" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">



  <!-- favicon

		============================================ -->

  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/img/favicon.ico')}}">



  <!-- Google Fonts

		============================================ -->

  <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800' rel='stylesheet' type='text/css'>



  <!-- Color Swithcer CSS

		============================================ -->

  <link rel="stylesheet" href="{{ asset('front/css/color-switcher.css')}}">



  <!-- Fontawsome CSS

		============================================ -->

  <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css')}}">



  <!-- Metarial Iconic Font CSS

		============================================ -->

  <link rel="stylesheet" href="{{ asset('front/css/material-design-iconic-font.min.css')}}">



  <!-- Bootstrap CSS

		============================================ -->

  <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css')}}">

  <link rel="stylesheet" href="{{ asset('front/css/bootstrap-select.min.css')}}">



  <!-- Plugins CSS

		============================================ -->

  <link rel="stylesheet" href="{{ asset('front/css/plugins.css')}}">



  <!-- Style CSS

		============================================ -->

  <link rel="stylesheet" href="{{asset('front/main.css')}}">



  <!-- Color CSS

		============================================ -->

  <link rel="stylesheet" href="{{ asset('front/css/color.css')}}">



  <!-- owl.carousel.css

		============================================ -->

  <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.css')}}">



  <!-- Responsive CSS

		============================================ -->

  <link rel="stylesheet" href="{{ asset('front/css/responsive.css')}}">



  <!-- Modernizr JS

		============================================ -->

  <script src="{{ asset('front/js/vendor/modernizr-2.8.3.min.js')}}"></script>

  <link rel="stylesheet" href="{{ asset('assets/css/jquery-confirmation/css/jquery-confirm.min.css') }}">

  <!-- Color Css Files

		============================================ -->

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-two.css')}}" title="color-two" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-one.css')}}" title="color-one" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-three.css')}}" title="color-three" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-four.css')}}" title="color-four" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-five.css')}}" title="color-five" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-six.css')}}" title="color-six" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-seven.css')}}" title="color-seven" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-eight.css')}}" title="color-eight" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-nine.css')}}" title="color-nine" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-ten.css')}}" title="color-ten" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/color-ten.css')}}" title="color-ten" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/pattren1.css')}}" title="pattren1" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/pattren2.css')}}" title="pattren2" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/pattren3.css')}}" title="pattren3" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/pattren4.css')}}" title="pattren4" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/pattren5.css')}}" title="pattren5" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/background1.css')}}" title="background1" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/background2.css')}}" title="background2" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/background3.css')}}" title="background3" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/background4.css')}}" title="background4" media="screen" />

  <link rel="alternate stylesheet" type="text/css" href="{{ asset('front/switcher/background5.css')}}" title="background5" media="screen" />
  <link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/css/toastr.css')}}" />


  @yield('page-css')

</head>



<body>

  @include('frontend.elements.header_front')



  @yield('content')

  @include('frontend.elements.footer_front')





  <script src="{{ asset('front/js/vendor/jquery-1.12.4.min.js')}}"></script>



  <!-- popper JS

		============================================ -->

  <script src="{{ asset('front/js/popper.min.js')}}"></script>



  <!-- bootstrap JS

		============================================ -->

  <script src="{{ asset('front/js/bootstrap.min.js')}}"></script>



  <!-- AJax Mail JS

		============================================ -->

  <script src="{{ asset('front/js/ajax-mail.js')}}"></script>



  <!-- plugins JS

		============================================ -->

  <script src="{{ asset('front/js/plugins.js')}}"></script>



  <!-- StyleSwitch JS

		============================================ -->

  <script src="{{ asset('front/js/styleswitch.js')}}"></script>



  <!-- owl carousel Js

		============================================ -->

  <script src="{{ asset('front/js/owl.carousel.js')}}"></script>



  <!-- main JS

		============================================ -->

  <script src="{{ asset('front/js/main.js')}}"></script>



  <script type='text/javascript' src='https://d3a1eo0ozlzntn.cloudfront.net/assets/js/frontend-v2/widgets-v2.24a197bed6.v2.js' defer></script>





  <script src="{{ asset('front/js/bootstrap-select.min.js')}}"></script>

  <script src="{{ asset('assets/js/pages/jquery-confirmation/js/jquery-confirm.min.js') }}"></script>





  <script>
    $('.numberCls').keypress(function(event) {
      if (event.keyCode < 48 || event.keyCode > 57) {
        event.preventDefault();
      }
    });
    $('.numberCls').bind("cut copy paste", function(e) {
      e.preventDefault();
    });
    $(document).ready(function() {

      $("#overlays").click(function() {

        $(".mobile-show.active").removeClass("active");

      });

    });



    $('.header-search').on('click', function() {

      $('.search').toggleClass('open');

      return false;

    });



    function imgError(image) {

      image.onerror = "";

      image.src = "{{asset('img/noimage.jpg')}}";

      return true;

    }
  </script>
  <script src="{{asset('assets/js/toastr.min.js')}}"></script>
  <script>
    toastr.options.timeOut = 10000;
  </script>
  @if(Session::has('error'))
  toastr.error('{{ Session::get('error ') }}');
  @elseif(Session::has('success'))
  toastr.success('{{ Session::get('success ') }}');
  @endif

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



  @yield('page-js')


</body>



</html>