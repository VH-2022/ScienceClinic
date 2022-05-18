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
                                    <span class="nav-profile-name">{{ Auth::user()->first_name }}</span>
                                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                                        <div class="symbol mr-3">
                                            @if(auth()->user()->profile_photo_path)
                                            <img src="{{ asset(auth()->user()->profile_photo_path) }}" alt=""
                                                class="rounded-circle">
                                            @else
                                            <img src="{{ asset('uploads/user.jpg') }}" alt=""
                                                class="rounded-circle">
                                            @endif
                                        </div>
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
                                            <strong>Full Name:-</strong>
                                            <div> {{ $totuer->first_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-3">
                                            <strong>Email:-</strong>
                                            {{ $totuer->email }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-3">
                                            <strong>Mobile No:-</strong>
                                            {{ $totuer->mobile_id }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-4">
                                            <strong>Address1:-</strong>
                                            {{ $totuer->address1 }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-3">
                                            <strong>Address2:-</strong>
                                            {{ $totuer->address2 }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-flex mb-3">
                                            <strong>Address3:-</strong>
                                            {{ $totuer->address3 }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <strong>City:-</strong>
                                        {{ $totuer->city }}
                                    </div>
                                    <div class="col-lg-4">
                                        <strong>Post Code:-</strong>
                                        {{ $totuer->postcode }}
                                    </div>
                                    <div class="col-lg-4">
                                        <strong>Bio:-</strong>
                                        {{ $totuer->postcode }}
                                    </div>
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
@endsection
