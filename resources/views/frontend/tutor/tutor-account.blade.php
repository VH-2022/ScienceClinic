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
                            <h3 class="card-label font-weight-bolder text-dark">Your Personal Information</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-pills personaltab-ul" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="personal-info-tab" data-toggle="pill" href="#personal-info" role="tab" aria-controls="pills-home" aria-selected="true">Personal Info</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="pills-profile" aria-selected="false">Password</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="account-status-tab" data-toggle="pill" href="#account-status" role="tab" aria-controls="pills-contact" aria-selected="false">Account Status</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                                <div class="prime-container">
                                    <form method="post" id="personal_information">
                                        @method('PUT')
                                        @csrf
                                        <div class="row row-spacing">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Name</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="name" name="name" maxlength="30" type="text" autocomplete="off" placeholder="Name" value="{{Auth::guard('web')->user()->first_name}}">
                                                    <span id="error_name" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Email</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="email" name="email" type="text" autocomplete="off" placeholder="Email" value="{{Auth::guard('web')->user()->email}}">
                                                    <span id="error_email" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Telephone</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2 numberCls" id="mobile" name="mobile" type="text" placeholder="Telephone" maxlength="12" autocomplete="off" value="{{Auth::guard('web')->user()->mobile_id}}">
                                                    <span id="error_mobile" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Address 1</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="address1" name="address1" maxlength="255" type="text" placeholder="Address 1" autocomplete="off" value="{{Auth::guard('web')->user()->address1}}">
                                                    <span id="error_address1" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Address 2</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="address2" name="address2" maxlength="255" type="text" placeholder="Address 2" autocomplete="off" value="{{Auth::guard('web')->user()->address2}}">
                                                    <span id="error_address2" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Address 3</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="address3" name="address3" maxlength="255" type="text" placeholder="Address 3" autocomplete="off" value="{{Auth::guard('web')->user()->address3}}">
                                                    <span id="error_address3" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">City</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="city" name="city" type="text" maxlength="255" placeholder="City" autocomplete="off" value="{{Auth::guard('web')->user()->city}}">
                                                    <span id="error_city" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Postcode</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="postcode" name="postcode" type="text" placeholder="Postcode" autocomplete="off" value="{{Auth::guard('web')->user()->postcode}}">
                                                    <span id="error_postcode" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Bio</label> <span style="color:red" class="required-error">*</span>
                                                    <textarea class="form-control placeholder2" cols="30" rows="10" id="bio" name="bio" placeholder="Bio" autocomplete="off" value="{{Auth::guard('web')->user()->bio}}">{{Auth::guard('web')->user()->bio}}</textarea>
                                                    <span id="error_bio" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 offset-md-9 mt-3">
                                                <input id="submitBtn" class="btn btn-primary w-100" type="button" value="Update">
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <div class="prime-container">
                                    <form method="post" id="update_password">
                                        @csrf
                                        <div class="row row-spacing">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Current Password</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="current_password" name="current_password" type="password" autocomplete="off" placeholder="Current Password">
                                                    <span id="current_password_error" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">New Password</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="new_password" name="new_password" type="password" autocomplete="off" placeholder="New Password">
                                                    <span id="new_password_error" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Confirm Password</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="confirmation_password" name="confirmation_password" type="password" autocomplete="off" placeholder="Confirm Password">
                                                    <span id="confirmation_password_error" style="color:red;"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-3 offset-md-9 mt-3">
                                                <input id="submitBtnPwd" class="btn btn-primary w-100" type="button" value="Update">
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-status" role="tabpanel" aria-labelledby="account-status-tab">
                                @if(Auth::guard('web')->user()->status == "Pending")
                                <td><span class="badge badge-primary">Pending</span></td>
                                @elseif(Auth::guard('web')->user()->status =='Accepted')
                                <td><span class="badge badge-success">Approved</span></td>
                                @else
                                <td><span class="badge badge-danger">Not Approved</span></td>
                                @endif
                            </div>
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
    function ValidateEmail(email) {
        var expr =
            /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    }
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
    $("#submitBtn").click(function() {
        var name = $("#name").val();
        var email = $("#email").val();
        var mobile = $("#mobile").val();
        var address1 = $("#address1").val();
        var address2 = $("#address2").val();
        var address3 = $("#address3").val();
        var postcode = $("#postcode").val();
        var city = $("#city").val();
        var bio = $("#bio").val();
        var temp = 0;
        $("#error_name").html('');
        $("#error_email").html('');
        $("#error_mobile").html('');
        $("#error_address1").html('');
        $("#error_address2").html('');
        $("#error_address3").html('');
        $("#error_city").html('');
        $("#error_postcode").html('');
        $("#error_bio").html('');


        if (name.trim() == '') {
            $('#error_name').html('Please enter Name');
            temp++;
        }
        if (email == '') {
            $('#error_email').html('Please enter Email');
            temp++;

        } else {
            if (!ValidateEmail(email)) {
                $('#error_email').html("Invalid Email");
                temp++;
            } else {
                $.ajax({
                    async: false,
                    global: false,
                    url: "{{ route('check-email-tutor') }}",
                    type: "get",
                    data: {
                        email: email
                    },
                    success: function(response) {

                        if (response.status == 1) {

                            $('#error_email').html("Email is already exist");

                            temp++;



                        } else {

                            $('#error_email').html("");

                        }

                    }

                });

            }

        }



        if (mobile.trim() == '') {

            $('#error_mobile').html('Please enter Telephone');

            temp++;

        }

        if (address1.trim() == '') {

            $('#error_address1').html('Please enter Address 1');

            temp++;

        }

        if (address2.trim() == '') {

            $('#error_address2').html('Please enter Address 2');

            temp++;

        }

        if (address3.trim() == '') {

            $('#error_address3').html('Please enter Address 3');

            temp++;

        }

        if (city.trim() == '') {

            $('#error_city').html('Please enter City');

            temp++;

        }

        if (postcode.trim() == '') {

            $('#error_postcode').html('Please enter Postcode');

            temp++;

        }

        if (bio.trim() == '') {

            $('#error_bio').html('Please enter Bio');

            temp++;

        }


        if (temp == 0) {
            $.ajax({
                async: false,
                url: "{{route('update-tutor')}}",
                type: "POST",
                data: new FormData($('#personal_information')[0]),
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if (result) {
                        toastr.success(result.success_msg);
                        $("#sidebar_auth_name").html(result.data[0].first_name);
                        $("#header_auth_name").html(result.data[0].first_name);
                        $("#auth_email_sidebar").html(result.data[0].email);
                    } else {
                        toastr.error(result.error_msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var tempVal = 0;
                    if (jqXHR.responseJSON.message.name) {
                        tempVal++;
                        $('#error_name').text(jqXHR.responseJSON.message.name);
                    } else {
                        $('#error_name').text('');
                    }
                    if (jqXHR.responseJSON.message.email) {
                        tempVal++;
                        $('#error_email').text(jqXHR.responseJSON.message.email);
                    } else {
                        $('#error_email').text('');
                    }
                    if (jqXHR.responseJSON.message.mobile) {
                        tempVal++;
                        $('#error_mobile').text(jqXHR.responseJSON.message.mobile);
                    } else {
                        $('#error_mobile').text('');
                    }
                    if (jqXHR.responseJSON.message.address1) {
                        tempVal++;
                        $('#error_address1').text(jqXHR.responseJSON.message.address1);
                    } else {
                        $('#error_address1').text('');
                    }
                    if (jqXHR.responseJSON.message.address2) {
                        tempVal++;
                        $('#error_address2').text(jqXHR.responseJSON.message.address2);
                    } else {
                        $('#error_address2').text('');
                    }
                    if (jqXHR.responseJSON.message.address3) {
                        tempVal++;
                        $('#error_address3').text(jqXHR.responseJSON.message.address3);
                    } else {
                        $('#error_address3').text('');
                    }
                    if (jqXHR.responseJSON.message.city) {
                        tempVal++;
                        $('#error_city').text(jqXHR.responseJSON.message.city);
                    } else {
                        $('#error_city').text('');
                    }
                    if (jqXHR.responseJSON.message.postcode) {
                        tempVal++;
                        $('#error_postcode').text(jqXHR.responseJSON.message.postcode);
                    } else {
                        $('#error_postcode').text('');
                    }
                    if (jqXHR.responseJSON.message.bio) {
                        tempVal++;
                        $('#error_bio').text(jqXHR.responseJSON.message.bio);
                    } else {
                        $('#error_bio').text('');
                    }
                    if (tempVal == 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            });
        } else {
            return false;
        }

    });
    $("#submitBtnPwd").click(function() {
        var temp = 0;
        var current_password = $('#current_password').val();
        var new_password = $('#new_password').val();
        var confirmation_password = $('#confirmation_password').val();
        $('#current_password_error').html("");
        $('#new_password_error').html("");
        $('#confirmation_password_error').html("");
        if (current_password.trim() == '') {
            $('#current_password_error').html("Current Password is required.");
            temp++;
        } else {
            $.ajax({
                async: false,
                global: false,
                url: "{{ route('check-password-tutor') }}",
                type: "get",
                data: {
                    pwd: current_password
                },
                success: function(response) {
                    if (response.status == 1) {
                        $('#current_password_error').html("Current Password doesnot match");
                        temp++;
                    } else {
                        $('#current_password_error').html("");
                    }
                }
            });
        }

        if (new_password.trim() == '') {
            $('#new_password_error').html("New Password is required.");
            temp++;
        }

        if (new_password.trim() != '') {
            if (new_password.length < 6) {
                $('#new_password_error').html("New Password atleast six character allowed.");
                temp++;
            }
        }
        if (confirmation_password.trim() == '') {
            $('#confirmation_password_error').html("Confirm Password is required.");
            temp++;
        }
        if (confirmation_password.trim() != '' && new_password.trim() != '') {
            if (new_password.trim() != confirmation_password.trim()) {
                $('#confirmation_password_error').html("New password and Confirm password does not match.");
                temp++;
            }

        }
        if (temp == 0) {
            $.ajax({
                async: false,
                url: "{{route('update-password-tutor')}}",
                type: "POST",
                data: new FormData($('#update_password')[0]),
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if (result) {
                        $('#update_password')[0].reset();
                        toastr.success(result.success_msg);
                    } else {
                        toastr.error(result.error_msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var tempVal = 0;
                    if (jqXHR.responseJSON.message.current_password) {
                        tempVal++;
                        $('#current_password_error').text(jqXHR.responseJSON.message.current_password);
                    } else {
                        $('#current_password_error').text('');
                    }
                    if (jqXHR.responseJSON.message.new_password) {
                        tempVal++;
                        $('#new_password_error').text(jqXHR.responseJSON.message.new_password);
                    } else {
                        $('#new_password_error').text('');
                    }
                    if (jqXHR.responseJSON.message.confirmation_password) {
                        tempVal++;
                        $('#confirmation_password_error').text(jqXHR.responseJSON.message.confirmation_password);
                    } else {
                        $('#confirmation_password_error').text('');
                    }
                    if (tempVal == 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            });
        }
        else{
            return false;
        }
    });
</script>
@endsection