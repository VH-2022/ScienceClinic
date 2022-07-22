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
                                            <img src="img/banner/mimg4.jpeg"
                                                class="img-over" alt="Jenny of Oldstones" />
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
                                            <img src="img/banner/eimg3.png"
                                                class="img-over" alt="Jenny of Oldstones" />
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
                                            <img src="img/banner/pimg5.png"
                                                class="img-over" alt="Jenny of Oldstones" />
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
                                            <img src="img/banner/bimg1.jpg"
                                                class="img-over" alt="Jenny of Oldstones" />
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
                                            <img src="img/banner/cimg2.png"
                                                class="img-over" alt="Jenny of Oldstones" />
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
                                            <img src="img/banner/computer.png"
                                                class="img-over" alt="Jenny of Oldstones" />
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
                                            <img src="img/banner/primary.png"
                                                class="img-over" alt="Jenny of Oldstones" />
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
                                            <img src="https://kaleela.com/wp-content/uploads/2021/03/Five-of-the-Top-Foreign-Languages-to-Learn-in-2021-1024x710.png"
                                                class="img-over" alt="Jenny of Oldstones" />
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
                                            <img src="img/banner/other.png"
                                                class="img-over" alt="Jenny of Oldstones" />
                                        </div>
                                    </a>
                                </div>
    
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 offset-lg-0 col-md-12 col-12">
                            <div class="owl-carousel owl-theme testimonial-english">
                                <div class="item">
                                    <div class="card single-product-item">
                                        <div class="card-body single-product-text card-pdtestimonial">
                                            <div class="content-slideeng">
                                                <div class="slider-feedsec">
                                                    <div class="quotes-testi testi1">
                                                        <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            We would like to pass on our feedback and show appreciation for Mr Hamalabi from Science Clinic Private Tutoring Ltd who worked with our daughter and improved her Chemistry & Physics skills in the run up to her GCSE exams He was only with us for a short
                                                            time but the work he did in that short period of time was unbelievable. Kayleigh got A* in both subjects.

                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - B.K. Thomas
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="./img/svg/right-quotes.png" alt="right-quotes">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card single-product-item">
                                        <div class="card-body single-product-text card-pdtestimonial">
                                            <div class="content-slideeng">
                                                <div class="slider-feedsec">
                                                    <div class="quotes-testi testi1">
                                                        <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            Thank you Science Clinic Private Tutoring Ltd for your prompt and efficient service. It was so simple, I wish we had found you sooner.

                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - C.H. (Colchester)
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="./img/svg/right-quotes.png" alt="right-quotes">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card single-product-item">
                                        <div class="card-body single-product-text card-pdtestimonial">
                                            <div class="content-slideeng">
                                                <div class="slider-feedsec">
                                                    <div class="quotes-testi testi1">
                                                        <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            Can't believe how quickly this has worked. I went on the Internet on 15th January and Chloe had a lesson today with Mr Hamalabi who is only 5 minutes drive away from us. We are so pleased and delighted.

                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - J.J. Brown
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="./img/svg/right-quotes.png" alt="right-quotes">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card single-product-item">
                                        <div class="card-body single-product-text card-pdtestimonial">
                                            <div class="content-slideeng">
                                                <div class="slider-feedsec">
                                                    <div class="quotes-testi testi1">
                                                        <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            I would like you to know how delighted we have been with Mr Hamalabi who has provided home tuitions in Physics, Mathematics & Chemistry to my daughter for 3 years. She went from C grade at the end of year 9 to getting A*, A & A respectively in her GCSE.

                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - J.C. Paula
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="./img/svg/right-quotes.png" alt="right-quotes">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card single-product-item">
                                        <div class="card-body single-product-text card-pdtestimonial">
                                            <div class="content-slideeng">
                                                <div class="slider-feedsec">
                                                    <div class="quotes-testi testi1">
                                                        <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            We are grateful to Mr Hamalabi from Science Clinic Private Tutoring Ltd for giving Tom confidence and for assisting him greatly in improving his performance to the level of getting A & A* in Biology, Chemistry & Physics.

                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - C.K. Tommy
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="./img/svg/right-quotes.png" alt="right-quotes">
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
@endsection