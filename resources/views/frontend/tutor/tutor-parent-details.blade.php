@extends('layouts.master')
<link href="//cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css
" rel="stylesheet">
<link href="{{ asset('assets/plugins/custom/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
<style>
    .bootstrap-timepicker-widget table td input {
        width: 33px !important;
    }

    .table {
        font-size: 13px !important;
    }
</style>
@section('content')
<div class="d-flex flex-column-fluid">

    <!--begin::Container-->

    <div class="container-fluid">

        <!--begin::Subject List-->

        <div class="d-flex flex-row">

            <!--begin::Content-->

            <div class="flex-row-fluid" id="personam_id">



                <!--begin::Header-->

                <div class="card card-custom gutter-b">

                    <div class="card-header">

                        <div class="card-title">

                            <span class="nav-profile-name">Parent Details</span>



                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>First Name: </strong>
                                    {{$parentData->first_name}}

                                </div>

                            </div>
                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>Last Name: </strong>
                                    {{$parentData->last_name}}

                                </div>

                            </div>


                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>Address1: </strong>
                                    {{$parentData->address1}}
                                </div>

                            </div>





                        </div>

                    </div>

                </div>



                <!--begin::Header-->

                <div class="card card-custom">

                    <div class="card-header">

                        <div class="card-title tutor">

                            <span class="nav-profile-name">Subject List</span>
                            <!-- <ul class="nav nav-pills nav-fill">

                                <li class="nav-item">

                                    <a class="nav-link active" onclick="addSubjectList()" href="#subjectlist" data-toggle="tab">
                                        <span class="nav-text">Subject List</span>
                                    </a>

                                </li>
                            </ul> -->

                        </div>

                    </div>
                    <div class="tab-content" id="tabs">

                        <div class="tab-pane active" id="subjectlist">

                            <span id="responsive_id"></span>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script src="{{asset('assets/plugins/custom/timepicker/bootstrap-timepicker.js')}}"></script>
