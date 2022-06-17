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

                                <h3 class="card-label font-weight-bolder text-dark">Edit Text Books</h3>

                            </div>

                        </div>

                    

                        <form class="form" id="submitid" method="post" action="{{url('text-books')}}/{{$basic_details->id}}" enctype="multipart/form-data">

                            @csrf

                            @method('put')

                            <input type="hidden" name="id" value="{{ $basic_details->id}}">

                            <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label>Title <span class="text-danger">*</span></label>

                                        <input class="form-control validate_field" placeholder="Title" autocomplete="off" id="text_book_title" value="{{ $basic_details->text_book_title}}" type="text" data-msg="Title" name="text_book_title">

                                        <span class="form-text error text_book_title_error">{{ $errors->useredit->first('text_book_title')}}</span>

                                    </div>

                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label>Subject <span class="text-danger">*</span></label>
                                        <select name="subject_id" id="subject_id" class="form-control validate_field" data-msg="Subject" >
                                             <option value="">Select Subject</option>
                                             @if(count($subject_list) > 0)
                                                @foreach($subject_list as $ckey)
                                                    <option value="{{$ckey->id}}" @php if($basic_details->subject_id !='') { if($basic_details->subject_id == $ckey->id){ echo 'selected'; } } @endphp>{{$ckey->main_title}}</option>
                                                @endforeach
                                             @endif
                                        </select>
                                        

                                        <span class="form-text error subject_id_error">{{ $errors->useredit->first('subject_id')}}</span>

                                    </div>

                                </div>

                                

                            </div>
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label>Description <span class="text-danger">*</span></label>

                                        <textarea type="text" data-msg="Description" class="form-control validate_field" placeholder="Description" name="text_book_description" id="text_book_description" data-msg="Description">{{ $basic_details->text_book_description}}</textarea>

                                        <span class="form-text error text_book_description_error">{{ $errors->useredit->first('text_book_description')}}</span>

                                    </div>

                                </div>

                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload <span class="text-danger">*</span></label>
                                        <div class="position-relative">
                                            <input type="file" class="input-upload-cus" name="text_book_upload" id="text_book_upload" class="form-control validate_field" data-msg="Upload">
                                            <div class="upload-photo-main">
                                                <i class="fa fa-plus plus-sign-upload"></i> <span style="white-space: nowrap;">Upload Photo/PPT/PDF/DOC</span>
                                            </div>
                                        </div>
                                        <span id="uploadtitle"><a target="_blank" href="{{$basic_details->text_book_upload}}">View</a></span>
                                        <span class="form-text error text_book_upload_error"></span>
                                    </div>
                                </div>

                                </div>


                            <div class="card-footer">

                                <button type="button" id="edit_subject" class="btn btn-primary mr-2" style="background-color:#3498db !important">Submit</button>

                                <button type="reset" class="btn btn-secondary" onclick='window.location.href="{{ url('text-books')}}"'>Cancel</button>

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

<script src="{{asset('assets/Modulejs/textbooks.js')}}"></script>



<script>
$('#text_book_upload').change(function() {
    var name = $('#text_book_upload').val().split('\\').pop();
  	$('#uploadtitle').html(name);
});
    var _Add_SUBJECT = "{{route('text-books.store')}}";

</script>

<script>
    CKEDITOR.replace( 'text_book_description' );
</script>



@endsection

