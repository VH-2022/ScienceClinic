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
                                    <span class="card-icon">
                                        <i class="flaticon2-chat-1 text-primary"></i>
                                    </span>
                                    <h3 class="card-label">Tutor Name
                                        <small>sub title</small>
                                    </h3>
                                </div>
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-sm btn-success font-weight-bold">
                                        <i class="flaticon2-cube"></i>Accsept</a>
                                        <a href="#" class="btn btn-sm btn-success font-weight-bold">
                                            <i class="flaticon2-cube"></i>Reject</a>
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
