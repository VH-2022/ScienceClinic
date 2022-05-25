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

                                    <span class="nav-profile-name">Tutor Detail</span>

                                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>

                                </div>

                                <div class="card-toolbar">

                                    



                                    <a href="javascript:void(0);" class="btn btn-success mr-2 accepted_id"

                                        onclick="changeStatus('Accepted',{{$tutor->id}})"  @if($tutor->status=="Accepted") style="display:none" @endif>Accept</a>

                                    <a href="javascript:void(0);" class="btn btn-danger mr-2 rejected_id"

                                         onclick="changeStatus('Rejected',{{$tutor->id}})" @if($tutor->status=="Rejected") style="display:none" @endif>Reject</a>

                                </div>

                            </div>

                            <div class="card-body">

                                <div class="form-group row">

                                    <div class="col-lg-4">

                                        <div class="d-flex mb-4">

                                            <strong>Full Name: </strong>

                                            {{ $tutor->first_name }}

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="d-flex mb-4">

                                            <strong>Email: </strong> {{ $tutor->email }}

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="d-flex mb-4">

                                            <strong>Mobile No: </strong>

                                            {{ $tutor->mobile_id }}

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="d-flex mb-4">

                                            <strong>Address1: </strong>

                                            {{ $tutor->address1 }}

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="d-flex mb-4">

                                            <strong>Address2: </strong>

                                            {{ $tutor->address2 }}

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="d-flex mb-4">

                                            <strong>Address3: </strong>

                                            {{ $tutor->address3 }}

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <strong>City: </strong>

                                        {{ $tutor->city }}

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="d-flex mb-4">

                                            <strong>Post Code: </strong>  {{ $tutor->postcode }}

                                           

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <strong>Status: </strong> <span id="status_id">@if($tutor->status =='Pending') <span class="badge badge-primary">Pending</span> @elseif($tutor->status =='Accepted') <span class="badge badge-success">Accepted</span> @else <span class="badge badge-danger">Rejected</span> @endif</span>

                                        

                                    </div>

                                    <div class="col-lg-12">

                                        <strong>Bio:</strong>

                                        {{ $tutor->bio }}

                                    </div>

                                    

                                </div>

                            </div>

                        </div>

                   

                        <!--begin::Header-->

                        <div class="card card-custom">

                            <div class="card-header">

                                <div class="card-title tutor">

                                    <ul class="nav nav-pills nav-fill">

                                        <li class="nav-item">

                                            <a class="nav-link active" onclick="getUniversityDetails(1)" href="#university"

                                                data-toggle="tab">

                                                <span class="nav-text">University</span>

                                            </a>

                                        </li>

                                        <!-- <li class="nav-item">

                                            <a class="nav-link" href="#subject" onclick="getSubjectDetails(1)"

                                                data-toggle="tab" aria-controls="Subject">

                                                <span class="nav-text">Subject Tutor</span>

                                            </a>

                                        </li> -->

                                        <li class="nav-item">

                                            <a class="nav-link" href="#level" data-toggle="tab"

                                                onclick="getLevelDetails(1)" aria-controls="Level">

                                                <span class="nav-text">Level Tutor</span>

                                            </a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link" href="#other" data-toggle="tab" aria-controls="Other">

                                                <span class="nav-text">Other</span>

                                            </a>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                            <div class="tab-content" id="tabs">

                                <div class="tab-pane active" id="university">

                                    <span id="responsive_id"></span>

                                </div>



                                <div class="tab-pane" id="subject">

                                    <span id="responsive_Id"></span>

                                </div>



                                <div class="tab-pane" id="level">

                                    <span id="responsived_id"></span>

                                </div>



                                <div class="tab-pane" id="other">

                                </div>

                            </div>

                        </div>

                   

                   

                </div>

                <!--end::Subject List-->

            </div>

            <!--end::Container-->

        </div>

        <!--end::Card-->

    </div>

    <!--end::Container-->

    

@endsection

@section('page-js')

<script src="{{ asset('assets/js/pages/jquery-confirmation/js/jquery-confirm.min.js') }}"></script>

    <script>

        function getUniversityDetails(page) {

            $.ajax({

                type: "GET",

                url: "{{ route('tutor-university') }}",

                data: {

                    'tutor_id': '{{ $tutor->id }}',

                    'page': page,

                },

                success: function(res) {

                    $('#responsive_id').html("");

                    $('#responsive_id').html(res);

                }

            })

        }

        getUniversityDetails(1);



        function getSubjectDetails(page) {

            $.ajax({

                type: "GET",

                url: "{{ route('tutor-subject') }}",

                data: {

                    'tutor_id': '{{ $tutor->id }}',

                    'page': page,

                },

                success: function(res) {

                    $('#responsive_Id').html("");

                    $('#responsive_Id').html(res);

                }

            })

        }

        getSubjectDetails(1);



        function getLevelDetails(page) {

            $.ajax({

                type: "GET",

                url: "{{ route('tutor-level-list') }}",

                data: {

                    'tutor_id': '{{ $tutor->id }}',

                    'page': page,

                },

                success: function(res) {

                    $('#responsived_id').html("");

                    $('#responsived_id').html(res);

                }

            })

        }

        getLevelDetails(1);



        

    </script>

    <script>

        function changeStatus(status,id) {

            $.confirm({

                title: 'Are you sure?',

                columnClass:"col-md-6",



                content: "you want to change status?",

                buttons: {

                    formSubmit: {

                        text: 'Submit',

                        btnClass: 'btn-primary',

                        action: function () {

                                $.ajax({

                                    method: "GET",

                                    url:"{{ route('changestatus') }}",

                                    data:{

                                       

                                        

                                        'id':id,

                                        'status':status

                                    }



                                }).done(function (r) {



                                    toastr.success(r.error_msg);

                                    $('.rejected_id').attr('style','display:block');

                                    $('.accepted_id').attr('style','display:block');

                                    if( r.data.status =="Accepted"){

                                        var html_res = '<span class="badge badge-success">Accepted</span>';

                                        $('.accepted_id').attr('style','display:none');

                                    }else{

                                        var html_res = '<span class="badge badge-danger">Rejected</span>';

                                        $('.rejected_id').attr('style','display:none');

                                    }



                                    $('#status_id').html(html_res);

                                    

                                }).fail(function () {

                                    _self.setContent('Something went wrong. Contact Support.');

                                    toastr.error('Sorry, something went wrong. Please try again.');

                                });



                        }

                    },

                    cancel: function () {

                        //close

                    },

                },

                onContentReady: function () {

                    // bind to events



                }

            });

         

        }

        </script>

@endsection

