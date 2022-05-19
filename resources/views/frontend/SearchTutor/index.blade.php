@extends('layouts.frontend')
@section('content')
<div class="as-mainwrapper">
    <!--Bg White Start-->
    <div class="bg-white">
        <!--Header Area Start-->
        <div id="header"></div>
        <!--End of Header Area-->
        <!--background Area Start-->
        <div class="backgrount-area  bg-mathes  full-grayoverlay h-auto">
            <div class="banner-content padding-headsection h-auto">
                <div class="container h-auto">
                    <div class="row h-auto">
                        <div class="col-md-12 h-auto">
                            <div class="text-content-wrapper text-center full-width h-auto">
                                <div class="text-content text-center-content h-auto">
                                    <h1 class="title1 text-center max-englishtext mb-20">
                                        <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight">Find a Tutor</span>
                                    </h1>

                                    <p>
                                        Our mission is to match children with the right tutors. When this happens,
                                        the results can be
                                        remarkable and confidence can grow. Please enter the relevant information
                                        below to enable
                                        us find tutors who specialise in the subject you require.
                                    </p>
                                    <!-- <div class="banner-readmore">
                                            <a class="button-default inline" href="javascript:void(0)">Find a Tutors</a>
                                        </div> -->
                                </div>
                                <div class="literature-text literature-text-new">

                                    <p class="mb-2 custom-text-start ">
                                        How often would you like tuition?
                                    </p>
                                    <div class="custom-text-start">
                                        <div class="custom-control custom-radio custom-radio ">
                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1">One Off</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-radio">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio2">Weekly</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-radio">
                                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">Fortnightly</label>
                                        </div>
                                    </div>
                                    <div class="pearson p">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tutore-search-box m-t-0 h-auto">
                        <div class="row justify-content-center justify-start h-auto">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-sm-3 col-md-6 col-lg-4">
                                        <input type="text" name="text" placeholder="Subject">
                                    </div>
                                    <div class="col-sm-3 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <input type="text" name="text" placeholder="Level">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <input type="text" name="text" placeholder="Post Code">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-2">
                                        <button class="btn btn-search-tutore " id="hideshow"><span class="
                                                zmdi zmdi-search-for tutore-search"></span>Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of background Area-->


        <section class="tutore-content details-section">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title-wrapper test tutore-middle-title">
                            <div class="section-title">
                                <h3 class="mb-4">Tutors</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="row" id="res_tutor_id">



                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="english-abc">
            <div class="container">
                <div class="row justify-content-center res-mb-2">
                    <div class="col-lg-11 col-md-12">
                        <img src="{{ asset('Front/img/svg/find-new.jpeg')}}">
                    </div>
                </div>
            </div>
        </div>

        <div class="sub-data">
            <div class="about-area gallery-area mt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="about-container">
                                <h3>Subjects we offer</h3>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <a href="mathematics-tuition.html">
                                    <div class="media">
                                        <div class="gall-overlays"></div>
                                        <div class="layer">
                                            <h2>Mathematics</h2>
                                        </div>
                                        <img src="{{asset('Front/img/banner/mimg4.jpeg')}}" class="img-over" alt="Jenny of Oldstones" />
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="english-language-literature-tuition.html">
                                    <div class="media">
                                        <div class="gall-overlays"></div>
                                        <div class="layer">
                                            <h2>English Language & Literature</h2>
                                        </div>
                                        <img src="{{asset('Front/img/banner/eimg3.png')}}" class="img-over" alt="Jenny of Oldstones" />
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="physics-tuition.html">
                                    <div class="media">
                                        <div class="gall-overlays"></div>
                                        <div class="layer">
                                            <h2>Physics</h2>
                                        </div>
                                        <img src="{{asset('Front/img/banner/pimg5.png')}}" class="img-over" alt="Jenny of Oldstones" />
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="biology-tuition.html">
                                    <div class="media">
                                        <div class="gall-overlays"></div>
                                        <div class="layer">
                                            <h2>Biology</h2>
                                        </div>
                                        <img src="{{asset('Front/img/banner/bimg1.jpg')}}" class="img-over" alt="Jenny of Oldstones" />
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="chemistry-tuition.html">
                                    <div class="media">
                                        <div class="gall-overlays"></div>
                                        <div class="layer">
                                            <h2>chemistry</h2>
                                        </div>
                                        <img src="{{asset('Front/img/banner/cimg2.png')}}" class="img-over" alt="Jenny of Oldstones" />
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="computer-science.html">
                                    <div class="media">
                                        <div class="gall-overlays"></div>
                                        <div class="layer">
                                            <h2>Computer Science</h2>
                                        </div>
                                        <img src="{{asset('Front/img/banner/computer.png')}}" class="img-over" alt="Jenny of Oldstones" />
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <a href="primary-school.html">
                                    <div class="media">
                                        <div class="gall-overlays"></div>
                                        <div class="layer">
                                            <h2>Primary
                                            </h2>
                                        </div>
                                        <img src="{{asset('Front/img/banner/primary.png')}}" class="img-over" alt="Jenny of Oldstones" />
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <a href="spanish.html">
                                    <div class="media">
                                        <div class="gall-overlays"></div>
                                        <div class="layer">
                                            <h2>Languages
                                            </h2>
                                        </div>
                                        <img src="https://kaleela.com/wp-content/uploads/2021/03/Five-of-the-Top-Foreign-Languages-to-Learn-in-2021-1024x710.png" class="img-over" alt="Jenny of Oldstones" />
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <a href="history-tuition.html">
                                    <div class="media">
                                        <div class="gall-overlays"></div>
                                        <div class="layer">
                                            <h2>Other Subjects

                                            </h2>
                                        </div>
                                        <img src="{{asset('Front/img/banner/other.png')}}" class="img-over" alt="Jenny of Oldstones" />
                                    </div>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--Footer Area Start-->
        <div id="footer"></div>
        <!--End of Footer Area-->
    </div>
    <!--End of Bg White-->
</div>
<!--End of Main Wrapper Area-->

<!-- Color Switcher -->

@endsection
@section('page-js')


<script>
    $("#hideshow").click(function() {
        var level = $('#level').val();
        var subject = $('#subject').val();

        $.ajax({
            url: "{{ route('get.tutors')}}",
            data: {
                'subject': subject,
                'level': level
            },
            success: function(res) {
                console.log(res);
                var json = res.data;
                var tutor_res = '';
                $(".details-section").toggle();
                if (json.length != 0) {
                    $.each(json, function(i, v) {
                        tutor_res += '<div class="col-md-6 col-lg-3 tutor-card">' + '<a class = "tutor-content" href = "tutors-details.html" >' + '<div class = "single-product-item">' + '<div class = "single-product-image">' + '<img src = "' + v.profile_photo + '">' + '</div> <div class = "single-product-text"> ' + '<h4 class = "testing-user" >' + v.first_name + '</h4></div></div></a></div>';
                    })
                }
                $('#res_tutor_id').html("");
                $('#res_tutor_id').html(tutor_res);
            }
        })
    });
</script>
@endsection