@extends('layouts.master')

@section('content')

<style>

    .remove-btn1 {

        margin-top: 26.5px;

    }



    .error {

        color: red;

    }

</style>

<div class="d-flex flex-column-fluid">

    <!--begin::Container-->

    <div class="container-fluid">



        <div class="d-flex flex-row">



            <div class="flex-row-fluid">

                <div class="card card-custom card-stretch">



                    <div class="card-header py-3">

                        <div class="card-title align-items-start flex-column">

                            <h3 class="card-label font-weight-bolder text-dark">Update Online Tutoring</h3>

                        </div>

                    </div>



                    <form class="form" id="submitid" method="post" action="{{url('online-tutoring')}}/{{$basic_details->id}}"  enctype="multipart/form-data">

                        @csrf
                        @method('put')
                        <div class="card-body">

                            

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label>Name <span class="text-danger">*</span></label>

                                        <input class="form-control validate_field" placeholder="Name" autocomplete="off" id="online_tutoring_name" type="text" data-msg="Name" name="online_tutoring_name" value="{{ $basic_details->online_tutoring_name}}">

                                        <span class="form-text error online_tutoring_name_error">{{ $errors->useredit->first('online_tutoring_name')}}</span>

                                    </div>

                                </div>

                                

                            </div>
                           
                        <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label>URL <span class="text-danger">*</span></label>

                                        <input class="form-control validate_field" placeholder="URL" autocomplete="off" id="online_tutoring_link" type="text" data-msg="URL" name="online_tutoring_link" value="{{ $basic_details->online_tutoring_link}}">

                                        <span class="form-text error online_tutoring_link_error">{{ $errors->useredit->first('online_tutoring_link')}}</span>

                                    </div>

                                </div>

                                

                            </div>
                           
                        
                        </div>

                        <div class="card-footer">

                            <button type="button" id="add_subject" class="btn btn-primary mr-2" style="background-color:#3498db !important">Submit</button>

                            <button type="reset" class="btn btn-secondary" onclick='window.location.href="{{ url('online-tutoring')}}"'>Cancel</button>

                        </div>

                        <!--end::Body-->



                    </form>

                </div>

            </div>

        </div>

        <!--end::Content-->

    </div>

    <!--end::Subject List-->

</div>

<!--end::Container-->


@endsection
@section('page-js')
<script src="{{asset('assets/Modulejs/online_tutoring.js')}}"></script>
<script>
    var _Add_SUBJECT = "{{route('online-tutoring.store')}}";
</script>

@endsection