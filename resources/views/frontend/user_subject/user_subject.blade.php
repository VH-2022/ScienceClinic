@extends('layouts.frontend')
@section('content')
<div class="backgrount-area  bg-engbakground  full-grayoverlay" style="height: 620px;">
    <div class="banner-content padding-headsection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content-wrapper text-center full-width">
                        <div class="text-content text-center-content">
                            <h1 class="title1 text-center max-englishtext mb-20">
                                <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight"><span aria-label="English Language &amp; Literature Tuition" style="visibility: hidden;"><span class="word1" aria-hidden="true" aria-label="English" style="display: inline-block; transform: translate3d(0px, 0px, 0px);">
                                        </span>
                                        <ul class="texts" style="display: none;">
                                            <li class="current">English Language &amp; Literature Tuition</li>
                                        </ul>
                                    </span>
                            </h1>


                            <div class="literature-text">
                                <h3 class="mb-2">{{ $query->sub_title_one }}
                                </h3>
                                <p class="mb-2">
                                    {{ $query->sub_title_two }}:
                                </p>
                                <ul>
                                    @foreach ($bannerSection as $val)
                                    <li><a href="{{ $val->link }}" class="cambridge-text-link">{{ $val->title }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="banner-readmore">
                                <a class="button-default inline" href="find-tutor.html">Find a Tutor</a>
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
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div>
                    @if ($query->image != '')
                    <img src="{{ $query->image }}">
                    @else
                    @endif

                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="qualified-text">
                    <div class="single-item-text">
                        <h4 class="mb-3">{{ $query->title }}
                        </h4>
                    </div>
                    <div class="qualified-details">
                        <p>
                            {!! $query->description !!}

                        </p>


                    </div>
                </div>
            </div>
        </div>
        <div class="relevant-specific">
            @foreach ($SectionTwo as $keys_val)
            <div class="relevant-and-diverse">
                <h4 class="title">{{ $keys_val->title }}
                </h4>
                <p>
                    {!! $keys_val->description !!}
                </p>

            </div>
            @endforeach


            <div class="relevant-and-diverse">
                <h4 class="title">Assessments</h4>
                <p>
                    The exam boards we use have designed assessments that will inspire and motivate students,
                    providing appropriate stretch and challenge whilst ensuring, as far as possible, that the
                    assessment and texts are accessible to the full range of students.
                </p>
                <p>
                    The specifications offer a skills-based approach to the study of English Language in an
                    untiered context. Questions are designed to take students on an assessment journey
                    through lower tariff tasks to more extended responses.
                </p>
                <p>
                    For AQA spec, GCSE students focus on the following for their exams;
                </p>
                <div>
                    <ul class="biolody-ul pt-2 pb-2 pl-3">
                        <li><img src="img/svg/right-arrow.png" class="list-down">Explorations in creative reading
                            and writing
                        </li>
                        <li><img src="img/svg/right-arrow.png" class="list-down">Writers’ viewpoints and
                            perspectives
                        </li>
                        <li><img src="img/svg/right-arrow.png" class="list-down">Non-exam assessment (Spoken
                            Language)
                        </li>
                    </ul>
                </div>
                <div class="paper-section">
                    <div class="paper-card">
                        <div class="paper-body">
                            <div class="paper-flex">
                                <h5 class="mb-3">There are two papers for English Language at GCSE level
                                </h5>
                            </div>
                            <div id="accordion">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingOne">
                                        <p class="mb-0">
                                            <button class="btn btn-link custom-link-coll collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span>Paper 1: </span> Explorations in Creative Reading and Writing
                                            </button>
                                        </p>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>What's assessed?</p>
                                            <div class="row padding-paper">
                                                <div class="col-md-12 col-paper">
                                                    <div class="mr-2">
                                                        <p class="section-read"><span>Section A:</span>Reading</p>
                                                        <ul class="section-uls">
                                                            <li>one literature fiction text</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-paper">
                                                    <div>
                                                        <p class="section-read"><span>Section B: </span>Writing</p>
                                                        <ul class="section-uls">
                                                            <li>descriptive or narrative writing
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <p class="written-time">The written exam is 1 hour 45 minutes
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header" id="headingTwo">
                                        <p class="mb-0">
                                            <button class="btn btn-link custom-link-coll collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                <span>Paper 2:</span> Writers' Viewpoints and Perspectives
                                            </button>
                                        </p>
                                    </div>

                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>What's assessed?</p>
                                            <div class="row padding-paper">
                                                <div class="col-md-12 col-paper">
                                                    <div class="mr-2">
                                                        <p class="section-read"><span>Section A:</span>Reading</p>
                                                        <ul class="section-uls">
                                                            <li>one non-fiction text and one literary non-fiction text
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-paper">
                                                    <div>
                                                        <p class="section-read"><span>Section B: </span>Writing</p>
                                                        <ul class="section-uls">
                                                            <li>writing to present a viewpoint
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <p class="written-time">The written exam is 1 hour 45 minutes
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="paper-card">
                        <div class="paper-body">
                            <div class="paper-flex">
                                <h5 class="mb-3">There are also two papers for English Literature at GCSE
                                    level
                                </h5>
                            </div>
                            <div id="accordion">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingThree">
                                        <p class="mb-0">
                                            <button class="btn btn-link custom-link-coll collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                <span>Paper 1:</span> Shakespeare and the 19th-century novel
                                            </button>
                                        </p>
                                    </div>

                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>What's assessed?</p>
                                            <div class="row padding-paper">
                                                <div class="col-md-12 col-paper">
                                                    <div class="mr-2">
                                                        <p class="section-read"><span>Section A:</span>Reading</p>
                                                        <ul class="section-uls">
                                                            <li>Shakespeare plays </li>
                                                        </ul>
                                                        <p>
                                                            Students will answer one question on their play of choice.
                                                            They will be required to write in detail
                                                            about an extract from the play and then to write about the
                                                            play as a whole.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-paper">
                                                    <div>
                                                        <p class="section-read"><span>Section B: </span>Writing</p>
                                                        <ul class="section-uls">
                                                            <li>The 19th-century nove
                                                            </li>
                                                        </ul>
                                                        <p>Students will answer one question on their novel of choice.
                                                            They will be required to write in detail
                                                            about an extract from the novel and then to write about the
                                                            novel as a whole.</p>
                                                    </div>
                                                </div>
                                                <p class="written-time">The written exam is 1 hour 45 minutes
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card mb-3">
                                    <div class="card-header" id="headingFour">
                                        <p class="mb-0">
                                            <button class="btn btn-link custom-link-coll collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                <span>Paper 2:</span> Modern texts and poetry

                                            </button>
                                        </p>
                                    </div>

                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>What's assessed?</p>
                                            <div class="row padding-paper">
                                                <div class="col-md-12 col-paper">
                                                    <div class="mr-2">
                                                        <p class="section-read"><span>Section A:</span>Reading</p>
                                                        <ul class="section-uls">
                                                            <li>Modern prose or drama texts </li>
                                                        </ul>
                                                        <p>
                                                            Students will answer one essay question from a choice of two
                                                            on their studied modern prose or drama text.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-paper">
                                                    <div>
                                                        <p class="section-read"><span>Section B: </span>Writing</p>
                                                        <ul class="section-uls">
                                                            <li>The poetry anthology
                                                            </li>
                                                        </ul>
                                                        <p>
                                                            Students will answer one comparative question on one named
                                                            poem printed on the paper and one other poem from their
                                                            chosen anthology cluster.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-paper">
                                                    <div>
                                                        <p class="section-read"><span>Section C: </span>Writing</p>
                                                        <ul class="section-uls">
                                                            <li>Unseen poetry
                                                            </li>
                                                        </ul>
                                                        <p>
                                                            Students will answer one comparative question on one named
                                                            poem printed on the paper and one other poem from their
                                                            chosen anthology cluster.
                                                        </p>
                                                    </div>
                                                </div>
                                                <p class="written-time">Written exam for 2 hour 15 minutes</p>
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
<div class="gcse-text english-text">
    <div class="container">
        <!-- <div class="gcseflexcenter">
                            <div class="gcse-titles text-center">
                                <h5 class="title1 text-center mb-20">
                                    <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight">GCSE (9-1) English</span>
                                </h5>
                                <p class="pt-2 pb-2">
                                    <span style="font-weight: 700;">AQA</span> Explorations in creative reading and writing,
                                    writers’ viewpoints and perspectives, Shakespeare and the 19th-century novel, modern
                                    texts and poetry.
                                </p>
                            </div>
                        </div> -->
        <div class="row  mb-lg-4">
            <div class="col-md-6">
                <div class="chemistry-icon-text">
                    <a href="./pdf/AQA-GCSE-Maths-9-1-Specification-1.pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>AQA GCSE
                        English Language (9-1) Specification</a>
                </div>
                <div class="chemistry-icon-text">
                    <a href="./pdf/AQA-LIT.pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>AQA GCSE
                        English Literature (9-1) Specification Summary</a>
                </div>
            </div>
            <!-- <div class="col-md-6">
                                <div class="chemistry-icon-text">
                                    <a href="./pdf/Edexcel-ENG-lang.pdf" target="_blank" type="button"
                                        class="btn download-pdfs"><i class="fa fa-book mr-2"></i>Edexcel
                                        GCSE English Language (9-1) Specification</a>
                                </div>
                                <div class="chemistry-icon-text">
                                    <a href="./pdf/Edexcel-English-Language-Assement-material.pdf" target="_blank"
                                        type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>Edexcel GCSE English Language (9-1) Assessment</a>
                                </div>
                                <div class="chemistry-icon-text">
                                    <a href="./pdf/Edexcel-English-LIT.pdf" target="_blank" type="button"
                                        class="btn download-pdfs"><i class="fa fa-book mr-2"></i>Edexcel
                                        GCSE English Language (9-1) Specification</a>
                                </div>
                                <div class="chemistry-icon-text">
                                    <a a href="./pdf/Edexcel-English-lite-Assessment.pdf" target="_blank" type="button"
                                        class="btn download-pdfs"><i class="fa fa-book mr-2"></i>Edexcel GCSE English Language (9-1) Assessment</a>
                                </div>
                            </div> -->
            <div class="col-md-6">
                <p>We also teach the following Specifications :</p>
                <div class="chemistry-icon-text">
                    <a href="./pdf/GCSE-Cambridge-Physics-9-1-Specification.pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>Edexcel GCSE (9-1) Specifications</a>
                </div>
                <div class="chemistry-icon-text">
                    <a href="./pdf/GCSE-Cambridge-Physics-9-1-Specification (1).pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>Cambridge GCSE (9-1)
                        Specifications</a>
                </div>
                <div class="chemistry-icon-text">
                    <a href="./pdf/GCSE-OCR-Gateway-Physics-9-1-Specification.pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>OCR Gateway GCSE (9-1)
                        Specifications</a>
                </div>
                <div class="chemistry-icon-text">
                    <a a="" href="./pdf/Edexcel-English-lite-Assessment.pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>OCR 21st Century GCSE (9-1)
                        Specifications</a>
                </div>
                <div class="chemistry-icon-text">
                    <a href="./pdf/IGCSE-Physics-9-1-Specification.pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>Edexcel IGCSE (9-1)
                        Specifications</a>
                </div>
                <div class="chemistry-icon-text">
                    <a href="./pdf/Edexcel-English-Language-Assement-material.pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>Nat 5 (Scottish spec) – English
                        Language &amp; Literature Specs</a>
                </div>
                <div class="chemistry-icon-text">
                    <a href="./pdf/Edexcel-English-LIT.pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>Eduqas (Welsh spec) – English Language &amp; Literature
                        Spec</a>
                </div>
                <div class="chemistry-icon-text">
                    <a a="" href="./pdf/Edexcel-English-lite-Assessment.pdf" target="_blank" type="button" class="btn download-pdfs"><i class="fa fa-book mr-2"></i>NI spec – English Language &amp;
                        Literature Spec</a>
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
                                <img src="img/banner/mimg4.jpeg" class="img-over" alt="Jenny of Oldstones">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="english-language-literature-tuition.html">
                            <div class="media">
                                <div class="gall-overlays"></div>
                                <div class="layer">
                                    <h2>English Language &amp; Literature</h2>
                                </div>
                                <img src="img/banner/eimg3.png" class="img-over" alt="Jenny of Oldstones">
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
                                <img src="img/banner/pimg5.png" class="img-over" alt="Jenny of Oldstones">
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
                                <img src="img/banner/bimg1.jpg" class="img-over" alt="Jenny of Oldstones">
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
                                <img src="img/banner/cimg2.png" class="img-over" alt="Jenny of Oldstones">
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
                                <img src="img/banner/computer.png" class="img-over" alt="Jenny of Oldstones">
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
                                <img src="img/banner/primary.png" class="img-over" alt="Jenny of Oldstones">
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
                                <img src="https://kaleela.com/wp-content/uploads/2021/03/Five-of-the-Top-Foreign-Languages-to-Learn-in-2021-1024x710.png" class="img-over" alt="Jenny of Oldstones">
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
                                <img src="img/banner/other.png" class="img-over" alt="Jenny of Oldstones">
                            </div>
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection