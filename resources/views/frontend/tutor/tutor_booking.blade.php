@extends('layouts.master')

@section('content')
@section('page-css')
<link rel="stylesheet" href="{{asset('front/main.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/fullcalender-css/main.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/jquery-confirmation/css/jquery-confirm.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/font-awesome/all.min.css')}}" crossorigin="anonymous" referrerpolicy="no-referrer" />

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    body {
        background: #EEF0F8;
    }
</style>
@endsection

<div class="d-flex flex-column-fluid">



    <div class="container-fluid">



        <div class="d-flex flex-row">



            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom card-stretch">

                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Schedule Lessons</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-pills personaltab-ul" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="personal-info-tab" data-toggle="pill" href="#personal-info" role="tab" aria-controls="pills-home" aria-selected="true">My Bookings</a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="payment-tab" data-toggle="pill" href="javascript:void(0)" onclick="window.location.href='tutor-availability'" role="tab" aria-controls="pills-home" aria-selected="true">My Avalibility</a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="payment-tab" data-toggle="pill" href="javascript:void(0)" onclick="window.location.href='tutor-missed-lessons'" role="tab" aria-controls="pills-home" aria-selected="true">Missed Lessons</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="payment-tab" data-toggle="pill" href="javascript:void(0)" role="tab" onclick="window.location.href='tutor-offline-booking'" aria-controls="pills-home" aria-selected="true">Offline Booking</a>
                            </li>
                            <input type="hidden" value="{{Auth::user()->id}}" id="tutor_id">
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                                <div class="prime-container">
                                    <h3>My Bookings</h3>
                                    <br></br>
                                    <div class="main-custom-calendar">
                                        <div id="calendar"></div>

                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>

                </div>

            </div>


        </div>



    </div>



</div>


@endsection
@section('page-js')
<script src="{{asset('assets/js/fullcalender-js/main.min.js')}}"></script>
<script src="{{asset('assets/js/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/js/pages/jquery-confirmation/js/jquery-confirm.min.js')}}"></script>
<script src="{{asset('assets/js/font-awesome/all.min.js')}}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var calendar;
        var events = [];
        var calendarEl = document.getElementById('calendar');
        var tutorId = $('#tutor_id').val();

        calendar = new FullCalendar.Calendar(calendarEl, {

            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            contentHeight: 450,
            selectable: false,
            editable: false,
            initialView: 'timeGridWeek',
            slotDuration: '01:00',
            displayEventTime: false,
            allDaySlot: false,
            html: true,

            events: function(fetchInfo, callback) {

                var events = [];
                $.ajax({
                    url: "{{route('get-tutor-bookings')}}",
                    type: 'get',
                    success: function(result) {

                        if (!!result) {
                            $.map(result, function(r) {
                                var d = new Date();
                                var month = d.getMonth() + 1;
                                var day = d.getDate();
                                var output = d.getFullYear() + '-' +
                                    (('' + month).length < 2 ? '0' : '') + month + '-' +
                                    (('' + day).length < 2 ? '0' : '') + day;
                                var timeslot = r.tuition_time.split('-');
                                if (r.inquiry_type == "1") {
                                    var eventTitle = r.user_details.first_name + "\r" + r.subject_details.main_title;
                                    events.push({
                                        id: r.id,
                                        title: eventTitle,
                                        start: r.booking_date + ' ' + r.teaching_start_time,
                                        end: r.booking_date + ' ' + r.teaching_end_time,
                                        time: r.tuition_time,
                                        inquiry_type: r.inquiry_type
                                    })
                                } else {
                                    var eventTitle = r.user_name + "\r" + r.subject_details.main_title;
                                    events.push({
                                        id: r.id,
                                        title: eventTitle,
                                        start: r.booking_date + ' ' + r.teaching_start_time,
                                        end: r.booking_date + ' ' + r.teaching_end_time,
                                        time: r.tuition_time,
                                        backgroundColor: '#727272',
                                        borderColor: '#727272',
                                        inquiry_type: r.inquiry_type
                                    })
                                }
                            });
                        }
                        callback(events);
                    }
                })
            },
            eventClick: function(info) {
                var setTime = info.event.extendedProps.time;
                var userId = info.event.id;
                if(info.event.extendedProps.inquiry_type == 1){
                    window.location.href = '{{url("/show-bookslot-data/")}}' + '/' + userId + '/' + setTime;
                }
            },
        });
        calendar.render();

    });


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