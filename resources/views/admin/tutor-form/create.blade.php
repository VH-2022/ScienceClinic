@extends('layouts.master')

@section('content')

<style>
    .card-header {
        border-bottom: 0 !important;
    }

    .error {
        color: red;
    }

    .card-custom {
        padding: 20px 0;
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

                            <h3 class="card-label font-weight-bolder text-dark">Add Tutor Form</h3>

                        </div>

                    </div>



                    <form class="form" id="submitid" method="post" action="{{route('tutor-form.store')}}">

                        @csrf

                        <div class="card-body py-0">



                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Tutor Name <span class="text-danger">*</span></label>

                                        <input class="form-control validate_field" placeholder="Enter Tutor Name" autocomplete="off" id="tutor-name" type="text" data-msg="Tutor Name" name="tutor-name" maxlength="100">

                                        <span class="form-text error tutor_name_error">{{ $errors->useredit->first('tutor-name')}}</span>

                                    </div>
                                    @php $daysArr = [ 'Monday' =>'monday',
                                    'Tuesday' => 'tuesday',
                                    'Wednesday' => 'wednesday',
                                    'Thursday' => 'thursday',
                                    'Friday' => 'friday',
                                    'Saturday' => 'saturday',
                                    'Sunday' => 'sunday'] @endphp
                                    <div class="form-group">

                                        <label>Day Of Tuition <span class="text-danger">*</span></label>
                                        <select name="tuition_day" id="tuition_day" class="form-control validate_field">
                                            <option value="">Please Select Day</option>
                                            @foreach($daysArr as $key=>$val)
                                            <option value="{{$val}}">
                                                {{$key}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="form-text error tuition_day_error">{{ $errors->useredit->first('tuition_day')}}</span>

                                    </div>
                                    <div class="form-group">

                                        <label>Rate</label>

                                        <input class="form-control validate_field" placeholder="Enter Rate" maxlength="5" onkeypress="return isNumber(event)" autocomplete="off" id="rate" type="text" data-msg="Student Name" name="rate">

                                        <span class="form-text error rate_error">{{ $errors->useredit->first('rate')}}</span>

                                    </div>
                                    @php
                                    $month = array(
                                    '01' => 'January',
                                    '02' => 'February',
                                    '03' => 'March',
                                    '04' => 'April',
                                    '05' => 'May',
                                    '06' => 'June',
                                    '07' => 'July',
                                    '08' => 'August',
                                    '09' => 'September',
                                    '10' => 'October',
                                    '11' => 'November',
                                    '12' => 'December',
                                    );
                                    @endphp
                                    <div class="form-group">

                                        <label>Month</label>

                                        <select name="month" id="month" class="form-control validate_field">
                                            <option value="">Please Select Month</option>
                                            @foreach($month as $key => $val)
                                            <option value="{{$key}}">{{$val}}</option>
                                            @endforeach
                                        </select>

                                        <span class="form-text error month_error">{{ $errors->useredit->first('month')}}</span>

                                    </div>


                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Student Name</label>

                                        <input class="form-control validate_field" placeholder="Enter Student Name" autocomplete="off" id="student_name" type="text" data-msg="Student Name" name="student_name">

                                        <span class="form-text error student_name_error">{{ $errors->useredit->first('student_name')}}</span>

                                    </div>

                                    <div class="form-group">

                                        <label>Time</label>

                                        <select name="tuition_time" id="tuition_time" class="form-control validate_field">
                                            <option value="">Please Select Time</option>
                                            <option value="24:00:00-01:00:00">
                                                12am- 1am
                                            </option>
                                            <option value="01:00:00-02:00:00">
                                                1am - 2am
                                            </option>
                                            <option value="02:00:00-03:00:00">
                                                2am - 3am
                                            </option>
                                            <option value="03:00:00-04:00:00">
                                                3am - 4am
                                            </option>
                                            <option value="04:00:00-05:00:00">
                                                4am - 5am
                                            </option>
                                            <option value="05:00:00-06:00:00">
                                                5am - 6am
                                            </option>
                                            <option value="06:00:00-07:00:00">
                                                6am - 7am
                                            </option>
                                            <option value="07:00:00-08:00:00">
                                                7am - 8am
                                            </option>
                                            <option value="08:00:00-09:00:00">
                                                8am - 9am
                                            </option>
                                            <option value="09:00:00-10:00:00">
                                                9am - 10am
                                            </option>
                                            <option value="10:00:00-11:00:00">
                                                10am - 11am
                                            </option>
                                            <option value="11:00:00-12:00:00">
                                                11am - 12pm
                                            </option>
                                            <option value="12:00:00-13:00:00">
                                                12pm - 1pm
                                            </option>
                                            <option value="13:00:00-14:00:00">
                                                1pm - 2pm
                                            </option>
                                            <option value="14:00:00-15:00:00">
                                                2pm - 3pm
                                            </option>
                                            <option value="15:00:00-16:00:00">
                                                3pm - 4pm
                                            </option>
                                            <option value="16:00:00-17:00:00">
                                                4pm - 5pm
                                            </option>
                                            <option value="17:00:00-18:00:00">
                                                5pm - 6pm
                                            </option>
                                            <option value="18:00:00-19:00:00">
                                                6pm - 7pm
                                            </option>
                                            <option value="19:00:00-20:00:00">
                                                7pm - 8pm
                                            </option>
                                            <option value="20:00:00-21:00:00">
                                                8pm - 9pm
                                            </option>
                                            <option value="21:00:00-22:00:00">
                                                9pm - 10pm
                                            </option>
                                            <option value="22:00:00-23:00:00">
                                                10pm - 11pm
                                            </option>
                                            <option value="23:00:00-24:00:00">
                                                11pm - 12am
                                            </option>
                                        </select>

                                        <span class="form-text error tuition_time_error">{{ $errors->useredit->first('tuition_time')}}</span>

                                    </div>


                                    <div class="form-group">

                                        <label>Commission</label>

                                        <input class="form-control validate_field" placeholder="Enter Commission" autocomplete="off" id="commission" onkeypress="return isNumber(event)" maxlength="2" type="text" data-msg="Student Name" name="commission">

                                        <span class="form-text error commission_error">{{ $errors->useredit->first('commission')}}</span>

                                    </div>

                                </div>


                            </div>

                            <div class="both-btn-form">
                                <button type="button" id="add_tutor_form" class="btn btn-primary mr-2" style="background-color:#3498db !important">Submit</button>
                                <a href="{{route('tutor-form.index')}}" class="btn btn-secondary">Cancel</a>

                            </div>
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
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode >
            31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    $('#add_tutor_form').click(function() {

        var tutorName = $('#tutor-name').val();
        var studentName = $('#student_name').val();
        var day = $('#tuition_day').val();
        var time = $('#tuition_time').val();
        var rate = $('#rate').val();
        var commission = $('#commission').val();
        var month = $('#month').val();
        var temp = 0;
        $('tutor_name_error').html("");
        $('.student_name_error').html("");
        $('.tuition_day_error').html("");
        $('.tuition_time_error').html("");
        $('.rate_error').html("");
        $('.month_error').html("");
        $('.commission_error').html("");

        if (tutorName.trim() == "") {
            $('.tutor_name_error').html("Please enter Tutor Name");
            temp++;
        }
        if (studentName.trim() == "") {
            $('.student_name_error').html("Please enter Student Name");
            temp++;
        }
        if (day == "") {
            $('.tuition_day_error').html("Please select Tuition Day");
            temp++;
        }
        if (time == "") {
            $('.tuition_time_error').html("Please select Tuition Time");
            temp++;
        }
        if (rate.trim() == "") {
            $('.rate_error').html("Please select Rate");
            temp++;
        }
        if (commission.trim() == "") {
            $('.commission_error').html("Please enter Commission");
            temp++;
        }
        if (month == "") {
            $('.month_error').html("Please select Month");
            temp++;
        }

        if (temp == 0) {
            $('#submitid').submit();
        } else {
            return false
        }

    });
</script>
@endsection