@extends('layouts.master')
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Subject List-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid" id="personam_id">
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="nav-profile-name">Tutor Detail</span>
                                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>

                                    </h3>
                                </div>
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-primary mr-2"
                                        style="background-color:#34db5e !important">Accept</a>
                                    <a href="#" class="btn btn-primary mr-2"
                                        style="background-color:#db3434 !important">Reject</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-4">
                                            <strong>Full Name:</strong>
                                            {{ $totuer->first_name }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-4">
                                            <strong>Email:</strong>
                                            {{ $totuer->email }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-4">
                                            <strong>Mobile No:</strong>
                                            {{ $totuer->mobile_id }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-4">
                                            <strong>Address1:</strong>
                                            {{ $totuer->address1 }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-4">
                                            <strong>Address2:</strong>
                                            {{ $totuer->address2 }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-4">
                                            <strong>Address3:</strong>
                                            {{ $totuer->address3 }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <strong>City:</strong>
                                        {{ $totuer->city }}
                                    </div>
                                    <div class="col-lg-4">
                                        <strong>Post Code:</strong>
                                        {{ $totuer->postcode }}
                                    </div>
                                </div>
                                <div class="row">
                                    <strong>Bio:</strong>
                                    {{ $totuer->bio }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Subject List-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
    <div class="example mb-10"></div>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Subject List-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid" id="personam_id">
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <ul class="nav nav-pills nav-fill">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="university" data-toggle="tab" href="#">
                                                <span class="nav-text">University</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="subject" data-toggle="tab" href="#" aria-controls="Subject">
                                                <span class="nav-text">Subject Tutor</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="level" data-toggle="tab" href="#" aria-controls="Level">
                                                <span class="nav-text">Level Tutor</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="other" data-toggle="tab" href="#" aria-controls="Other">
                                                <span class="nav-text">Other</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
