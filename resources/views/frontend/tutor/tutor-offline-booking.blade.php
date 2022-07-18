@extends('layouts.master')

@section('content')
<div class="d-flex flex-column-fluid">



    <div class="container-fluid">



        <div class="d-flex flex-row">



            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom card-stretch">

                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Offline Booking</h3>
                        </div>

                        <div class="card-toolbar">

                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">

                                <a href="javascript:void(0)" class="btn btn-primary mr-2" id="add-booking" data-toggle="modal" data-target="#ajax-crud-modal" title="Add booking">

                                    <span class="svg-icon svg-icon-md">

                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->

                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                <rect x="0" y="0" width="24" height="24"></rect>

                                                <circle fill="#000000" cx="9" cy="15" r="6"></circle>

                                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>

                                            </g>

                                        </svg>

                                        <!--end::Svg Icon-->

                                    </span>Add booking
                                </a>

                                <!--begin::Dropdown Menu-->

                            </div>

                            <!--end::Dropdown-->

                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-pills personaltab-ul" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="personal-info-tab" data-toggle="pill" href="javascript:void(0)" onclick="window.location.href='tutor-bookings'" role="tab" aria-controls="pills-home" aria-selected="true">My Bookings</a>
                            </li>
                            <li class="nav-item active" role="presentation">
                                <a class="nav-link" id="payment-tab" data-toggle="pill" role="tab" aria-controls="pills-home" href="javascript:void(0)" onclick="window.location.href='tutor-availability'" role="tab" aria-selected="true">My Availability</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="payment-tab" data-toggle="pill" href="javascript:void(0)" onclick="window.location.href='tutor-missed-lessons'" role="tab" aria-controls="pills-home" aria-selected="true">Missed Lessons</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="payment-tab" data-toggle="pill" href="javascript:void(0)" role="tab" aria-controls="pills-home" aria-selected="true">Offline Booking</a>
                            </li>
                            <input type="hidden" value="{{Auth::user()->id}}" id="tutor_id">
                        </ul>

                        <div class="tab-pane fade show active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="prime-container">
                                <h3>Offline Booking</h3>
                                <br></br>
                            </div>
                        </div>
                        <div class="table-responsive" id="response_id">
                        </div>
                    </div>


                </div>

            </div>

        </div>


    </div>
</div>

