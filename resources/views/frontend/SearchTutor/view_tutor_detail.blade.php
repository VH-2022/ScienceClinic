@extends('layouts.frontend')
@section('content')
@section('page-css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">
@endsection
<div class="as-mainwrapper">
    <!--Bg White Start-->
    <div class="bg-white">
        <!--Header Area Start-->
        <div id="header"></div>
        <!--End of Header Area-->
        <section class="tutors-details">
            <div class="course-details-area section-padding tutor-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-12">
                            <div class="course-details-content">
                                <div class="single-course-details mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-5">
                                            <div class="overlay-effect">
                                                <img alt="" src="{{$data->profile_photo}}" class="tutors-detailimg">
                                            </div>
                                        </div>
                                        <div class="col-md-7" style="padding-left: 0px;">
                                            <div class="single-item-text">

                                                <h4>{{$data->first_name}} – Science</h4>
                                                <div class="course-text-content tutors-content">
                                                    <p>Fully Qualified Science Teacher (all 3 Sciences) with QTS</p>

                                                </div>
                                                <div class="single-item-content  pt-3">
                                                    <div class="title-education">
                                                        <h5>EDUCATION</h5>
                                                    </div>

                                                    <div class="title-eductiondetails">
                                                        @foreach($tutorUniversityDetails as $value)
                                                        <p><span style="font-weight:600;">{{$value->university_name}}: </span>{{$value->qualification}}
                                                        </p>
                                                        @endforeach
                                                    </div>

                                                </div>
                                                <div class="button-total">

                                                    <a class="button-default inline" href="#down">Enquire About
                                                        {{$data->first_name}} – Science</a>
                                                </div>

                                                <div class="dbs-check dbs-checked-box">
                                                    @if($tutorDetails->dbs_disclosure == "Yes")
                                                    <h5 class=" dbs mr-2">DBS checked</h5>
                                                    @endif


                                                </div>
                                                <div class="">
                                                    <h5 class=" dbs mr-2">Qualifications on file</h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="bio-text">
                                    <div class="single-item-content pt-0 pb-2">

                                        <div class="title-eductiondetails">
                                            <div class="title-education">
                                                <h5>BIO</h5>
                                            </div>
                                            <div class="pt-3">
                                                <p>{{$data->bio}}.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="title-education mb-3">
                                    <h5>Availability Calendar</h5>
                                </div>
                                <div class="main-custom-calendar">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-12 ">
                            <div class="p-tags ">
                                <div class="side-subject mb-5 ">
                                    <div class="subject-details ">
                                        <div class="title-education mb-3 ">
                                            <h5>SUBJECTS</h5>
                                        </div>
                                        <div class="education-subject">
                                            @foreach($tutorSubjectDetails as $value)
                                            <ul class="subject-tutor-ul ">
                                                <p style="font-weight: 600; ">{{$value->subjectMasters->main_title}}</p>
                                                <li><img src="{{asset('front/img/svg/right-arrow.png')}} " class="list-arrows ">A-level
                                                </li>
                                                <li><img src="{{asset('front/img/svg/right-arrow.png')}} " class="list-arrows ">AS</li>
                                                <li><img src="{{asset('front/img/svg/right-arrow.png')}} " class="list-arrows ">GCSE
                                                </li>
                                                <li><img src="{{asset('front/img/svg/right-arrow.png ')}}" class="list-arrows ">KS3
                                                </li>
                                            </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                

                                <div class="main-custom-calendar">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="comments comments-overflow-show" id="down">
                                <div class="section-title-wrapper">
                                    <div class="section-title">
                                        <h3 class="mb-4">Tutor Enquiry</h3>
                                    </div>

                                </div>
                                <div class="contact-form-area tutors-detail-form">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10 col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <label class="tutor-label">First Name</label>
                                                    <input type="text " name="name " placeholder="First Name ">
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <label class="tutor-label">Last Name</label>
                                                    <input type="text" name="text" placeholder="Last Name ">
                                                </div>

                                                <div class="col-md-6 col-lg-6 ">
                                                    <label class="tutor-label">Email</label>
                                                    <input type="text " name="name " placeholder="Email ">
                                                </div>
                                                <!-- <div class="col-md-4">
                                                        <label class="tutor-label">Password</label>
                                                        <input type="password" name="password" placeholder="Password">
                                                    </div> -->
                                                <div class="col-md-6 col-lg-6">
                                                    <label class="tutor-label">Phone</label>
                                                    <input type="email " name="email " placeholder="Phone ">
                                                </div>
                                                <div class="col-md-6 col-lg-6 mb-23">
                                                    <label class="tutor-label">Subject</label>
                                                    <div class="subject-custom">
                                                        <select class="selectpicker select-sub " multiple aria-label="Default select example" data-live-search="true">
                                                            <option value="1" selected>Maths</option>
                                                            <option value="2">Further Maths (GCSE)
                                                            </option>
                                                            <option value="3">Further Maths (A-level) </option>
                                                            <option value="4">Maths </option>

                                                            <option value="5">Maths (A-Level)
                                                            </option>
                                                            <option value="6"> Maths (Degree)
                                                            </option>
                                                            <option value="7">Maths (GCSE)
                                                            </option>
                                                            <option value="8">Maths (KS3)
                                                            </option>
                                                            <option value="9">Maths (National 5)
                                                            </option>
                                                            <option value="10">Maths (Primary)
                                                            </option>
                                                            <option value="11">Maths (Scottish Highers)
                                                            </option>
                                                            <option value="12">Mechanics
                                                            </option>
                                                            <option value="13">Mechanics (A-Level)
                                                            </option>
                                                            <option value="14">Mechanics (Scottish Highers)
                                                            </option>
                                                            <option value="15">Pure Maths
                                                            </option>
                                                            <option value="16">Statistics
                                                            </option>


                                                            <option value="17">Statistics (A-Level)
                                                            </option>
                                                            <option value="18">Statistics (Scottish Highers)

                                                            </option>
                                                            <option value="19">English
                                                            </option>
                                                            <option value="20">English Language (A-Level)
                                                            </option>
                                                            <option value="21">English Language (GCSE)
                                                            </option>
                                                            <option value="22">English (KS3)
                                                            </option>
                                                            <option value="23">English (National 5)
                                                            </option>
                                                            <option value="24">English (Primary)
                                                            </option>
                                                            <option value="25">English (Scottish Highers)

                                                            </option>
                                                            <option value="26">English Literature (National 5)
                                                            </option>
                                                            <option value="27">English Literature (Scottish Highers)

                                                            </option>
                                                            <option value="28">Science

                                                            </option>
                                                            <option value="29">Biochemistry
                                                            </option>
                                                            <option value="30">Biology (A-Level)
                                                            </option>
                                                            <option value="31">Biology (GCSE)

                                                            </option>
                                                            <option value="32">Biology (National 5)
                                                            </option>
                                                            <option value="33">Biology (Scottish Highers)

                                                            </option>
                                                            <option value="34">Biomedical Science
                                                            </option>
                                                            <option value="35">Chemistry (A-Level)

                                                            </option>
                                                            <option value="36">Chemistry (GCSE)

                                                            </option>
                                                            <option value="37">Chemistry (National 5)
                                                            </option>
                                                            <option value="38">Chemistry (Scottish Highers)

                                                            </option>
                                                            <option value="39">Environmental Science

                                                            </option>
                                                            <option value="40">Physics (A-Level)
                                                            </option>
                                                            <option value="41">Physics (GCSE)

                                                            </option>
                                                            <option value="42">Physics (National 5)

                                                            </option>
                                                            <option value="43">Physics (Scottish Highers)
                                                            </option>
                                                            <option value="44">Science (A-Level)

                                                            </option>
                                                            <option value="45">Science (GCSE)

                                                            </option>
                                                            <option value="46">Science (National 5)

                                                            </option>
                                                            <option value="47">Science (Scottish Highers)

                                                            </option>
                                                            <option value="48">Primary and Early Years

                                                            </option>
                                                            <option value="49">Early Years and Reception</option>
                                                            <option value="50">Eleven Plus 11+ </option>
                                                            <option value="51"> Primary</option>
                                                            <option value="52"> Primary (Key Stage 1)</option>
                                                            <option value="53"> Primary (Key Stage 2)</option>
                                                            <option value="54"> SATs
                                                            </option>
                                                            <option value="55">Essay Writing
                                                            </option>
                                                            <option value="56"> Phonics
                                                            </option>
                                                            <option value="57"> Reading
                                                            </option>
                                                            <option value="58"> Writing
                                                            </option>
                                                            <option value="59"> Humanities & Arts
                                                            </option>
                                                            <option value="60">Art
                                                            </option>
                                                            <option value="61">Citizenship
                                                            </option>
                                                            <option value="62"> Design and Technology</option>
                                                            <option value="63"> Drama
                                                            </option>
                                                            <option value="64">Economics
                                                            </option>
                                                            <option value="65">Economics (A-Level)
                                                            </option>
                                                            <option value="66">Economics (GCSE)
                                                            </option>
                                                            <option value="67"> Economics (National 5)</option>
                                                            <option value="68">Economics (Scottish Highers)
                                                            </option>
                                                            <option value="69">Food Technology
                                                            </option>
                                                            <option value="70">Geography </option>
                                                            <option value="71">Geography (A-Level) </option>
                                                            <option value="72">Geography (GCSE)
                                                            </option>
                                                            <option value="73">Geography (National 5)
                                                            </option>
                                                            <option value="74">Geography (Scottish Highers) </option>
                                                            <option value="75">History
                                                            </option>
                                                            <option value="76">History (A-Level) </option>
                                                            <option value="77"> History (GCSE)
                                                            </option>
                                                            <option value="78">History (National 5)
                                                            </option>
                                                            <option value="79">History (Scottish Highers) </option>
                                                            <option value="80"> History of Art</option>
                                                            <option value="81">Humanities </option>
                                                            <option value="82">Performing Arts
                                                            </option>

                                                            <option value="83">Philosophy
                                                            </option>

                                                            <option value="84">Philosophy (A-Level)
                                                            </option>

                                                            <option value="85"> Philosophy (Scottish Highers)
                                                            </option>

                                                            <option value="86"> Photography
                                                            </option>

                                                            <option value="87">Photography (A-Level)
                                                            </option>

                                                            <option value="88">Photography (Scottish Highers) </option>

                                                            <option value="89">Politics </option>
                                                            <option value="90"> Politics (GCSE)
                                                            </option>
                                                            <option value="91">Politics (National 5)
                                                            </option>
                                                            <option value="92">Psychology
                                                            </option>
                                                            <option value="90">Psychology (A-Level) </option>
                                                            <option value="93"> Psychology (GCSE)
                                                            </option>
                                                            <option value="94">Psychology (National 5) </option>
                                                            <option value="95">Psychology (Scottish Highers) </option>
                                                            <option value="96">Religious Education </option>
                                                            <option value="97">Sociology
                                                            </option>
                                                            <option value="98">Sociology (A-Level)
                                                            </option>
                                                            <option value="99">Sociology (GCSE)
                                                            </option>
                                                            <option value="100">Sociology (National 5) </option>
                                                            <option value="101">Sociology (Scottish Highers)
                                                            </option>
                                                            <option value="102">Languages
                                                            </option>
                                                            <option value="103">Arabic
                                                            </option>
                                                            <option value="104">English as a Foreign Language EFL
                                                            </option>
                                                            <option value="105">French
                                                            </option>
                                                            <option value="106">German
                                                            </option>
                                                            <option value="107">IELTS and ESOL </option>

                                                            <option value="108">Italian
                                                            </option>
                                                            <option value="109">Latin
                                                            </option>
                                                            <option value="110">Portuguese
                                                            </option>
                                                            <option value="111">Russian
                                                            </option>
                                                            <option value="112">Sign Language
                                                            </option>
                                                            <option value="113">Spanish
                                                            </option>
                                                            <option value="114">Business and Professional Studies
                                                            </option>
                                                            <option value="115">Accounting
                                                            </option>
                                                            <option value="116">Accounting (A-Level)
                                                            </option>
                                                            <option value="117">Accounting (Scottish Highers) </option>
                                                            <option value="118">Business Studies
                                                            </option>
                                                            <option value="119">Business Studies (A-Level)
                                                            </option>
                                                            <option value="120">Business Studies (Scottish Highers)
                                                            </option>
                                                            <option value="121">Law
                                                            </option>
                                                            <option value="122">Law (A-Level)
                                                            </option>
                                                            <option value="123">Law (Scottish Highers)</option>
                                                            <option value="124">Media Studies
                                                            </option>
                                                            <option value="125">Computing
                                                            </option>
                                                            <option value="126">ASP.net</option>
                                                            <option value="127">Acrobat
                                                            </option>
                                                            <option value="128">Android Development </option>
                                                            <option value="129">Apple
                                                            </option>
                                                            <option value="130">Autocad
                                                            </option>
                                                            <option value="131">Autodesk
                                                            </option>
                                                            <option value="132">Basic IT Skills
                                                            </option>
                                                            <option value="133">Computer Graphics </option>
                                                            <option value="134">Computer Literacy </option>
                                                            <option value="135">Computer Programming </option>
                                                            <option value="136">Computing
                                                            </option>
                                                            <option value="137">Databases </option>
                                                            <option value="138">HTML
                                                            </option>
                                                            <option value="139">ICT
                                                            </option>

                                                            <option value="140">Information Security </option>
                                                            <option value="141">Information Technology </option>
                                                            <option value="142">Java </option>
                                                            <option value="143">Matlab </option>
                                                            <option value="144">Microsoft Access
                                                            </option>
                                                            <option value="145"> Microsoft Excel </option>
                                                            <option value="146">Microsoft Office </option>
                                                            <option value="147">Microsoft Outlook </option>
                                                            <option value="148">Microsoft Powerpoint </option>
                                                            <option value="149">Microsoft Word </option>
                                                            <option value="150">PHP </option>
                                                            <option value="151">Programming
                                                            </option>
                                                            <option value="152">Python </option>
                                                            <option value="153">Ruby </option>
                                                            <option value="154">SQL
                                                            </option>
                                                            <option value="155">Search Engine Optimisation </option>
                                                            <option value="156">Web Design </option>
                                                            <option value="157">Special Educational Needs </option>
                                                            <option value="158">Autism </option>
                                                            <option value="159">Dyscalculia </option>
                                                            <option value="160">Dyslexia </option>
                                                            <option value="161">Dyspraxia </option>
                                                            <option value="162">Special Educational Needs </option>
                                                            <option value="163">Music
                                                            </option>
                                                            <option value="164">Bagpipes</option>
                                                            <option value="165">Banjo
                                                            </option>
                                                            <option value="166">Bass Guitar</option>
                                                            <option value="167">Bassoon </option>
                                                            <option value="168">Cello
                                                            </option>
                                                            <option value="169">Clarinet
                                                            </option>
                                                            <option value="170">Composition </option>
                                                            <option value="171">Conducting</option>
                                                            <option value="172">Cornet
                                                            </option>
                                                            <option value="173">Double Bass
                                                            </option>
                                                            <option value="174">Drums
                                                            </option>
                                                            <option value="175">Euphonium </option>
                                                            <option value="176">Flugel Horn
                                                            </option>
                                                            <option value="177">Flute
                                                            </option>
                                                            <option value="178">French Horn </option>
                                                            <option value="179">Guitar </option>
                                                            <option value="180">Harmonica</option>
                                                            <option value="181">Harp
                                                            </option>
                                                            <option value="182">Harpsichord
                                                            </option>
                                                            <option value="183">Keyboard
                                                            </option>
                                                            <option value="184">Mandolin
                                                            </option>
                                                            <option value="185">Music
                                                            </option>
                                                            <option value="186">Music Production
                                                            </option>
                                                            <option value="187">Music Technology</option>
                                                            <option value="188">Music Theory</option>
                                                            <option value="189">Oboe</option>
                                                            <option value="190">Organ
                                                            </option>
                                                            <option value="191">Percussion
                                                            </option>
                                                            <option value="192">Piano
                                                            </option>
                                                            <option value="193">Piccolo
                                                            </option>
                                                            <option value="194">Recorder

                                                            </option>
                                                            <option value="195">Saxophone
                                                            </option>
                                                            <option value="196">Singing
                                                            </option>
                                                            <option value="197">Sitar

                                                            </option>
                                                            <option value="198">Tenor Horn

                                                            </option>
                                                            <option value="199">Trombone
                                                            </option>
                                                            <option value="200">Trumpet

                                                            </option>
                                                            <option value="201">Tuba

                                                            </option>
                                                            <option value="202">Ukulele

                                                            </option>
                                                            <option value="203">Viola

                                                            </option>
                                                            <option value="204">Violin


                                                            </option>

                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 col-lg-6 mb-23">

                                                    <label class="tutor-label">Level of Tuition</label>
                                                    <div class="subject-custom">
                                                        <select class="selectpicker select-sub" multiple aria-label="Default select example" data-live-search="true">
                                                            <option value="levels" selected>A-level (Years 12 & 13)
                                                            </option>
                                                            <option value="gcse">GCSE/ IGCSE (Years 9,10 & 11)
                                                            </option>
                                                            <option value="ks3">KS3 (Years 7 & 8) </option>
                                                            <option value="ks2">KS2 (Years 4, 5 & 6) </option>
                                                            <option value="ks1">KS1 (Years 1, 2, & 3) </option>
                                                            <option value="scottish">Scottish Highers (S5) </option>
                                                            <option value="national">National 5 (S4) </option>
                                                            <option value="ib">IB </option>
                                                            <option value="adult">Adult learning & Functional Skills
                                                            </option>
                                                            <option value="plus1">11+ </option>
                                                            <option value="plus">13+ </option>
                                                            <option value="common">Common entrance Exam </option>
                                                            <option value="primary">Primary </option>
                                                            <option value="p1">P1 - P7 (Scottish Primary)</option>
                                                            <option value="s1">S1 - S3 (Scottish Secondary)
                                                            </option>



                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                        <label class="tutor-label">Address</label>
                                                        <textarea name="message" cols="20" rows="10" placeholder="Address"></textarea>
                                                    </div> -->
                                                <div class="col-md-6 col-lg-6">
                                                    <label class="tutor-label">Day of Tuition</label>
                                                    <select name="" id="">
                                                        <option>
                                                            Monday
                                                        </option>
                                                        <option>
                                                            Tuesday
                                                        </option>
                                                        <option>
                                                            Wednesday
                                                        </option>
                                                        <option>
                                                            Thursday
                                                        </option>
                                                        <option>
                                                            Friday
                                                        </option>
                                                        <option>
                                                            Saturday
                                                        </option>
                                                        <option>
                                                            Sunday
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <label class="tutor-label">Ideal Tuition Time</label>
                                                    <select name="" id="">
                                                        <option>
                                                            8am- 9am
                                                        </option>
                                                        <option>
                                                            9am - 10am
                                                        </option>
                                                        <option>
                                                            10am - 11am
                                                        </option>
                                                    </select>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                        <div class="terms-checkbox">
                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" class="terms-condition">
                                                            <p class="condition-text">Terms & conditions</p>
                                                        </div>
                                                    </div> -->
                                                <div class="col-md-12">
                                                    <label class="tutor-label">Address</label>
                                                    <textarea name="message" cols="20" rows="10" placeholder="Address" class="mb-2"></textarea>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <label class="tutor-label">Username</label>
                                                    <input type="text " name="name " placeholder="Username ">
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <label class="tutor-label">Password</label>
                                                    <input type="password" name="password" placeholder="Password">
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-check custom-check">
                                                        <input class="form-check-input terms-condition" type="checkbox" value="" id="defaultCheck1">
                                                        <label class="form-check-label condition-text" for="defaultCheck1">
                                                            <a class="condition-text" href="terms-and-conditions.html">Terms & conditions </a>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mr-0">
                                                    <div class="tutor-btn-end mr-0">
                                                        <div class="banner-readmore">
                                                            <a class="button-default inline" href="javascript:void(0)">submit</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="comments comments-overflow-show" id="down">
                                                        <div class="section-title-wrapper section-title-wrapper-star">
                                                            <div class="section-title">
                                                                <h3 class="mb-4">Reviews and References</h3>
                                                            </div>


                                                        </div>

                                                        <div class="mb-3 mt-3">
                                                            <label for="comment">Description</label>
                                                            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                                                            <span class="text-danger" id="error_description"></span>
                                                        </div>
                                                        <form action="">
                                                            <div class="row">
                                                                <div class="col-6">

                                                                    <div class="from-group">
                                                                        <label for="subject">Subject:</label>
                                                                        <input type="text" class="form-control" id="subject" placeholder="" name="subject">
                                                                    </div>
                                                                    <span class="text-danger" id="error_subject"></span>
                                                                </div>

                                                                <div class="col-6">
                                                                    <div class="from-group">
                                                                        <label for="outcome">Outcome:</label>
                                                                        <input type="text" class="form-control" id="outcome" placeholder="" name="outcome">
                                                                    </div>
                                                                    <span class="text-danger" id="error_outcome"></span>
                                                                </div>
                                                                <div class="stars-review">
                                                                    <div>
                                                                        <fieldset class="rate">
                                                                            <input type="radio" id="rating10" name="rating" value="5" /><label for="rating10" title="5 stars"></label>
                                                                            <input type="radio" id="rating9" name="rating" value="4.5" /><label class="half" for="rating9" title="4.5 stars"></label>
                                                                            <input type="radio" id="rating8" name="rating" value="4" /><label for="rating8" title="4 stars"></label>
                                                                            <input type="radio" id="rating7" name="rating" value="3.5" /><label class="half" for="rating7" title="3.5 stars"></label>
                                                                            <input type="radio" id="rating6" name="rating" value="3" /><label for="rating6" title="3 stars"></label>
                                                                            <input type="radio" id="rating5" name="rating" value="2.5" /><label class="half" for="rating5" title="2.5 stars"></label>
                                                                            <input type="radio" id="rating4" name="rating" value="2" /><label for="rating4" title="2 stars"></label>
                                                                            <input type="radio" id="rating3" name="rating" value="1.5" /><label class="half" for="rating3" title="1.5 stars"></label>
                                                                            <input type="radio" id="rating2" name="rating" value="1" /><label for="rating2" title="1 star"></label>
                                                                            <input type="radio" id="rating1" name="rating" value="0.5" /><label class="half" for="rating1" title="0.5 star"></label>

                                                                        </fieldset>
                                                                    </div>
                                                                    <span class="text-danger" style="margin-left: 20px;" id="error_rating"></span>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="tutor-btn-end mr-0">
                                                                        <div class="banner-readmore">
                                                                            <a class="button-default inline" onclick="submitreview('{{$data->id}}')" href="javascript:void(0)">submit</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>

                                                    </form>


                                                </div>
                                            </div>
                                            <div class="comments">
                                                <h4 class="title">Comments</h4>
                                                <div class="single-comment" id="reviewcomment">

                                                </div>

                                            </div>
                                        </div>



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
</div>
</div>

</div>
</section>

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
                                            <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                        </div>
                                        <div class="max-textquote">
                                            <p class="mb-0 we-likep">
                                                We would like to pass on our feedback and show appreciation for Mr
                                                Hamalabi from Science Clinic Private Tutoring Ltd who worked with
                                                our daughter and improved her Chemistry & Physics skills in the run
                                                up to her GCSE exams He was only with us for a short
                                                time but the work he did in that short period of time was
                                                unbelievable. Kayleigh got A* in both subjects.

                                            </p>
                                            <p class="float-right writer-text">
                                                - B.K. Thomas
                                            </p>
                                        </div>
                                        <div class="quotes-testi testi2">
                                            <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
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
                                            <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                        </div>
                                        <div class="max-textquote">
                                            <p class="mb-0 we-likep">
                                                Thank you Science Clinic Private Tutoring Ltd for your prompt and
                                                efficient service. It was so simple, I wish we had found you sooner.

                                            </p>
                                            <p class="float-right writer-text">
                                                - C.H. (Colchester)
                                            </p>
                                        </div>
                                        <div class="quotes-testi testi2">
                                            <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
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
                                            <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                        </div>
                                        <div class="max-textquote">
                                            <p class="mb-0 we-likep">
                                                Can't believe how quickly this has worked. I went on the Internet on
                                                15th January and Chloe had a lesson today with Mr Hamalabi who is
                                                only 5 minutes drive away from us. We are so pleased and delighted.

                                            </p>
                                            <p class="float-right writer-text">
                                                - J.J. Brown
                                            </p>
                                        </div>
                                        <div class="quotes-testi testi2">
                                            <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
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
                                            <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                        </div>
                                        <div class="max-textquote">
                                            <p class="mb-0 we-likep">
                                                I would like you to know how delighted we have been with Mr Hamalabi
                                                who has provided home tuitions in Physics, Mathematics & Chemistry
                                                to my daughter for 3 years. She went from C grade at the end of year
                                                9 to getting A*, A & A respectively in her GCSE.

                                            </p>
                                            <p class="float-right writer-text">
                                                - J.C. Paula
                                            </p>
                                        </div>
                                        <div class="quotes-testi testi2">
                                            <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
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
                                            <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                        </div>
                                        <div class="max-textquote">
                                            <p class="mb-0 we-likep">
                                                We are grateful to Mr Hamalabi from Science Clinic Private Tutoring
                                                Ltd for giving Tom confidence and for assisting him greatly in
                                                improving his performance to the level of getting A & A* in Biology,
                                                Chemistry & Physics.

                                            </p>
                                            <p class="float-right writer-text">
                                                - C.K. Tommy
                                            </p>
                                        </div>
                                        <div class="quotes-testi testi2">
                                            <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
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


<div class="ec-colorswitcher ">
    <a class="ec-handle " href="# "><i class="zmdi zmdi-settings "></i></a>
    <h3>Style Switcher</h3>
    <div class="ec-switcherarea ">
        <h6>Select Layout</h6>
        <div class="layout-btn ">
            <a href="# " class="ec-boxed "><span>Boxed</span></a>
            <a href="# " class="ec-wide "><span>Wide</span></a>
        </div>
        <h6>Chose Color</h6>
        <ul class="ec-switcher ">
            <li>
                <a href="# " class="cs-color-1 styleswitch " data-rel="color-one "></a>
            </li>
            <li>
                <a href="# " class="cs-color-2 styleswitch " data-rel="color-two "></a>
            </li>
            <li>
                <a href="# " class="cs-color-3 styleswitch " data-rel="color-three "></a>
            </li>
            <li>
                <a href="# " class="cs-color-4 styleswitch " data-rel="color-four "></a>
            </li>
            <li>
                <a href="# " class="cs-color-5 styleswitch " data-rel="color-five "></a>
            </li>
            <li>
                <a href="# " class="cs-color-6 styleswitch " data-rel="color-six "></a>
            </li>
            <li>
                <a href="# " class="cs-color-7 styleswitch " data-rel="color-seven "></a>
            </li>
            <li>
                <a href="# " class="cs-color-8 styleswitch " data-rel="color-eight "></a>
            </li>
            <li>
                <a href="# " class="cs-color-9 styleswitch " data-rel="color-nine "></a>
            </li>
            <li>
                <a href="# " class="cs-color-10 styleswitch " data-rel="color-ten "></a>
            </li>
        </ul>
        <div class="ec-pattren ">
            <h6>Chose Pattren</h6>
            <div class="pattren-wrap ">
                <a href="# " data-rel="pattren1 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren1.jpg')}} " alt=" "></a>
                <a href="# " data-rel="pattren2 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren2.jpg')}} " alt=" "></a>
                <a href="# " data-rel="pattren3 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren3.jpg')}} " alt=" "></a>
                <a href="# " data-rel="pattren4 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren4.jpg ')}}" alt=" "></a>
                <a href="# " data-rel="pattren5 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren5.jpg')}} " alt=" "></a>
            </div>
        </div>
        <div class="ec-background ">
            <h6>Chose Background</h6>
            <div class="background-wrap ">
                <a href="# " data-rel="background1 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-1.jpg ')}}" alt=" "></a>
                <a href="# " data-rel="background2 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-2.jpg')}} " alt=" "></a>
                <a href="# " data-rel="background3 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-3.jpg')}} " alt=" "></a>
                <a href="# " data-rel="background4 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-4.jpg')}} " alt=" "></a>
                <a href="# " data-rel="background5 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-5.jpg ')}}" alt=" "></a>
            </div>
        </div>
    </div>
</div>
@endsection


@section('page-js')
<script src="{{asset('front/js/bootstrap-select.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
<script>
    function submitreview(id) {
        var description = $('#description').val();
        var subject = $('#subject').val();
        var outcome = $('#outcome').val();
        var temp = 0;
        var rating = $("input[name='rating']:checked").val();
        $('#error_description').html('');
        $('#error_subject').html('');
        $('#error_outcome').html('');
        $('#error_rating').html('');


        if (description.trim() == '') {
            $('#error_description').html('Description is required');
            temp++;
        }
        if (subject.trim() == '') {
            $('#error_subject').html('Subject is required');
            temp++;
        }
        if (outcome.trim() == '') {
            $('#error_outcome').html('Outcome is required');
            temp++;
        }
        if ($('input[name="rating"]:checked').length == 0) {
            $('#error_rating').html('Rating is required');
            temp++;
        }

        if (temp == 0) {
            $.ajax({
                url: "{{ route('submit.review')}}",
                data: {
                    'id': id,
                    'description': description,
                    'subject': subject,
                    'outcome': outcome,
                    'rating': rating
                },
                success: function(res) {
                    console.log(res.data);
                    var review = '<div class=single-comment><div class=comment-text><div class=author-info><h4><a href=#>MD Tokdir Ali</a></h4><span class=reply><div class=review-score><div class="stars stars2"aria-label="Rating of this product is 2.3 out of 5."style=--rating:' + res.data.rating + '></div></div></span></div><p>' + res.data.descriptions + '<div class=author-subject><div class=subject-divs><p class=subject-details>Subject :<p class=subject-name>' + res.data.subject + '</div><div class=subject-divs><p class=subject-details>Outcome :<p class=subject-name>' + res.data.outcome + '</div></div></div></div>';
                    $('#reviewcomment').html("");
                    $('#reviewcomment').html(review);
                }
            })

        } else {
            return false;
        }

    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            contentHeight: "auto",
            allDaySlot: false,
            editable: true,
            // timeZone: 'UTC',
            initialView: 'timeGridWeek',
            slotDuration: '01:00',
            displayEventTime: false,
            events: [
                // {
                //     title: 'Availability',
                //     start: '2022-03-27T03:00:00',
                //     classNames: 'event-availability-label',
                // },
                {
                    title: 'Booked',
                    start: '2022-03-27T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-28T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-29T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-30T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-30T02:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-03-29T01:00:00',
                    classNames: 'event-no-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-03-29T02:00:00',
                    classNames: 'event-no-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-03-31T03:00:00',
                    classNames: 'event-no-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-04-01T03:00:00',
                    classNames: 'event-no-book-label',
                }

            ],
            editable: false,
            selectable: false
        });

        calendar.render();
    });
    //-----------------------

    $('.testimonial-english').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: ["<img src='{{asset('front/img/svg/left-arrow-test.png')}}'>", "<img src='{{asset('front//img/svg/right-arrow-test.png')}}'>"],
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
    $(function() {
        $("#datepicker").datepicker();
    });
</script>


@endsection