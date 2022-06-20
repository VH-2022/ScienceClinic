@extends('layouts.master')

@section('content')

<style>

    .remove-btn1 {

        margin-top: 26.5px;

    }

    .error {

        color: red;

    }
    .upload-photo-main{
        left: 42px;
    }

</style>

<div class="d-flex flex-column-fluid">

    <!--begin::Container-->

        <div class="container-fluid">

        

            <div class="d-flex flex-row">

            

                <div class="flex-row-fluid" >

                    <div class="card card-custom card-stretch">

                    

                        <div class="card-header py-3">

                            <div class="card-title align-items-start flex-column">

                                <h3 class="card-label font-weight-bolder text-dark">Edit E-Learning</h3>

                            </div>

                        </div>

                    

                        <form class="form" id="submitid" method="post" action="{{url('e-learning-cms')}}/{{$basic_details->id}}" enctype="multipart/form-data">

                            @csrf

                            @method('put')

                            <input type="hidden" name="id" value="{{ $basic_details->id}}">

                            <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label>Title <span class="text-danger">*</span></label>

                                        <input class="form-control validate_field" placeholder="Title" autocomplete="off" id="title" value="{{ $basic_details->title}}" type="text" data-msg="Title" name="title">

                                        <span class="form-text error title_error">{{ $errors->useredit->first('title')}}</span>

                                    </div>

                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label>Description <span class="text-danger">*</span></label>

                                        <textarea type="text" data-msg="Description" class="form-control validate_field" placeholder="Description" name="description" id="description" data-msg="Description">{{ $basic_details->description}}</textarea>

                                        <span class="form-text error description_error">{{ $errors->useredit->first('description')}}</span>

                                    </div>

                                </div>

                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload <span class="text-danger">*</span></label>
                                        <div class="position-relative">
                                            <input type="file" class="input-upload-cus" name="upload_data" id="text_book_upload" class="form-control validate_field" data-msg="Upload">
                                            <div class="upload-photo-main">
                                                <i class="fa fa-plus plus-sign-upload"></i> <span style="white-space: nowrap;">Upload Photo/PPT/PDF/DOC</span>
                                            </div>
                                        </div>
                                        <span id="uploadtitle"><a target="_blank" href="{{$basic_details->upload_data}}">View</a></span>
                                        <span class="form-text error text_book_upload_error"></span>
                                    </div>
                                </div>

                                </div>


                            <div class="card-footer">

                                <button type="button" id="edit_subject" class="btn btn-primary mr-2" style="background-color:#3498db !important">Submit</button>

                                <button type="reset" class="btn btn-secondary" onclick='window.location.href="{{ url('e-learning-cms')}}"'>Cancel</button>

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

<script src="{{asset('assets/Modulejs/elearning.js')}}"></script>



<script>
$('#text_book_upload').change(function() {
    var name = $('#text_book_upload').val().split('\\').pop();
  	$('#uploadtitle').html(name);
});
    var _Add_SUBJECT = "{{route('e-learning-cms.store')}}";

</script>

<script>
    CKEDITOR.replace( 'description' );
</script>



@endsection

