@extends('layouts.master')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Subheader-->

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">

        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

            <!--begin::Info-->

            <div class="mr-2 w-100">
                <div class="row">
                    <div class="col-md-12">
                        <!--begin::Page Title-->
                        @php
                        date_default_timezone_set("Europe/London");
                        $h = date('G');
                        $val = '';
                        @endphp
                        @if($h>=5 && $h<=11) @php $val="Good morning" ; @endphp @elseif($h>=12 && $h<=15) @php $val="Good afternoon" ; @endphp @else @php $val="Good evening" ; @endphp @endif <div class="row">
                                <div class="col-md-6">
                                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-dark font-weight-bold mt-2 mb-2 mr-5 greeting-text">{{$val}} {{Auth::user()->first_name}}</h4>
                                </div>
                    </div>
                </div>
            </div>

            <!--end::Page Title-->

        </div>

        <!--end::Info-->

    </div>

</div>

<!--end::Subheader-->

<!--begin::Entry-->

<div class="d-flex flex-column-fluid">

    <!--begin::Container-->

    <div class="container-fluid">

        <!--begin::Dashboard-->
        <div class="d-flex flex-row">

            <!--begin::Content-->

            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom card-stretch">

                    <!--begin::Header-->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="apply-main">
                                    <h5>Thank you for choosing to work with us.</h5>
                                    <div class="apply-details">
                                        <div class="apply-details-inner">
                                            Please click the link below to select a tutor in other subjects.
                                        </div>
                                        <div>
                                            <a href="{{route('tutors')}}" class="btn btn-primary" target="_blank">Tutors</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!--end::Content-->

        </div>
        <!--end::Dashboard-->

    </div>

    <!--end::Container-->

</div>

<!--end::Entry-->

</div>

@endsection