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

                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                                <div class="prime-container">
                                    <form id="updateparent" method="post">
                                        @csrf
                                        <div class="row row-spacing">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">First Name</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" maxlength="30" id="firstname" name="firstname" type="text" autocomplete="off" placeholder="First Name" value="{{Auth::guard()->user()->first_name}}">
                                                    <span id="firstname_error" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Last Name</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" maxlength="30" id="lastname" name="lastname" type="text" autocomplete="off" placeholder="Last Name" value="{{Auth::guard()->user()->last_name}}">
                                                    <span id="lastname_error" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="{{Auth::guard()->user()->id}}">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Email</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="email" name="email" type="text" autocomplete="off" placeholder="Email" value="{{Auth::guard()->user()->email}}">
                                                    <span id="email_error" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Telephone</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2 numberCls" maxlength="12" id="telephone" name="telephone" type="text" placeholder="Telephone" autocomplete="off" value="{{Auth::guard()->user()->mobile_id}}">
                                                    <span id="telephone_error" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Address </label> <span style="color:red" class="required-error">*</span>
                                                    <textarea class="form-control placeholder2" id="address" name="address" type="text" maxlength="255" placeholder="Address" cols="20" rows="10" autocomplete="off">{{Auth::guard()->user()->address1}}</textarea>
                                                    
                                                    <span id="address1_error" style="color:red;"></span>
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
                                    <form method="post" id="updatepassword">
                                        @csrf
                                        <div class="row row-spacing">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Current Password</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="oldpassword" name="oldpassword" type="password" autocomplete="off" placeholder="Current Password">
                                                    <span id="oldpassword_error" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">New Password</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="newpassword" name="newpassword" type="password" autocomplete="off" placeholder="New Password">
                                                    <span id="newpassword_error" style="color:red;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-control-spacing">
                                                    <label for="example-text-input" class="form-label">Confirm Password</label> <span style="color:red" class="required-error">*</span>
                                                    <input class="form-control placeholder2" id="confirmpassword" name="confirmpassword" type="password" autocomplete="off" placeholder="Confirm Password">
                                                    <span id="confirmpassword_error" style="color:red;"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-3 offset-md-9 mt-3">
                                                <input id="submitpassword" class="btn btn-primary w-100" type="button" value="Update">
                                            </div>

                                        </div>
                                    </form>
                                </div>
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
    $('.numberCls').keypress(function(event) {
        if (event.keyCode < 48 || event.keyCode > 57) {
            event.preventDefault();
        }
    });

    $('#submitBtn').click(function() {
        var firstName = $('#firstname').val();
        var lastName = $('#lastname').val();
        var email = $('#email').val();
        var telephone = $('#telephone').val();
        var address = $('#address').val();
        var temp = 0;

        $('#firstname_error').html('');

        if (firstName.trim() == '') {
            $('#firstname_error').html('Please enter firstname');
            temp++
        }

        $('#lastname_error').html('');

        if (lastName.trim() == '') {
            $('#lastname_error').html('Please enter lastname');
            temp++
        }
        $('#email_error').html('');

        if (email.trim() == '') {
            $('#email_error').html('Please enter email');
            temp++
        } else {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                $('#email_error').html('Please enter valid email');
                temp++
            } else {
                $.ajax({
                    async: false,
                    global: false,
                    url: "{{ route('check-email-parent') }}",
                    type: "get",
                    data: {
                        email: email
                    },
                    success: function(response) {

                        if (response.status == 1) {

                            $('#email_error').html("Email is already exist");

                            temp++;



                        } else {

                            $('#error_email').html("");

                        }

                    }

                });

            }

        }

        $('#telephone_error').html('');

        if (telephone.trim() == '') {
            $('#telephone_error').html('Please enter telephone');
            temp++
        }
        $('#address1_error').html('');

        if (address.trim() == '') {
            $('#address1_error').html('Please enter address');
            temp++
        }
        if (temp == 0) {
            $.ajax({
                async: false,
                url: "{{route('update-parent')}}",
                type: "POST",
                data: new FormData($('#updateparent')[0]),
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if (result) {
                        console.log(result);
                        toastr.success(result.error_msg);

                        $("#sidebar_auth_name").html(result.data.fullname);
                        $("#header_auth_name").html(result.data.fullname);
                        $("#auth_email_sidebar").html(result.data.email);
                    } else {
                        toastr.error(result.error_msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var tempVal = 0;
                    if (jqXHR.responseJSON.message.firstname) {
                        tempVal++;
                        $('#firstname_error').text(jqXHR.responseJSON.message.firstname);
                    } else {
                        $('#firstname_error').text('');
                    }
                    if (jqXHR.responseJSON.message.lastname) {
                        tempVal++;
                        $('#lastname_error').text(jqXHR.responseJSON.message.lastname);
                    } else {
                        $('#lastname_error').text('');
                    }
                    if (jqXHR.responseJSON.message.email) {
                        tempVal++;
                        $('#email_error').text(jqXHR.responseJSON.message.email);
                    } else {
                        $('#email_error').text('');
                    }
                    if (jqXHR.responseJSON.message.telephone) {
                        tempVal++;
                        $('#telephone_error').text(jqXHR.responseJSON.message.telephone);
                    } else {
                        $('#telephone_error').text('');
                    }
                    if (jqXHR.responseJSON.message.address) {
                        tempVal++;
                        $('#address1_error').text(jqXHR.responseJSON.message.address);
                    } else {
                        $('#address1_error').text('');
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


    $("#submitpassword").click(function() {
        var temp = 0;
        var current_password = $('#oldpassword').val();
        var new_password = $('#newpassword').val();
        var confirmation_password = $('#confirmpassword').val();
        $('#oldpassword_error').html("");
        $('#newpassword_error').html("");
        $('#confirmpassword_error').html("");
        if (current_password.trim() == '') {
            $('#oldpassword_error').html("Current Password is required.");
            temp = 1;
        } else {
            $.ajax({
                async: false,
                global: false,
                url: "{{ route('check-old-password') }}",
                type: "get",
                data: {
                    pwd: current_password
                },
                success: function(response) {

                    if (response.status == 1) {

                        $('#oldpassword_error').html("Enter correct Current Password");

                        temp = 1;



                    } else {

                        $('#oldpassword_error').html("");

                    }

                }

            });

        }

        if (new_password.trim() == '') {
            $('#newpassword_error').html("New Password is required.");
            temp = 1;
        }

        if (new_password.trim() != '') {
            if (new_password.length < 6) {
                $('#newpassword_error').html("New Password atleast six character allowed.");
                temp = 1;
            }
        }
        if (confirmation_password.trim() == '') {
            $('#confirmpassword_error').html("Confirm Password is required.");
            temp = 1;
        }
        if (confirmation_password.trim() != '' && new_password.trim() != '') {
            if (new_password.trim() != confirmation_password.trim()) {
                $('#confirmpassword_error').html("New password and Confirm password does not match.");
                temp = 1;
            }

        }

        if (temp == 1) {
            return false;
        }

        if (temp == 0) {
            var forms = $('#updatepassword')[0];
            var formData = new FormData(forms);
            $.ajax({
                type: 'POST',
                url: "{{route('update-password')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(r) {
                    if (r.status == 1) {
                        $('#updatepassword')[0].reset();
                        toastr.success(r.success_msg);
                    } else {
                        toastr.error(r.error_msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var tempVal = 0;
                    if (jqXHR.responseJSON.message.oldpassword) {
                        tempVal++;
                        $('#oldpassword_error').text(jqXHR.responseJSON.message.oldpassword);
                    } else {
                        $('#oldpassword_error').text('');
                    }
                    if (jqXHR.responseJSON.message.newpassword) {
                        tempVal++;
                        $('#newpassword_error').text(jqXHR.responseJSON.message.newpassword);
                    } else {
                        $('#newpassword_error').text('');
                    }
                    if (jqXHR.responseJSON.message.confirmpassword) {
                        tempVal++;
                        $('#confirmpassword_error').text(jqXHR.responseJSON.message.confirmpassword);
                    } else {
                        $('#confirmpassword_error').text('');
                    }
                    if (tempVal == 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            });
        }
    });
</script>

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
</script>
@endsection