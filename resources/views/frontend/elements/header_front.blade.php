<!-- <link rel="stylesheet" href="responsive.css"> -->





<header>



    <div class="header-logo-menu sticker fixed">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-md-12 header-mobile">

                    <div class="header-mob">

                        <a href="tel:07572505997" class="header-number">

                            <div class="header-mob1"><i class="zmdi zmdi-phone mob-color "></i></div> 07572505997

                        </a>

                        <a href="tel:01245352101" class="header-number">01245352101</a>

                    </div>

                </div>

                <div class="col-lg-2 col-md-6 col-6">

                    <div class="logo">

                        <a href="{{ url('/')}}"><img src="{{asset('front/img/logo2.png')}}" alt="EDUCAT"></a>

                    </div>

                </div>

                <div class="col-lg-10 col-md-6 col-6">

                    <div class="overlay-section mobile-show" id="overlays"> </div>

                    <div class="mainmenu-area mobile-show pull-right">

                        <div class="mainmenu d-none d-lg-block">

                            <nav>



                                <ul id="nav" class="menu-white border-full border-bottom-ul">

                                    <li class="text-none" id="tutor-sub"><a href="javascript:void(0)">Online Tutoring</a>

                                        <ul class="sub-menu mobile-section border-bottom-ul">
                                            @if(count($online_tutorigData) > 0)
                                            @foreach($online_tutorigData as $ckey)
                                            <li><a target="_blank" href="{{$ckey->online_tutoring_link}}">{{$ckey->online_tutoring_name}}</a>
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>

                                    </li>

                                    <li class="{{ Request::segment(1) == 'find-tutor' ? 'menu-item-active-front active' : '' }}"><a href="{{ route('find-tutor') }}">Find a Tutor</a></li>

                                    <li class="{{ Request::segment(1) == 'become-tutor' ? 'menu-item-active-front active' : '' }}"><a href="{{route('become-tutor.index')}}">Become a Tutor</a></li>

                                    <li class="text-none @if(Request::segment(1) =='subject' || Request::segment(1) =='sub-subject') menu-item-active-front active @endif" id="subject-sub"><a href="javascript:void(0)">Subjects</a>

                                        <ul class="sub-menu mobile-section border-bottom-ul">

                                            @foreach($response_menu as $val)

                                            @if(count($val->subcategory) >0)

                                            <li><a href="javascript:void(0)">{{ $val->main_title}}<i class="zmdi zmdi-chevron-right"></i></a>

                                                <ul class="inside-menu inside-menus-sec">

                                                    @foreach($val->subcategory as $sub)



                                                    <li><a href="{{ $sub->sub_caregory_url}}">{{$sub->main_title}}</a></li>

                                                    @endforeach





                                                </ul>



                                            </li>

                                            @else

                                            <li><a href="{{ $val->caregory_url}}">{{$val->main_title}}</a>

                                                @endif



                                                @endforeach



                                        </ul>



                                        <i class="fa fa-angle-down mmbtns" aria-hidden="true"></i>

                                    </li>

                                    <li class="text-none @if(Request::segment(1) =='E-Learning' || Request::segment(1) =='past-papers-resources' || Request::segment(1) =='textbook-parent-login') menu-item-active-front active @endif" id="tutor-sub"><a href="javascript:void(0)">Past

                                            Papers & Resources</a>

                                        <ul class="sub-menu mobile-section border-bottom-ul">

                                            <li><a href="{{route('E-Learning')}}">E-Learning</a></li>

                                            <li><a href="{{route('past-papers-resources')}}">Past Paper</a></li>

                                            <li><a href="{{route('textbook-parent-login')}}">Text Books</a></li>

                                            <li>

                                                <a href="javascript:void(0)">Educake<i class="zmdi zmdi-chevron-right"></i></a>

                                                <ul class="inside-menu inside-menus-sec">

                                                    <li><a href="https://my.educake.co.uk/teacher-login">Teacher Login</a></li>

                                                    <li><a href="https://my.educake.co.uk/student-login">Student Login</a>

                                                    </li>



                                                </ul>

                                            </li>

                                            <li><a href="https://www.kerboodle.com/users/login">Kerboodle</a></li>

                                            <li><a href="https://login.mymaths.co.uk/login">My Maths</a></li>

                                            <li><a href="https://login.mathletics.com/">Mathletics</a></li>

                                            <li><a href="https://www.pearsonactivelearn.com/app/Home">Active Learn</a></li>

                                            <li><a href="https://scienceclinic.ediface.org/">Learning Zone</a></li>



                                            <li><a href="https://app.doublestruck.eu/?br=EP">Exampro</a></li>

                                        </ul>

                                        <i class="fa fa-angle-down mmbtns" aria-hidden="true"></i>

                                    </li>

                                    <li class="text-none @if(Request::segment(1) =='tutors') menu-item-active-front active @endif" id="tutor-sub"><a href="javascript:void(0)">Our

                                            Tutors</a>

                                        <ul class="sub-menu mobile-section border-bottom-ul">

                                            <li><a href="{{route('tutors')}}">Tutors</a></li>



                                        </ul>



                                        <i class="fa fa-angle-down mmbtns" aria-hidden="true"></i>

                                    </li>

                       
                                    
                                    <li class="{{ Request::segment(1) == 'about' ? 'menu-item-active-front active' : '' }}"><a href="{{ route('about')}}">About</a></li>
                                    <li class="text-none @if(Request::segment(1) =='contact' || Request::segment(1) == 'blog') menu-item-active-front active @endif" id="tutor-sub"><a href="{{route('contact.index')}}">Contact</a>
                                        <ul class="sub-menu mobile-section border-bottom-ul">
                                            <li><a href="{{route('blog')}}">Blog</a></li>
                                            </ul>
                                    </li>



                                    <li class="text-none @if(Request::segment(1) =='tutor-login' || Request::segment(1) =='parent-login') menu-item-active-front active @endif" id="tutor-sub"><a href="javascript:void(0)">Login</a>

                                        <ul class="sub-menu mobile-section border-bottom-ul">

                                            <li><a href="{{route('tutor-login')}}">Tutor Login</a></li>

                                            <li><a href="{{route('parent-login')}}"> Parent Login </a></li>

                                        </ul>

                                        <i class="fa fa-angle-down mmbtns" aria-hidden="true"></i>

                                    </li>



                                </ul>

                            </nav>

                        </div>

                        <!-- <ul class="header-search desktop-search">

                                <li class="search-menu">

                                    <i id="toggle-search" class="zmdi zmdi-search-for"></i>

                                </li>

                            </ul> -->

                    </div>

                    <div class="mobile-menus">

                        <div class="menu-collapse">

                            <button class="btn btn-collapse" id="menu"> <img src="{{asset('front/img/svg/menu.png')}}" alt="menu" class="menu-img"></button>

                        </div>

                    </div>

                    <div class="mobile-search-baar">

                        <!-- <ul class="header-search mobile-search tablet-search">

                                <li class="search-menu">

                                    <i id="toggle-search" class="zmdi zmdi-search-for"></i>

                                </li>

                            </ul> -->

                        <!--Search Form-->

                        <div class="search">

                            <div class="search-form">

                                <form id="search-form" action="#">

                                    <input type="search" placeholder="Search here..." name="search" />

                                    <button type="submit">

                                        <span><i class="fa fa-search"></i></span>

                                    </button>

                                </form>

                            </div>

                        </div>

                        <!--End of Search Form-->

                    </div>



                </div>

            </div>

        </div>

    </div>

    <!-- Mobile Menu Area start -->



    <!-- Mobile Menu Area end -->

</header>