@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-confirmation/css/jquery-confirm.min.css') }}">
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Subject List-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid" id="personam_id">

                    <!--begin::Header-->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="nav-profile-name">Blog Master Detail</span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <div class="d-flex mb-4">
                                        <strong>Title: </strong>
                                        {{ $blog->title }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="d-flex mb-4">
                                        <strong>Image: </strong>

                                        <img src="{{ $blog->image }}" style="width:60px;height:60px;">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <strong>Description: </strong>
                                    {!! $blog->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
