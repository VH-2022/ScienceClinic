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
                            <h3 class="card-label font-weight-bolder text-dark">Add Blog Master</h3>
                        </div>
                    </div>

                    <form class="form" id="submitid" method="post" action="{{ route('blog-master.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input placeholder="Title" class="form-control validate_field charCls txtOnly" autocomplete="off" id="title" type="text" data-msg="Title" value="{{ old('title')}}" name="title" maxlength=255>
                                        <span class="form-text error title_error" id="title_error">{{ $errors->first('title')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image <span class="text-danger">*</span></label>
                                        <div>
                                            <input type="file" name="image" data-msg="Image" id="image" accept=".png, .jpg, .jpeg">
                                            <span class="form-text error image_error" id="image_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea type="text" data-msg="Description" class="form-control validate_field" placeholder="Description" name="description" id="description" data-msg="Description">{{ old('description') }}</textarea>
                                        <span class="form-text error description_error" id="description_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="add_blog" class="btn btn-primary mr-2" style="background-color:#3498db !important">Submit</button>
                            <a class="btn btn-secondary" href="{{ url('blog-master') }}">Cancel</a>

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
<script>
    $(".charCls").keypress(function(event) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $(".txtOnly").keypress(function(e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });
    CKEDITOR.replace('description');
    $('#add_blog').click(function(e) {

        var title = $('#title').val();
        var image = $('#image').prop('files');

        var description = CKEDITOR.instances['description'].getData();

        var temp = 0;

        if (title.trim() == '') {
            $('#title_error').html("Title is required");
            temp++;
        } else {
            $('#title_error').html("");
        }

        if (image.length == 0) {
            $('#image_error').html("Image is required");
            temp++;
        }
        if (description.trim() == '') {
            $('#description_error').html("Description is required");
            temp++;
        } else {
            $('#description_error').html("");
        }
        console.log(temp)
        if (temp == 0) {

            return true;
        } else {
            return false;
        }
    })
</script>

@endsection