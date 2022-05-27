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
                                <h3 class="card-label font-weight-bolder text-dark">Edit Blog Master</h3>
                            </div>
                        </div>

                        <form class="form" id="submitid" method="POST"
                            action="{{ route('blog-master.update', $blog->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $blog->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input placeholder="Title" class="form-control validate_field"
                                                autocomplete="off" id="title" type="text" data-msg="Title" name="title"
                                                value="{{ $blog->title }}">
                                            <span class="form-text error title_error"
                                                id="title_error">{{ $errors->first('title') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label>Image <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input type="file" name="image" data-msg="Image" id="image"
                                                            accept=".png, .jpg, .jpeg">
                                                        <span class="form-text error image_error" id="image_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="oldmg" value="{{ $blog->image }}" />
                                            <div class="col-md-2">
                                                <img src="{{ $blog->image }}" style="width:60px;height:60px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea type="text" data-msg="Description" class="form-control validate_field" placeholder="Description"
                                                name="description" id="description" value="{{ $blog->description }}"
                                                data-msg="Description">{{ $blog->description }}</textarea>
                                            <span class="form-text error description_error" id="description_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" title="Submit"
                                    id="edit_blog">Update</button>
                                {{-- <button type="update" id="edit_blog" class="btn btn-primary mr-2"
                                    style="background-color:#3498db !important">Update</button> --}}
                                <button type="reset" class="btn btn-secondary"
                                    onclick="window.location.href='{{ url('blog-master') }}'">Cancel</button>
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
        CKEDITOR.replace('description');
        $('#edit_blog').click(function(e) {

            var title = $('#title').val();
            var description = CKEDITOR.instances['description'].getData();

            var temp = 0;

            if (title.trim() == '') {
                $('#title_error').html("Titel is required");
                temp++;
            } else {
                $('#title_error').html("");
            }

            var image = $('input[name="image"]').prop('files');
            if (image.length != 0) {
                $('.image_error').html("");
                var FileUploadPath = image[0].name;
                var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
                if (Extension == 'jpg' || Extension == 'png' || Extension == 'gif' || Extension == 'jpeg') {} else {
                    $('.image_error').html("Image only allows image types of PNG, JPG, JPEG");
                    temp++;
                }
            }

            if (description.trim() == '') {
                $('#description_error').html("Description is required");
                temp++;
            } else {
                $('#description_error').html("");
            }

            if (temp == 0) {
                return true;
            } else {
                return false;
            }
        })
    </script>
@endsection
