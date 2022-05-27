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
                                    <th style="width: 13%;">Mandatory items</th>
                                    <th style="width: 13%;">Progress</th>
                                    <th style="width: 16%;"></th>
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
                                    <td>
                                        <form id="profile-form" enctype='multipart/form-data'>
                                            @csrf
                                            <label for="profile" class="btn text-primary p-0 mb-0 mr-2">Upload</label><span id="profile_pic_error" style="color: red;"></span><span class="profile"></span><input name="profile_image" id="profile" style="display:none;" type="file">
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Enhanced DBS</td>
                                    @if($val->dbs_disclosure == "Yes")
                                        @if($val->status == "Pending")
                                        <td><span class="badge badge-primary">Pending</span></td>
                                        @elseif($val->status =='Accepted')
                                        <td><span class="badge badge-success">Approved</span></td>
                                        @else
                                        <td><span class="badge badge-danger">Not Approved</span></td>
                                        @endif
                                        <td>
                                            <form id="dbs-form" enctype='multipart/form-data'>
                                                @csrf
                                                <label for="dbs" class="btn text-primary p-0 mb-0 mr-2">Upload</label><span id="dbs_error" style="color: red;"></span><span class="dbs"></span><input id="dbs" style="display:none;" name="dbs" type="file">
                                            </form>
                                        </td>
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Certificates</td>
                                    @if($val->status == "Pending")
                                    <td><span class="badge badge-primary">Pending</span></td>
                                    @elseif($val->status =='Accepted')
                                    <td><span class="badge badge-success">Approved</span></td>
                                    @else
                                    <td><span class="badge badge-danger">Not Approved</span></td>
                                    @endif
                                    <td><label for="certificate" class="btn text-primary p-0 mb-0 mr-2">Upload</label><span id="document_certi_error" style="color: red;"></span><span class="certificate"></span><input id="certificate" style="display:none;" type="file"></td>
                                </tr>
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
                        $('#sidebar_image_header').css({"background-image": "url("+result.data+")"});  
                    } else {
                        toastr.error(result.error_msg);
                    }
                }
            });
        } else {
            return false;
        }
        $(".profile").empty().append(filename);
    });
    $("#dbs").change(function() {
        var temp = 0;
        filename = this.files[0].name;
        var Extension = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
        if (Extension == 'jpg' || Extension == 'png' || Extension == 'gif' || Extension == 'jpeg') {
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
                    } else {
                        toastr.error(result.error_msg);
                    }
                }
            });
        } else {
            return false;
        }

        $(".dbs").empty().append(filename);
    });
    $("#certificate").change(function() {
        var temp = 0;
        filename = this.files[0].name;
        var Extension = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
        if (Extension == 'pdf') {
            $('#document_certi_error').html("");
        } else {
            $('#document_certi_error').html("Only Pdf Allowed");
            temp++;
        }
        if (temp == 0) {

        } else {
            return false;
        }

        $(".certificate").empty().append(filename);
    });
</script>
@endsection