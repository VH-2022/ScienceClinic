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
                                    onclick="changeStatus('Accepted',{{ $blog->id }})"
                                    @if ($blog->status == 'Accepted') style="display:none" @endif>Accept</a>
                                <a href="javascript:void(0);" class="btn btn-danger mr-2 rejected_id"
                                    onclick="changeStatus('Rejected',{{ $blog->id }})"
                                    @if ($blog->status == 'Rejected') style="display:none" @endif>Reject</a>
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
                                        <strong>Image: </strong> {{ $blog->email }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="d-flex mb-4">
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
    </div>
@endsection
@section('page-js')
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