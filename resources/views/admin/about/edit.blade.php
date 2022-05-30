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
                                <h3 class="card-label font-weight-bolder text-dark">Edit About</h3>
                            </div>
                        </div>
                        <form class="form" method="POST" action="{{ route('about-list.update', $about->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $about->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Content1 <span class="text-danger">*</span></label>
                                            <textarea placeholder="Content1" class="form-control validate_field" id="content1" type="text" data-msg="Content1"
                                                name="content1" value="{{ $about->content1 }}"
                                                rows="7">{{ $about->content1 }}</textarea>
                                            <span class="form-text error content1_error"
                                                id="content1_error ">{{ $errors->first('content1') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <div>
                                                        <input type="file" name="image" data-msg="Image" id="image"
                                                            accept=".png, .jpg, .jpeg">
                                                        <span class="form-text error image_error"
                                                            id="image_error">{{ $errors->first('image') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <img src="{{ $about->image }}" style="width:60px;height:60px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Content2 <span class="text-danger">*</span></label>
                                            <textarea type="text" data-msg="Content2" class="form-control validate_field" placeholder="Content2" name="content2"
                                                id="content2" data-msg="content2">{{ $about->content2 }}</textarea>
                                            <span class="form-text error content2_error"
                                                id="content2_error ">{{ $errors->first('content2') }}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1 edit_about"
                                    id="edit_about">Update</button>
                                <button type="reset" class="btn btn-secondary"
                                    onclick="window.location.href='{{ route('about-list.index') }}'">Cancel</button>
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
        CKEDITOR.replace('content2');
        $('#edit_about').click(function(e) {
            var temp = 0;
            var content1 = $('#content1').val();
            $('.content1_error').removeClass('is-valid');
            $('.content1_error').html("");
            if (content1.trim() == '') {
                var dataMSG = $('#content1').attr('data-msg');
                $('.content1_error').addClass('is-invalid').removeClass('is-valid');
                $('.content1_error').html(dataMSG + ' is required.');
                temp++;
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

            var content2 = CKEDITOR.instances['content2'].getData();
            $('.content2_error').removeClass('is-valid');
            $('.content2_error').html("");
            if (content2.trim() == '') {
                var dataMSG = $('#content2').attr('data-msg');
                $('.content2_error').addClass('is-invalid').removeClass('is-valid');
                $('.content2_error').html(dataMSG + ' is required.');
                temp++;
            }

            if (temp == 0) {
                return true;
            } else {
                return false;
            }
        })
    </script>
@endsection
