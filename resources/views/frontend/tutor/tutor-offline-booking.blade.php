@extends('layouts.master')
<link href="//cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css
" rel="stylesheet">
<link href="{{ asset('assets/plugins/custom/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
@section('content')
<style>
    .modal-open .bootstrap-timepicker-meridian{
        width: 38px;
    }
    .custom-table-td tr td{
        font-size: 13px;
    }
</style>
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

            <form action="{{route('offline-booking-store')}}" method="post" id="subjectForm" name="userForm" class="form-horizontal">

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

                            <span class="title error_msg error" style="color: red;" id="day_error">{{ $errors->booking->first('level')}}</span>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Idel Time <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" name="idel_time" id="idel_time">


                            <span class="idel_time error_msg error" style="color: red;" id="idel_time_error">{{ $errors->booking->first('idel_time')}}</span>

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
<div class="modal fade title-edit" id="editajax-crud-modal" aria-hidden="true">

<div class="modal-dialog">

<div class="modal-content">

    <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Edit booking</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <i aria-hidden="true" class="ki ki-close"></i>

        </button>

    </div>

    <form action="{{route('offline-booking-update')}}" method="post" id="subjectForm" name="userForm" class="form-horizontal">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="main_id_edit" id="main_id_edit">

        <div class="modal-body">

            <div class="form-group row">

                <div class="col-md-12">

                    <label for="exampleSelectd">Student Name <span class="text-danger">*</span></label>
                    <input type="text" autocomplete="off" class="form-control" name="sname_edit" id="sname_edit">
                    <span class="title error_msg error" style="color: red;" id="name_error_edit">{{ $errors->booking_edit->first('sname_edit')}}</span>

                </div>

            </div>
            <div class="form-group row">

                <div class="col-md-12">

                    <label for="exampleSelectd">Subject <span class="text-danger">*</span></label>

                    <select class="form-control validate_field main_subject" name="main_subject_edit" id="main_subject_edit">

                        <option value="">Select Subject</option>

                        @foreach($subject as $val)
                        <option value="{{$val->id}}">{{$val->main_title}}</option>
                        @endforeach

                    </select>

                    <span class="title error_msg error" style="color: red;" id="subject_error_edit">{{ $errors->booking_edit->first('main_subject_edit')}}</span>

                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-12">

                    <label for="exampleSelectd">Level <span class="text-danger">*</span></label>

                    <select class="form-control validate_field main_subject" name="level_edit" id="level_edit">

                        <option value="">Select Level</option>

                        @foreach($level as $val)
                        <option value="{{$val->id}}">{{$val->title}}</option>
                        @endforeach

                    </select>

                    <span class="title error_msg error" style="color: red;" id="level_error_edit">{{ $errors->booking_edit->first('level_edit')}}</span>

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

                    <select class="form-control validate_field main_subject" name="day_edit" id="day_edit">

                        <option value="">Select Day</option>

                        @foreach($daysArr as $key=>$val)
                        <option value="{{$val}}">
                            {{$key}}
                        </option>
                        @endforeach

                    </select>

                    <span class="title error_msg error" style="color: red;" id="day_error_edit">{{ $errors->booking_edit->first('level_edit')}}</span>

                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-12">

                    <label for="exampleSelectd">Idel Time <span class="text-danger">*</span></label>

                    <input type="text" class="form-control" name="idel_time_edit" id="idel_time_edit">


                    <span class="idel_time error_msg error" style="color: red;" id="idel_time_error_edit">{{ $errors->booking_edit->first('idel_time_edit')}}</span>

                </div>

            </div>

        </div>

        <div class="modal-footer">

            <button type="submit" class="btn btn-primary" id="btn-update" title="Submit">Update

            </button>

            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" aria-hidden="true" title="Cancel">Cancel</button>

        </div>

    </form>

</div>

</div>

</div>
@endsection
@section('page-js')
<script src="{{asset('assets/plugins/custom/timepicker/bootstrap-timepicker.js')}}"></script>
<script>
    var _AJAX_LIST = "{{ route('tutor-offline-subject-ajax') }}";

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
    $('#idel_time').timepicker({
        defaultTIme: false
    });
    $('#idel_time_edit').timepicker({
        defaultTIme: false
    });
    ajaxList(1);
    $('#btn-save').click(function(e) {
        var name = $('#main_subject').val();
        var studentName = $('#sname').val();
        var level = $('#level').val();
        var day = $('#day').val();
        var idelTime = $('#idel_time').val();
        var cnt = 0;
        $('#name_error').html("");
        $('#subject_error').html("");
        $('#level_error').html("");
        $('#day_error').html("");
        $('#idel_time_error').html("");
        if (studentName == '') {
            $('#name_error').html("Student Name is required");
            cnt = 1;
        }
        if (name == '') {
            $('#subject_error').html("Subject is required");
            cnt = 1;
        }
        if (level == '') {
            $('#level_error').html("Level is required");
            cnt = 1;
        }
        if (day == '') {
            $('#day_error').html("Day is required");
            cnt = 1;
        }
        if (idelTime == '') {
            $('#idel_time_error').html("Ideltime is required");
            cnt = 1;
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    })

    $('#btn-update').click(function(e) {
        var name = $('#main_subject_edit').val();
        var studentName = $('#sname_edit').val();
        var level = $('#level_edit').val();
        var day = $('#day_edit').val();
        var idelTime = $('#idel_time_edit').val();
        var cnt = 0;
        $('#name_error_edit').html("");
        $('#subject_error_edit').html("");
        $('#level_error_edit').html("");
        $('#day_error_edit').html("");
        $('#idel_time_error_edit').html("");
        if (studentName == '') {
            $('#name_error_edit').html("Student Name is required");
            cnt = 1;
        }
        if (name == '') {
            $('#subject_error_edit').html("Subject is required");
            cnt = 1;
        }
        if (level == '') {
            $('#level_error_edit').html("Level is required");
            cnt = 1;
        }
        if (day == '') {
            $('#day_error_edit').html("Day is required");
            cnt = 1;
        }
        if (idelTime == '') {
            $('#idel_time_error_edit').html("Ideltime is required");
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
                url: "{{ url('tutor-offline-booking-edit') }}/" + id,
                type: "GET",
                success: function(res) {
                    var val = JSON.parse(res);
                    $("#main_subject_edit").find("option[value=" + val.subject_id + "]").attr('selected', true);
                    $("#level_edit").find("option[value=" + val.level_id + "]").attr('selected', true);
                    $("#day_edit").find("option[value=" + val.tuition_day + "]").attr('selected', true);
                    $("#sname_edit").val(val.userName);
                    $("#main_id_edit").val(val.id);
                    $("#idel_time_edit").val(val.teaching_start_time);
                }
            });

        }
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
                url: "{{ url('tutor-offline-booking-edit') }}/" + edit,
                type: "GET",
                success: function(response) {
                    var val = JSON.parse(response);
                    $("#main_subject_edit").find("option[value=" + val.subject_id + "]").attr('selected', true);
                    $("#level_edit").find("option[value=" + val.level_id + "]").attr('selected', true);
                    $("#day_edit").find("option[value=" + val.tuition_day + "]").attr('selected', true);
                    $("#sname_edit").val(val.userName);
                    $("#idel_time_edit").val(val.teaching_start_time);
                }
            });
            $('#editajax-crud-modal').modal('show');
        <?php } ?>
    });

    $('body').on('click', '.pagination a', function(event) {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
        var myurl = $(this).attr('href');
        var page = $(this).attr('href').split('page=')[1];
        ajaxList(page);
    });
</script>
@endsection