<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Add booking</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form action="{{route('offling-booking-store')}}" method="post" id="subjectForm" name="userForm" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Student Name <span class="text-danger">*</span></label>
                            <input type="text" autocomplete="off" class="form-control" name="sname" id="sname">
                            <span class="title error_msg error" style="color: red;" id="name_error">{{ $errors->booking->first('sname')}}</span>

                        </div>

                    </div>
                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Subject <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="main_subject" id="main_subject">

                                <option value="">Select Subject</option>

                                @foreach($subject as $val)
                                <option value="{{$val->id}}">{{$val->main_title}}</option>
                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="subject_error">{{ $errors->booking->first('main_subject')}}</span>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Level <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="level" id="level">

                                <option value="">Select Level</option>

                                @foreach($level as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="level_error">{{ $errors->booking->first('level')}}</span>

                        </div>

                    </div>
                    @php $daysArr = [ 'Monday' =>'monday',
                    'Tuesday' => 'tuesday',
                    'Wednesday' => 'wednesday',
                    'Thursday' => 'thursday',
                    'Friday' => 'friday',
                    'Saturday' => 'saturday',
                    'Sunday' => 'sunday'] @endphp
                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Day <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="day" id="day">

                                <option value="">Select Day</option>

                                @foreach($daysArr as $key=>$val)
                                <option value="{{$val}}">
                                    {{$key}}
                                </option>
                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="level_error">{{ $errors->subject->first('level')}}</span>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" id="btn-save" title="Submit">Submit

                    </button>

                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" aria-hidden="true" title="Cancel">Cancel</button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection
@section('page-js')
<script>
    var _AJAX_LIST = "{{ route('tutor-subject-ajax') }}";

    function ajaxList(page) {
        $('.ki-close').click();
        $.ajax({
            type: "GET",
            url: _AJAX_LIST,
            data: {
                'page': page,
            },
            success: function(res) {
                $('#response_id').html("");
                $('#response_id').html(res);
            }

        })
    }

    ajaxList(1);
    // $('#btn-save').click(function(e) {
    //     var name = $('#main_subject').val();
    //     var studentName = $('#sname').val();
    //     var level = $('#level').val();
    //     var cnt = 0;
    //     $('#name_error').html("");
    //     $('#subject_error').html("");   
    //     $('#level_error').html("");
    //     if (studentName == '') {
    //         $('#name_error').html("Student Name is required");
    //         cnt = 1;
    //     }
    //     if (name == '') {
    //         $('#subject_error').html("Subject is required");
    //         cnt = 1;
    //     }
    //     if (level == '') {
    //         $('#level_error').html("Level is required");
    //         cnt = 1;
    //     }
    //     if (cnt == 1) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // })

    $('#btn-update').click(function(e) {
        var name = $('#main_subject_edit').val();
        var level = $('#level_edit').val();
        var id = $('#level_id_edit').val();
        var mainId = $('#main_id_edit').val();
        var cnt = 0;
        $('#subject_error_edit').html("");
        $('#level_error_edit').html("");
        if (name == '') {
            $('#subject_error_edit').html("Subject is required");
            cnt = 1;
        } else {
            $.ajax({
                async: false,
                global: false,
                url: "{{route('check-level-subject')}}",
                type: "POST",
                data: {
                    name: name,
                    level: level,
                    id: id,
                    mainId: mainId,
                    _token: "{{ csrf_token()}}"
                },
                success: function(response) {
                    if (response == 1) {
                        $('#level_error_edit').html("Level is already exist");
                        $('#subject_error_edit').html("Subject is already exist");
                        cnt = 1;
                    } else {
                        $('#level_error_edit').html("");
                        $('#subject_error_edit').html("");
                    }
                }
            });
        }
        if (level == '') {
            $('#level_error_edit').html("Level is required");
            cnt = 1;
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    })

    $('#btn-update-online').click(function(e) {
        var name = $('#main_subject_online_edit').val();
        var level = $('#level_online_edit').val();
        var id = $('#level_id_online_edit').val();
        var mainId = $('#main_id_online_edit').val();
        var cnt = 0;
        $('#subject_error_online_edit').html("");
        $('#level_error_online_edit').html("");
        if (name == '') {
            $('#subject_error_online_edit').html("Subject is required");
            cnt = 1;
        } else {
            $.ajax({
                async: false,
                global: false,
                url: "{{route('check-level-subject')}}",
                type: "POST",
                data: {
                    name: name,
                    level: level,
                    id: id,
                    mainId: mainId,
                    _token: "{{ csrf_token()}}"
                },
                success: function(response) {
                    if (response == 1) {
                        $('#level_error_online_edit').html("Level is already exist");
                        $('#subject_error_online_edit').html("Subject is already exist");
                        cnt = 1;
                    } else {
                        $('#level_error_online_edit').html("");
                        $('#subject_error_online_edit').html("");
                    }
                }
            });
        }
        if (level == '') {
            $('#level_error_online_edit').html("Level is required");
            cnt = 1;
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    })

    function editDetail(id) {
        if (id != "") {
            $('#editajax-crud-modal').modal('show');
            $.ajax({
                url: "{{ url('tutor-subject-edit') }}/" + id,
                type: "GET",
                success: function(res) {
                    var val = JSON.parse(res);
                    $("#main_subject_edit").find("option[value=" + val.subject_id + "]").attr('selected', true);
                    $("#level_edit").find("option[value=" + val.level_id + "]").attr('selected', true);
                    $("#level_id_edit").val(val.tutor_id);
                    $("#main_id_edit").val(val.id);
                }
            });

        }
    }

    function deleteDetail(deleteId) {
        event.preventDefault(); // prevent form submit
        $.confirm({
            title: 'Delete!',
            content: 'you want to delete this subject?',
            buttons: {
                confirm: function() {
                    $.ajax({
                        url: "{{ url('remove-subject') }}/" + deleteId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                },
                cancel: function() {}
            }
        });
    }

    $(document).ready(function() {
        <?php if (Request::get('addpopup') == '1') { ?>
            $("#ajax-crud-modal").modal('show');
        <?php } ?>
        <?php if (Request::get('editpopup') == '1') { ?>
            var edit = <?php echo Request::get('id'); ?>;
            $.ajax({
                async: false,
                global: false,
                url: "{{ url('tutor-subject-edit') }}/" + edit,
                type: "GET",
                success: function(response) {
                    var val = JSON.parse(res);
                    $("#main_subject_edit").find("option[value=" + val.subject_id + "]").attr('selected', true);
                    $("#level_edit").find("option[value=" + val.level_id + "]").attr('selected', true);
                    $("#level_id_edit").val(val.tutor_id);
                    $("#main_id_edit").val(val.id);
                }
            });
            $('#editajax-crud-modal').modal('show');
        <?php } ?>
        <?php if (Request::get('addpopupresource') == '1') { ?>
            $("#resource-ajax-crud-modal").modal('show');
        <?php } ?>
        <?php if (Request::get('editpopupresource') == '1') { ?>
            var edit = <?php echo Request::get('id'); ?>;
            $.ajax({
                async: false,
                global: false,
                url: "{{URL::to('tutor-resource')}}/" + edit,
                type: "GET",
                success: function(response) {
                    var val = JSON.parse(res);
                    $("#title_edit").val(val.title);
                    $("#description_edit").val(val.description);
                    $('.view-document').attr("href", val.upload_data);
                    $("#user_id").val(val.id);
                }
            });
            $('#resource-edit-ajax-crud-modal').modal('show');
        <?php } ?>
    });
    $('#text_book_upload').change(function() {
        var name = $('#text_book_upload').val().split('\\').pop();
        $('#uploadtitle').html(name);
    });
    $('#text_book_upload_edit').change(function() {
        var name = $('#text_book_upload_edit').val().split('\\').pop();
        $('#uploadtitleEdit').html(name);
    });
    $('#btn-resource-save').click(function(e) {
        var titleVal = $('#resource-title').val();
        var descriptionVal = $('#resource-description').val();
        var document = $('#text_book_upload').val();
        var cnt = 0;
        console.log(titleVal);
        $('#title_error').html("");
        $('#description_error').html("");
        $('#document_error').html("");
        if (titleVal.trim() == '') {
            $('#title_error').html("Title is required");
            cnt = 1;
        }
        if (descriptionVal.trim() == '') {
            $('#description_error').html("Description is required");
            cnt = 1;
        }
        regex = new RegExp("(.*?)\.(jpeg|png|jpg|gif|docx|ppt|pdf|doc)$");
        if (document != "") {
            if (!(regex.test(document))) {
                $('#document_error').html("Document must be Type!! Like: JPEG, PNG, JPG, GIF, PPT, PDF, DOCX, and DOC");
                cnt = 1;
            }
        } else {
            $('#document_error').html("Please enter Document");
            cnt = 1;
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    });

    function editResourceDetail(id) {
        if (id != "") {
            $('#resource-edit-ajax-crud-modal').modal('show');
            $.ajax({
                url: "{{URL::to('tutor-resource')}}/" + id,
                type: "GET",
                success: function(res) {
                    var val = JSON.parse(res);
                    $("#resource_title_edit").val(val.title);
                    $("#resource_description_edit").val(val.description);
                    $('.view-document').attr("href", val.upload_data);
                    $("#user_id").val(val.id);
                }
            });

        }
    }

    $('#btn-update-resource').click(function(e) {
        var title = $('#resource_title_edit').val();
        var description = $('#resource_description_edit').val();
        var document = $('#text_book_upload').val();
        var cnt = 0;
        $('#title_error_edit').html("");
        $('#description_error_edit').html("");
        $('#document_error_edit').html("");
        if (title.trim() == '') {
            $('#title_error_edit').html("Title is required");
            cnt = 1;
        }
        if (description.trim() == '') {
            $('#description_error_edit').html("Description is required");
            cnt = 1;
        }
        regex = new RegExp("(.*?)\.(jpeg|png|jpg|gif|docx|ppt|pdf|doc)$");
        if (document != "") {
            if (!(regex.test(document))) {
                $('#document_error_edit').html("Document must be Type!! Like: JPEG, PNG, JPG, GIF, PPT, PDF, DOCX, and DOC");
                cnt = 1;
            }
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    });

    function deleteResourceDetail(deleteId) {
        event.preventDefault(); // prevent form submit
        $.confirm({
            title: 'Delete!',
            content: 'you want to delete this resource?',
            buttons: {
                confirm: function() {
                    $.ajax({
                        url: "{{route('tutor-resource.destroy','')}}" + "/" + deleteId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                },
                cancel: function() {}
            }
        });
    }
</script>
@endsection