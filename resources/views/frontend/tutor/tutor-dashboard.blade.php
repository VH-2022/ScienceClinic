@extends('layouts.master')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Subheader-->

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">

        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

            <!--begin::Info-->

            <div class="d-flex align-items-center flex-wrap mr-2">

                <!--begin::Page Title-->

                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>

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
                                <div class="col-md-2">
                                    <img src="" alt="">
                                </div>
                                <div class="col-md-8">
                                    <div class="apply-main">
                                        <h3>Apply for an Enhanced DBS</h3>
                                        <div class="apply-details">
                                            <div class="apply-details-inner">
                                                <i class="fa fa-check mr-2"></i>
                                                <div>
                                                    We can process your DBS application and verify your documents.
                                                </div>
                                            </div>
                                            <div class="apply-details-inner">
                                                <i class="fa fa-check mr-2"></i>
                                                <div>
                                                    You must have an Enhanced DBS verified to complete our verification process.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2 d-flex align-items-center">
                                    <button class="btn start-dbs btn-primary">
                                        Start DBS Application
                                    </button>
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