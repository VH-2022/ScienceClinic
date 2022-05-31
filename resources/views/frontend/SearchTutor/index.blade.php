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

                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="one_off">

                                            <label class="custom-control-label" for="customRadio1">One Off</label>

                                        </div>



                                        <div class="custom-control custom-radio custom-radio">

                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="weekly">

                                            <label class="custom-control-label" for="customRadio2">Weekly</label>

                                        </div>



                                        <div class="custom-control custom-radio custom-radio">

                                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" value="fortnightly">

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

                                        <input type="text" name="text" placeholder="Subject" id="subject">

                                    </div>

                                    <div class="col-sm-3 col-md-6 col-lg-3">

                                        <div class="form-group">

                                            <input type="text" name="text" placeholder="Level" id="level">

                                        </div>

                                    </div>

                                    <div class="col-sm-3 col-md-6 col-lg-3">

                                        <div class="form-group">

                                            <input type="text" name="text" placeholder="Post Code" id="pincode_id">

                                        </div>

                                    </div>

                                    <div class="col-sm-3 col-md-3 col-lg-2">

                                        <button class="btn btn-search-tutore " onclick="getSearch()"><span class="zmdi zmdi-search-for tutore-search"></span>Search</button>

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

                        <img src="{{ asset('front/img/svg/find-new.jpeg') }}">

                    </div>

                </div>

            </div>

        </div>
        @include('frontend.subject_offer.subject_offer')
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
    function getSearch() {
        $(".details-section").attr('style', 'display:flex');
        var level = $('#level').val();

        var subject = $('#subject').val();
        var tutor_often = $('input[name="customRadio"]:checked').val();
        var pincode_id = $('#pincode_id').val();
        $.ajax({

            url: "{{ route('get.tutors') }}",

            data: {

                'subject': subject,
                'tutor_often': tutor_often,
                'level': level,
                'pincode': pincode_id

            },

            success: function(res) {

                console.log(res);

                var json = res.data;

                var tutor_res = '';

                $('#res_tutor_id').html("");

                if (json.length != 0) {





                    $.each(json, function(i, v) {

                        tutor_res += '<div class="col-md-6 col-lg-3 tutor-card">' +
                            '<a class = "tutor-content" href = "' + v.url + '" >' +
                            '<div class = "single-product-item">' +
                            '<div class = "single-product-image">' + '<img src = "' + v
                            .profile_photo + '" onerror="imgError(this)">' +
                            '</div> <div class = "single-product-text"> ' +
                            '<h4 class = "testing-user" >' + v.first_name +
                            '</h4></div></div></a></div>';

                    })

                } else {
                    tutor_res = "<center>No record available</center>";
                }



                $('#res_tutor_id').html(tutor_res);

            }

        })
    }
</script>
@endsection