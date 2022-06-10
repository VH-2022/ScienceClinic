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

                            <h3 class="card-label font-weight-bolder text-dark">Verification List</h3>

                        </div>


                    </div>

                    <div class="card-body">

                        <table class="table table-separate table-head-custom">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Mandatory items</th>
                                    <th style="width: 10%;">Progress</th>
                                    <th style="width: 5%;"></th>
                                    <th style="width: 21%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($query as $val)
                                <tr>
                                    <td>Profile Image</td>
                                    @if($val->status == "Pending")
                                    <td><span class="badge badge-primary">Pending</span></td>
                                    @elseif($val->status =='Accepted')
                                    <td><span class="badge badge-success">Approved</span></td>
                                    @else
                                    <td><span class="badge badge-danger">Not Approved</span></td>
                                    @endif
                                    <td><img id="profile-image" src="{{$val->profile_photo}}" width="50" height="50"></td>
                                    <td>
                                        <form id="profile-form" enctype='multipart/form-data'>
                                            @csrf
                                            <label for="profile" class="btn text-primary p-0 mb-0 mr-2">Upload</label><span id="profile_pic_error" style="color: red;"></span><input name="profile_image" id="profile" style="display:none;" type="file">
                                        </form>
                                    </td>
                                </tr>
                                @if($val->dbs_disclosure == "Yes")
                                <tr>
                                    <td>Enhanced DBS</td>
                                    @if($val->status == "Pending")
                                    <td><span class="badge badge-primary">Pending</span></td>
                                    @elseif($val->status =='Accepted')
                                    <td><span class="badge badge-success">Approved</span></td>
                                    @else
                                    <td><span class="badge badge-danger">Not Approved</span></td>
                                    @endif
                                    <td id="dbs-image">
                                        @php
                                        $image_array = array('jpg','png','jpeg','gif');
                                        $explode = explode('.',$val->document);
                                        @endphp
                                        @if($val->document)
                                        @if(in_array($explode[4], $image_array))
                                        <a href="{{$val->document}}" download><i class="fas fa-photo-video"></i></a>
                                        @else
                                        <a href="{{$val->document}}" download><i class="far fa-file-pdf"></i></a>
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        <form id="dbs-form" enctype='multipart/form-data'>
                                            @csrf
                                            <label for="dbs" class="btn text-primary p-0 mb-0 mr-2">Upload</label><span id="dbs_error" style="color: red;"></span></span><input id="dbs" style="display:none;" name="dbs" type="file">
                                        </form>
                                    </td>

                                </tr>
                                @endif
                                @foreach($val->certificate as $certificateData)
                                <tr>
                                    <td>Certificates</td>
                                    @if($val->status == "Pending")
                                    <td><span class="badge badge-primary">Pending</span></td>
                                    @elseif($val->status =='Accepted')
                                    <td><span class="badge badge-success">Approved</span></td>
                                    @else
                                    <td><span class="badge badge-danger">Not Approved</span></td>
                                    @endif
                                    <td><a id="certificate-data-{{$certificateData->id}}" href='{{$certificateData->document_image}}' download><i class="far fa-file-pdf"></i></a></td>
                                    <td>
                                        <form id="form_{{$certificateData->id}}" enctype='multipart/form-data'>
                                            @csrf
                                            <label for="{{$certificateData->id}}" class="btn text-primary p-0 mb-0 mr-2">Upload</label><span id="document_certi_error_{{$certificateData->id}}" style="color: red;"></span><input id="{{$certificateData->id}}" onchange='updatePdf({{$certificateData->id}})' name="certificate" style="display:none;" type="file"><input type="hidden" name="certificate_id" value="{{$certificateData->id}}">
                                    </td>
                                    </form>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>

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
    toastr.options.closeButton = true;
    toastr.options.tapToDismiss = false;
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": 0,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false
    };

    function updatePdf(id) {
        var temp = 0;
        var files = $("#" + id).val();
        var fileNameIndex = files.lastIndexOf("/") + 1;
        var filename = files.substr(fileNameIndex);
        var Extension = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
        if (Extension == 'pdf') {
            $('#document_certi_error_' + id).html("");
        } else {
            $('#document_certi_error_' + id).html("Only Pdf Allowed");
            temp++;
        }
        if (temp == 0) {
            $.ajax({
                async: false,
                url: "{{route('tutor-certificate')}}",
                type: "POST",
                enctype: 'multipart/form-data',
                data: new FormData($('#form_' + id)[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(result) {
                    if (result) {
                        toastr.success(result.success_msg);
                        let url = result.data;
                        $("#certificate-data-" + result.id).attr("href", url);
                    } else {
                        toastr.error(result.error_msg);
                    }
                }
            });
        } else {
            return false;
        }
    }
    $("#profile").change(function() {
        var temp = 0;
        filename = this.files[0].name;
        var Extension = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
        if (Extension == 'jpg' || Extension == 'png' || Extension == 'gif' || Extension == 'jpeg') {
            $('#profile_pic_error').html("");

        } else {
            $('#profile_pic_error').html("Photo only allows image types of PNG, JPG, JPEG");
            temp++;
        }
        if (temp == 0) {
            $.ajax({
                async: false,
                url: "{{route('tutor-profile')}}",
                type: "POST",
                enctype: 'multipart/form-data',
                data: new FormData($('#profile-form')[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(result) {
                    if (result) {
                        toastr.success(result.success_msg);
                        $('#sidebar_image_header').css({
                            "background-image": "url(" + result.data + ")"
                        });
                        $("#profile-image").attr("src", result.data);
                    } else {
                        toastr.error(result.error_msg);
                    }
                }
            });
        } else {
            return false;
        }
    });
    $("#dbs").change(function() {
        var temp = 0;
        filename = this.files[0].name;
        var Extension = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
        if (Extension == 'jpg' || Extension == 'png' || Extension == 'gif' || Extension == 'jpeg' || Extension == 'pdf') {
            $('#dbs_error').html("");

        } else {
            $('#dbs_error').html("Photo only allows image types of PNG, JPG, JPEG");
            temp++;
        }
        if (temp == 0) {
            $.ajax({
                async: false,
                url: "{{route('tutor-dbs')}}",
                type: "POST",
                enctype: 'multipart/form-data',
                data: new FormData($('#dbs-form')[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(result) {
                    if (result) {
                        toastr.success(result.success_msg);
                        var image_array = ['jpg', 'png', 'jpeg', 'gif'];
                        var val = result.data;
                        var explode = val.split('.');
                        var extensionVal = explode[4];
                        if (result.data) {
                            if (image_array.includes(extensionVal)) {
                                $("#dbs-image").empty().append('<a href = '+result.data+' download> <i class="fas fa-photo-video"></i></a>');
                            } else {
                                $("#dbs-image").empty().append('<a href = '+result.data+' download> <i class="far fa-file-pdf"></i></a>');
                            }
                        }
                    } else {
                        toastr.error(result.error_msg);
                    }
                }
            });
        } else {
            return false;
        }
    });
</script>
@endsection