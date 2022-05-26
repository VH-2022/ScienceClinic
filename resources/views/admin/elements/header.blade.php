<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">

    <!--begin::Logo-->

    <a href="{{ url('admin')}}">

        <img alt="Logo" src="{{asset('front/img/logo2.png')}}">

    </a>

    <!--end::Logo-->

    <!--begin::Toolbar-->

    <div class="d-flex align-items-center">

        <!--begin::Aside Mobile Toggle-->

        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">

            <span></span>

        </button>

        <!--end::Aside Mobile Toggle-->



        <!--begin::Topbar Mobile Toggle-->

        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">

            <span class="svg-icon svg-icon-xl">

                <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                        <polygon points="0 0 24 0 24 24 0 24"></polygon>

                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>

                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>

                    </g>

                </svg>

                <!--end::Svg Icon-->

            </span>

        </button>

        <!--end::Topbar Mobile Toggle-->

    </div>

    <!--end::Toolbar-->

</div>

<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">

    <!--begin::Header-->

    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5" kt-hidden-height="40" style="">

        <h3 class="font-weight-bold m-0">User Profile</h3>

        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">

            <i class="ki ki-close icon-xs text-muted"></i>

        </a>

    </div>

    <!--end::Header-->

    <!--begin::Content-->

    <div class="offcanvas-content pr-5 mr-n5 scroll ps ps--active-y" style="height: 264px; overflow: hidden;">

        <!--begin::Header-->

        <div class="d-flex align-items-center mt-5">

            <div class="symbol symbol-100 mr-5">

                @if(Auth::guard('super_admin')->user()->profile_photo)

                <div class="symbol-label" id="sidebar_image_header" style="background-image:url({{Auth::guard('super_admin')->user()->profile_photo}})"></div>

                @else

                <div class="symbol-label" style="background-image:url({{(asset('uploads/avatar.jpg'))}})"></div>

                @endif

                <i class="symbol-badge bg-success"></i>

            </div>

            <div class="d-flex flex-column">

                <a href="{{route('profile')}}" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary" id="sidebar_auth_name">{{Auth::guard('super_admin')->user()->first_name}} {{Auth::guard('super_admin')->user()->last_name}}</a>

                <div class="navi">

                    <a href="#" class="navi-item">

                        <span class="navi-link p-0 pb-2">

                            <span class="navi-icon mr-1">

                                <span class="svg-icon svg-icon-lg svg-icon-primary">

                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->

                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                            <rect x="0" y="0" width="24" height="24"></rect>

                                            <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>

                                            <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>

                                        </g>

                                    </svg>

                                    <!--end::Svg Icon-->

                                </span>

                            </span>

                            <span class="navi-text text-muted text-hover-primary" id="auth_email_sidebar">{{Auth::guard('super_admin')->user()->email}}</span>

                        </span>

                    </a>

                    <a href="{{route('super-admin-logout')}}" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>

                </div>

            </div>

        </div>

        <!--end::Header-->

        <div class="separator separator-dashed my-7"></div>

        <!--end::Separator-->

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">

            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>

        </div>

        <div class="ps__rail-y" style="top: 0px; height: 264px; right: 0px;">

            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 78px;"></div>

        </div>

    </div>

    <!--end::Content-->

</div>

<!--begin::Header-->

<div id="kt_header" class="header header-fixed">

    <!--begin::Container-->

    <div class="container-fluid d-flex align-items-stretch justify-content-between">

        <!--begin::Header Menu Wrapper-->

        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

        </div>

        <!--end::Header Menu Wrapper-->

        <!--begin::Topbar-->

        <div class="topbar">

            <!--begin::Notifications-->

            <div class="dropdown">

                <!--begin::Toggle-->

                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">

                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">

                        <span class="svg-icon svg-icon-xl svg-icon-primary">

                            <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                    <rect x="0" y="0" width="24" height="24"></rect>

                                    <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"></path>

                                    <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"></path>

                                </g>

                            </svg>

                            <!--end::Svg Icon-->

                        </span>

                        <span class="pulse-ring"></span>

                    </div>

                </div>

                <!--end::Toggle-->

                <!--begin::Dropdown-->

                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">

                    <form>

                        <!--begin::Header-->

                        <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(assets/media/misc/bg-1.jpg)">

                            <!--begin::Title-->

                            <h4 class="d-flex flex-center rounded-top">

                                <span class="text-white">User Notifications</span>

                                <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">23 new</span>

                            </h4>

                            <!--end::Title-->

                            <!--begin::Tabs-->

                            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">

                                <li class="nav-item">

                                    <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">Alerts</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events">Events</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs">Logs</a>

                                </li>

                            </ul>

                            <!--end::Tabs-->

                        </div>

                        <!--end::Header-->

                        <!--begin::Content-->

                        <div class="tab-content">

                            <!--begin::Tabpane-->

                            <div class="tab-pane active show p-8" id="topbar_notifications_notifications" role="tabpanel">

                                <!--begin::Scroll-->

                                <div class="scroll pr-7 mr-n7 ps" data-scroll="true" data-height="300" data-mobile-height="200" style="height: 300px; overflow: hidden;">

                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">

                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>

                                    </div>

                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">

                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>

                                    </div>

                                </div>

                                <!--end::Scroll-->

                                <!--begin::Action-->

                                <div class="d-flex flex-center pt-7">

                                    <a href="#" class="btn btn-light-primary font-weight-bold text-center">See All</a>

                                </div>

                                <!--end::Action-->

                            </div>

                            <!--end::Tabpane-->

                            <!--begin::Tabpane-->

                            <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">

                                <!--begin::Nav-->

                                <div class="navi navi-hover scroll my-4 ps" data-scroll="true" data-height="300" data-mobile-height="200" style="height: 300px; overflow: hidden;">

                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">

                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>

                                    </div>

                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">

                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>

                                    </div>

                                </div>

                                <!--end::Nav-->

                            </div>

                            <!--end::Tabpane-->

                            <!--begin::Tabpane-->

                            <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">

                                <!--begin::Nav-->

                                <div class="d-flex flex-center text-center text-muted min-h-200px">All caught up!

                                    <br>No new notifications.

                                </div>

                                <!--end::Nav-->

                            </div>

                            <!--end::Tabpane-->

                        </div>

                        <!--end::Content-->

                    </form>

                </div>

                <!--end::Dropdown-->

            </div>

            <!--end::Notifications-->

            <!--begin::User-->

            <div class="topbar-item">

                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">

                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>

                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3" id="header_auth_name">{{Auth::guard('super_admin')->user()->first_name}} {{Auth::guard('super_admin')->user()->last_name}}</span>

                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">

                        <span class="symbol-label font-size-h5 font-weight-bold" id="fchar_id">{{substr(Auth::guard('super_admin')->user()->first_name, 0, 1)}}</span>

                    </span>

                </div>

            </div>

            <!--end::User-->

        </div>

        <!--end::Topbar-->

    </div>

    <!--end::Container-->

</div>

<!--end::Header-->