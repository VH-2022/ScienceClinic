@extends('layouts.frontend')
@section('content')
<div class="backgrount-area bg-chemistry  full-grayoverlay">
                <div class="banner-content padding-headsection">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-content-wrapper text-center full-width">
                                    <div class="text-content text-center-content">
                                        <h1 class="title1 text-center max-englishtext mb-20">
                                            <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight">E-Learning Tuition</span>
                                        </h1>
                                        <p>Give your child the best education possible with tutoring from our experienced & dedicated UK teachers!</p>
                                        <div class="literature-text banner-ul">
                                            <p class="mb-2">
                                                We teach the following specifications in E-Learning  :
                                            </p>
                                            <ul>
                                                <li><a href="https://www.aqa.org.uk/" class="cambridge-text-link">AQA</a></li>
                                                <li><a href="https://qualifications.pearson.com/en/home.html" class="cambridge-text-link">Pearson EDEXCEL</a></li>
                                                <li><a href="https://ocr.org.uk/" class="cambridge-text-link">OCR</a></li>
                                                <li><a href="https://www.wjec.co.uk/" class="cambridge-text-link">WJEC</a></li>
                                                <li><a href="https://www.cambridgeinternational.org/about-us/" class="cambridge-text-link">Cambridge</a></li>
                                                <li><a href="https://www.sqa.org.uk/sqa/30030.html" class="cambridge-text-link">Scottish Specs</a></li>
                                                <li><a href="https://ccea.org.uk/" class="cambridge-text-link">NI specs</a></li>
                                                <li><a href="https://www.aqa.org.uk/subjects/science/ks3/ks3-science-syllabus" class="cambridge-text-link">KS3</a></li>
                                            </ul>
                                         
                                        </div>
                                        <!-- <p>
                                            At Science Clinic Private Tutoring we offer a range of tuition services aimed at providing learning and skills for Key stage 3, GCSE/IGCSE, A-Level, levels of education. We work with your child’s current syllabus to ensure they receive expert tuition
                                            in a structured and fun way.
                                        </p> -->
                                        <div class="banner-readmore">
                                            <a class="button-default inline" href="{{route('find-tutor')}}">Find a Tutor</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="english-abc">
                <div class="container">
                    @if(count($getElearning) > 0)
                    @php $i=1; @endphp
                        @foreach($getElearning as $key)
                        @php   $extension = pathinfo($key->upload_data, PATHINFO_EXTENSION); @endphp
                        @php $image = ''; @endphp
                                @if(strtolower($extension) != 'pptx' && strtolower($extension) != 'docx' && strtolower($extension) != 'doc' && strtolower($extension) != 'pdf')
                                    
                                    @php $image = $key->upload_data; @endphp

                                @endif

                        @if($i % 2 == 0)
                        @if($image !='')
                            

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                            <div class="qualified-text">
                                    <div class="single-item-text">
                                        <h4 class="mb-3">{{$key->title}}
                                        </h4>
                                    </div>
                                    <div class="qualified-details">
                                    {!!$key->description!!}
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <div class="bio-img">
                                
                                    <a href="{{$key->upload_data}}" target="_blank"><img src="{{$image}}" class="img-sci-bios" alt="chemist-img"></a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @else

                        @if($image !='')
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="bio-img">
                                <a href="{{$key->upload_data}}" target="_blank"><img src="{{$image}}" class="img-sci-bios" alt="chemist-img"></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="qualified-text">
                                    <div class="single-item-text">
                                        <h4 class="mb-3">{{$key->title}}
                                        </h4>
                                    </div>
                                    <div class="qualified-details">
                                    {!!$key->description!!}
                                    </div>
                                </div>
                            </div>
                        </div>   
                        @endif

                        @endif
                        
                    @php $i++; @endphp
                        @endforeach
                    @endif
                    
                   
                    
                </div>
            </div>
            <div class="gcse-text chemistry-gcse-text">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="paper-section">

                            @if(count($getElearning) > 0)
                                 @php $j=1; @endphp                   
                                @foreach($getElearning as $key)
                                @php   $extension = pathinfo($key->upload_data, PATHINFO_EXTENSION); @endphp
                                @php $image = ''; @endphp
                                @if(strtolower($extension) == 'pptx' || strtolower($extension) == 'docx' || strtolower($extension) == 'doc' || strtolower($extension) == 'pdf')
                                    
                                    @php $image = $key->upload_data; @endphp

                                    @if($image !='')
                                    <div class="paper-card">
                                    <div class="paper-body">
                                        <div class="paper-flex">
                                            <h5 class="mb-3">{{$key->title}}
                                            </h5>
                                        </div>
                                        <div id="accordion{{$j}}">
                                            <div class="card mb-3">
                                                <div class="card-header" id="headingOne{{$j}}">
                                                    <p class="mb-0">
                                                        <button class="btn btn-link custom-link-coll collapsed"
                                                            data-toggle="collapse" data-target="#collapseOne{{$j}}"
                                                            aria-expanded="true" aria-controls="collapseOne{{$j}}">
                                                            {{strtoupper($extension)}}
                                                        </button>
                                                    </p>
                                                </div>

                                                <div id="collapseOne{{$j}}" class="collapse" aria-labelledby="headingOne{{$j}}"
                                                    data-parent="#accordion{{$j}}">
                                                    <div class="card-body">
                                                        <div class="row padding-paper">
                                                            <div class="col-md-12 col-paper">
                                                                <div class="qualified-details">
                                                                    {!! $key->description !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                    @endif

                                @endif
                                @php $j++; @endphp  
                                @endforeach 
                            @endif

                                
                            </div>
                        </div>
                       
                        
                        
                    </div>
                </div>
            </div>
            
            @include('frontend.subject_offer.subject_offer')
            @include('frontend.testimonial.testmonial')

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
@endsection