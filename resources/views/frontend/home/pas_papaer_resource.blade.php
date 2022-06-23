@extends('layouts.frontend')
@section('content')
<div class="backgrount-area book-bg  full-grayoverlay">
    <div class="banner-content padding-headsection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content-wrapper text-center full-width">
                        <div class="text-content text-center-content">
                            <h1 class="title1 text-center max-englishtext mb-20">
                                <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight">Past Examination Papers</span>
                            </h1>

                            <p>
                                Please find below a selection of past examination papers from AQA, Edexcel, Eduqas, OCR Gateway and OCR Twenty First Century examination boards.
                            </p>
                            <div class="banner-readmore">
                                <a class="button-default inline" href="contact.html">CONTACT US</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="gray-bgs past-papperspd res-past-papperspd">
    <div class="container">
        <div>
            <div class="section-title-wrapper test papers-before middle-title-cap">
                <div class="section-title">
                    <!-- <h3 class="mb-4">Past Papers</h3> -->
                    <h3 class="mb-4">GCSE Past Papers </h3>
                </div>
            </div>


            <div class="paper-section">
                <div class="paper-card">
                    <div class="paper-body">

                    @if(count($paperData) > 0)
                        @foreach($paperData as $key)
                            <div class="paper-flex">
                                <h5 class="mb-3">{{$key->category_name}}
                                </h5>
                            </div>

                            @if(count($key->paperArray) > 0)
                                @php $i = 1; @endphp
                                @foreach($key->paperArray as $ckey)

                                <div id="accordion{{$i}}">
                                    <div class="card mb-3">
                                        <div class="card-header" id="headingOne{{$i}}">
                                            <p class="mb-0">
                                                <button class="btn btn-link custom-link-coll collapsed" data-toggle="collapse" data-target="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne{{$i}}">
                                                    <span>{{$ckey->paper_title}}</span>
                                                </button>
                                            </p>
                                        </div>

                                        <div id="collapseOne{{$i}}" class="collapse" aria-labelledby="headingOne{{$i}}" data-parent="#accordion{{$i}}">
                                            <div class="card-body">

                                                <div class="row padding-paper">
                                                    <div class="col-md-12 col-paper">
                                                        <div class="mr-2">
                                                            <!-- <p class="section-read"><span>Section A:</span>Reading</p> -->
                                                            <ul class="section-uls">
                                                                @if(count($ckey->subjectData) > 0)
                                                                    @foreach($ckey->subjectData as $skey)
                                                                        <li><a href="{{route('past-papers-resources-detail',$skey->id)}}">{{$skey->subjectData->main_title}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        @php $i++; @endphp
                                @endforeach

                            @endif

                        @endforeach
                    @endif

                        
                    </div>
                </div>

            </div>
        </div>
        <div>
            <div>
                <div class="section-title-wrapper test papers-before middle-title-cap">
                    <div class="section-title">
                        <h3 class="mb-4 mt-4">Resources</h3>
                    </div>
                </div>
                

                <div class="paper-section">
                    <div class="paper-card">
                        <div class="paper-body">
                            <div class="paper-flex">
                                <!-- <h5 class="mb-3">There are two papers for English Language at GCSE level
                                    </h5> -->
                            </div>
                            <div id="accordion3">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingres">
                                        <p class="mb-0">
                                            <button class="btn btn-link custom-link-coll collapsed" data-toggle="collapse" data-target="#collapseres" aria-expanded="true" aria-controls="collapseres">
                                                <span> Useful Reading</span>
                                            </button>
                                        </p>
                                    </div>

                                    <div id="collapseres" class="collapse" aria-labelledby="headingres" data-parent="#accordion3">
                                        <div class="card-body">

                                            <div class="row padding-paper">
                                                <div class="col-md-12 col-paper">
                                                    <div class="mr-2">
                                                        <!-- <p class="section-read"><span>Section A:</span>Reading</p> -->
                                                        <ul class="section-uls">
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">AQA Biology – Text Book</a>
                                                            </li>
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">AQA Chemistry – Text Book</a>
                                                            </li>
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">AQA GCSE (9-1) Biology Draft E-Book</a>
                                                            </li>
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">AQA GCSE (9-1) Chemistry Draft E-Book</a>
                                                            </li>
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">AQA GCSE (9-1) Physics Draft E-Book</a>
                                                            </li>
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">AQA Physics – Text Book</a>
                                                            </li>
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">Graph Paper</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header" id="headingresone">
                                        <p class="mb-0">
                                            <button class="btn btn-link custom-link-coll collapsed" data-toggle="collapse" data-target="#collapseressix" aria-expanded="true" aria-controls="collapseres">
                                                <span>Useful Links </span>
                                            </button>
                                        </p>
                                    </div>

                                    <div id="collapseressix" class="collapse" aria-labelledby="headingresone" data-parent="#accordion3">
                                        <div class="card-body">

                                            <div class="row padding-paper">
                                                <div class="col-md-12 col-paper">
                                                    <div class="mr-2">
                                                        <!-- <p class="section-read"><span>Section A:</span>Reading</p> -->
                                                        <ul class="section-uls">
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">GCSE Science</a>
                                                            </li>
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">Churchill Maths</a>
                                                            </li>
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="">BBC Education</a>
                                                            </li>
                                                            <li><a href="https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf" targer="_blank" download="" ">My Maths</a>
                                                        </li>
                                                        <li><a href=" https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf " targer=" _blank " download=" ">My GCSE Science</a>
                                                        </li>
                                                        <li><a href=" https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf " targer=" _blank " download=" ">TES</a>
                                                        </li>
                                                        <li><a href=" https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf " targer=" _blank " download=" ">Maths Genie</a>
                                                        </li>
                                                        <li><a href=" https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf " targer=" _blank " download=" ">Save My Exams</a>
                                                        </li>
                                                        <li><a href=" https://www.scienceclinic.co.uk/wp-content/uploads/2019/08/AQA-Biology-Text-Book.pdf " targer=" _blank " download=" ">Education Using PowerPoint</a>
                                                        </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                            
                                              
                                          </div>
                                          </div>
                                        </div>
                                      </div>
                                   
                                   
                                    
                                      
                                      </div> 
                                  </div>
                            </div>
                        </div>
                        
                    </div>
               
               
               
                </div>
            </div>
        </div>
        
       
        @include('frontend.subject_offer.subject_offer')
        <!-- English Testimonials area Start-->
        @include('frontend.testimonial.testmonial')
                <!-- English Testimonials area End-->
        <!-- English Testimonials area End-->

    
        <!--Footer Area Start-->
       <div id=" footer">
                                                    </div>
                                                    <!--End of Footer Area-->
                                                </div>
                                                <!--End of Bg White-->
                                            </div>
                                            <!--End of Main Wrapper Area-->


                                            @endsection
                                            @section('page-js')
                                            <script>
                                                $('.testimonial-english').owlCarousel({
                                                    loop: false,
                                                    margin: 10,
                                                    nav: true,
                                                    navText: ["<img src='{{ asset('front/img/svg/left-arrow-test.png') }}'>",
                                                        "<img src='{{ asset('front/img/svg/right-arrow-test.png') }}'>"
                                                    ],
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
                                            </script>


                                            <script>
                                                //header footer script
                                                $(document).ready(function() {
                                                    $("#header").load("header.html");
                                                });

                                                $(document).ready(function() {
                                                    $("#footer").load("footer.html");
                                                });
                                            </script>
                                            @endsection