
{{-- @Utility:: getAllTestimonialList(); --}}
@php 
    $testimonialList =Utility:: getAllTestimonialList();
   

@endphp
    <div class="testimonial-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 offset-lg-0 col-md-12 col-12">
                    <div class="owl-carousel owl-theme testimonial-english">
                        @foreach ($testimonialList as $val)
                        <div class="item">

                            <div class="card single-product-item">
                                <div class="card-body single-product-text card-pdtestimonial">
                                    <div class="content-slideeng">
                                        
                                            <div class="slider-feedsec">
                                                <div class="quotes-testi testi1">
                                                    <img src="{{ asset('front/img/svg/left-quotes.png') }}"
                                                        alt="left-quotes">
                                                </div>
                                                <div class="max-textquote">
                                                    <p class="mb-0 we-likep">
                                                        <h5>
                                                      
                                                                {!! $val->description !!}
                                                           
                                                        </h5>
                                                    </p>
                                                    <p class="float-right writer-text">
                                                
                                                        {{ $val->author_name }}
                                                 
                                                    </p>
                                                </div>
                                                <div class="quotes-testi testi2">
                                                    <img src="{{ asset('front/img/svg/right-quotes.png') }}"
                                                        alt="right-quotes">
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