<script>
    $(document).ready(function() {
        addSubjectList();
    });

    function addSubjectList() {
        var parentID = "{{$parentData->id}}";
        $.ajax({

            type: "GET",

            url: "{{ route('parent-subject-details') }}",

            data: {
                parentID: parentID,
            },

            success: function(res) {

                $('#responsive_id').html("");

                $('#responsive_id').html(res);

            }

        })
    }


    function attendClass(id, subjectId, teachingType) {
        $.confirm({
            title: 'Are you sure?',
            columnClass: "col-md-6",
            content: "you want to attend this class?",
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-danger',
                    action: function() {
                        $.ajax({
                            type: "post",
                            url: "{{ route('attend-lesson-subject') }}",
                            data: {
                                'id': id,
                                'subjectId': subjectId,
                                'teachingType': teachingType,
                                "_token": "{{ csrf_token() }}"
                            },

                            success: function(res) {
                                if (res.status == 1) {
                                    toastr.success(res.error_msg);
                                    addSubjectList(1);
                                } else {
                                    toastr.error(res.error_msg);
                                }
                            }

                        });
                    }
                },
                cancel: function() {},
            },
            onContentReady: function() {}
        });
    }

    function addTeachingHours(id) {
        $.ajax({
            async: false,
            global: false,
            url: "{{ url('get-online-tutoring-data') }}",
            type: "GET",
            success: function(response) {
                var val = JSON.parse(response);
                var html_res = '';
                html_res += '<option value="">Select</option>';
                $.each(val, function(k, v) {
                    html_res += '<option value="' + v.id + '">' + v.online_tutoring_name + '</option>';
                });
                $.confirm({
                    title: 'Add Teaching Hours',
                    content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Enter Teaching Hours <span class="text-danger">*</span></label>' +
                        '<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" maxlength="3" name="teaching_hours" id="teaching_hours" placeholder="Enter Teaching Hours" class="hours form-control number-only" required />' +
                        '<span class="text-danger" id="error_hours"></span>' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label>Enter Hourly Rate <span class="text-danger">*</span></label>' +
                        '<input type="number" name="hourly_rate" id="hourly_rate" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" maxlength="3" placeholder="Enter Hourly Rate" class="hours form-control number-only" required />' +
                        '<span class="text-danger" id="error_hourly_rate"></span>' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label>Enter Teaching Start Time <span class="text-danger">*</span></label>' +
                        '<input type="text" name="teaching_start_time" id="teaching_start_time" placeholder="Enter Teaching Start Time" class="form-control" required />' +
                        '<span class="text-danger" id="error_teaching_start_time"></span>' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label>Select Teaching Type <span class="text-danger">*</span></label>' +
                        '<select class="form-control validate_field" name="teching-type" id="teaching_type">' + html_res + '</select>' +
                        '<span class="text-danger" id="error_teaching_type"></span>' +
                        '</div>' +
                        '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Submit',
                            btnClass: 'btn-blue',
                            action: function() {
                                var hours = $("#teaching_hours").val();
                                var hourly_rate = $("#hourly_rate").val();
                                var teaching_start_time = $("#teaching_start_time").val();
                                var teaching_type = $("#teaching_type").val();
                                var tutionTime = $('#desc' + id).html();
                                var time = tutionTime.split('-');
                                var startTime = time[0];
                                var endTime = time[1];
                                var teachingTime = moment(teaching_start_time, "h:mm:ss A").format("HH:mm:ss");
                                var startTimeVal = moment(startTime, "h:mm:ss A").format("HH:mm:ss");
                                var endTimeVal = moment(endTime, "h:mm:ss A").format("HH:mm:ss");
                                var format = 'hh:mm:ss';
                                var time = moment(teachingTime, format),
                                    beforeTime = moment(startTimeVal, format),
                                    afterTime = moment(endTimeVal, format);
                                var minutes = hours.split('.');
                                var temp = 0;
                                $('#error_hours').html("");
                                $('#error_hourly_rate').html("");
                                $('#error_teaching_start_time').html("");
                                $('#error_teaching_type').html("");
                                if (hours.trim() == '') {
                                    $('#error_hours').html("Please enter Teaching Hours");
                                    temp++;
                                } else {
                                    if (minutes[1] > 59) {
                                        $('#error_hours').html("Please enter valid Teaching Hours");
                                        temp++;
                                    }
                                }
                                if (hourly_rate.trim() == '') {
                                    $('#error_hourly_rate').html("Please enter Hourly Rates");
                                    temp++;
                                }
                                if (teaching_start_time.trim() == '') {
                                    $('#error_teaching_start_time').html("Please enter Teaching Start Time");
                                    temp++;
                                }
                                else if ((!time.isBetween(beforeTime, afterTime)) && (!time.isSame(beforeTime)) && (!time.isSame(afterTime))) {
                                    $('#error_teaching_start_time').html("Please enter Teaching Start Time Between " + startTime + " & " + endTime);
                                    temp++;
                                }
                                if (teaching_type == '') {
                                    $('#error_teaching_type').html("Please select Teaching Type");
                                    temp++;
                                }
                                if (temp == 0) {
                                    $.ajax({
                                        type: "post",
                                        url: "{{ route('add-teaching-hours') }}",
                                        data: {
                                            'id': id,
                                            'hours': minutes[0],
                                            'minutes':minutes[1],
                                            'hourly_rate': hourly_rate,
                                            'teaching_start_time': teaching_start_time,
                                            'teaching_type': teaching_type,
                                            "_token": "{{ csrf_token() }}"
                                        },

                                        success: function(res) {
                                            if (res.status == 1) {
                                                toastr.success(res.error_msg);
                                                addSubjectList(1);
                                            } else {
                                                toastr.error(res.error_msg);
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            var tempVal = 0;
                                            if (jqXHR.responseJSON.error_msg.hours[0]) {
                                                $('#error_hours').html(jqXHR.responseJSON.error_msg.hours[0]);
                                                tempVal++;
                                            } else {
                                                $('#error_hours').html('');
                                            }
                                            if (jqXHR.responseJSON.error_msg.hourly_rate[0]) {
                                                $('#error_hourly_rate').html(jqXHR.responseJSON.error_msg.hourly_rate[0]);
                                                tempVal++;
                                            } else {
                                                $('#error_hourly_rate').html('');
                                            }
                                            if (jqXHR.responseJSON.error_msg.teaching_type[0]) {
                                                $('#error_teaching_type').html(jqXHR.responseJSON.error_msg.teaching_type[0]);
                                                tempVal++;
                                            } else {
                                                $('#error_teaching_type').html('');
                                            }
                                            if (tempVal == 1) {
                                                return false;
                                            }
                                        }

                                    });
                                } else {
                                    return false;
                                }


                            }
                        },
                        cancel: function() {

                        },
                    },
                    onContentReady: function() {

                        var jc = this;
                        this.$content.find('form').on('submit', function(e) {

                            e.preventDefault();
                            jc.$$formSubmit.trigger('click');
                        });
                        $('#teaching_start_time').timepicker({
                            defaultTIme: false
                        });
                    }
                });
            }
        });
    }
</script>

@endsection