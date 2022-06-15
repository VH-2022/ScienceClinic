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

                    <div class="card-header py-3">

                        <div class="card-title align-items-start flex-column">

                            <h3 class="card-label font-weight-bolder text-dark">My Photos</h3>

                        </div>
                        <form id="profileform" enctype="multipart/form-data">
                            @csrf
                            <div class="position-relative">
                                <input type="file" class="input-upload-cus" name="profile" id="profile" onchange="showImage(event);" class="form-control">
                                <div class="upload-photo-main">
                                    <i class="fa fa-plus plus-sign-upload"></i> <span>Upload Photo</span>
                                </div>
                            </div>
                            <span class="text-danger" id="error_image"></span>
                        </form>
                    </div>

                    <div class="card-body">
                        <h6 class="text-center">Please upload your most recent photo</h6>

                        <div class="text-center">
                            <img src="{{Auth::user()->profile_photo}}" id="srcimage" style="height: 150px; width: 150px;">
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
@endsection
@section('page-js')
<script>
    function showImage(event) {
        var output = document.getElementById('srcimage');

        var profileImage = $('#profile').prop('files');
        var temp = 0;
        if (profileImage.length == 0) {
            $('#error_image').html('Please Select Profile Photo');
            temp++
        } else {
            if (profileImage.length != 0) {
                var fileUploadPath = profileImage[0].name;

                var extension = fileUploadPath.substring(fileUploadPath.lastIndexOf('.') + 1).toLowerCase();
                if (extension == 'jpg' || extension == 'png' || extension == 'jpeg') {
                    $('#error_image').html("");
                    output.src = URL.createObjectURL(event.target.files[0]);

                } else {
                    $('#error_image').html("Photo only allows image types of PNG, JPG, JPEG");
                    temp++;
                }
            }
        }
        if (temp == 0) {
            $.ajax({
                async: false,
                url: "{{route('update-tutor-image')}}",
                type: "POST",
                enctype: 'multipart/form-data',
                data: new FormData($('#profileform')[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(result) {
                    if (result) {
                        toastr.success(result.success_msg);
                        $('#sidebar_image_header').css({
                            "background-image": "url(" + result.data + ")"
                        });
                        $("#profile").val('');

                    } else {
                        toastr.error(result.error_msg);
                    }
                }
            });
        } else {
            return false;
        }

    }
</script>

@endsection