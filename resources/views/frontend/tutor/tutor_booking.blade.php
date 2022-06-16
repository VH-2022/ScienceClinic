@extends('layouts.master')

@section('content')
@section('page-css')
<link rel="stylesheet" href="{{asset('front/main.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/fullcalender-css/main.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/jquery-confirmation/css/jquery-confirm.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/font-awesome/all.min.css')}}" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
<style>

</style>
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
                                <a class="nav-link" id="payment-tab" data-toggle="pill" href="#payment" role="tab" aria-controls="pills-home" aria-selected="true">Payment</a>
                            </li>
                            <input type="hidden" value="{{Auth::user()->id}}" id="tutor_id">
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                                <div class="prime-container">
                                    <h3>My Bookings</h3>
                                    <br></br>
                                    <div class="main-custom-calendar">
                                        <div id='calendar'></div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                                <div>
                                    <p style="font-size: 18px;">For all lessons that take place this week, tutors will be paid on the following week friday as illustrated in the diagram below: </p>
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
<script src="{{asset('assets/js/font-awesome/all.min.js')}}" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });


    var calendar;
    var events = [];
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var tutorId = $('#tutor_id').val();

        calendar = new FullCalendar.Calendar(calendarEl, {

            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            contentHeight: 450,
            selectable: true,
            editable: true,
            initialView: 'timeGridWeek',
            slotDuration: '01:00',
            displayEventTime: false,
            allDaySlot: false,
            html: true,



/*


            dateClick: function(info, callback) {

                $.confirm({
                    title: 'Are You Sure ?',
                    content: 'Book This Slot !',
                    buttons: {
                        confirm: function() {
                            $.ajax({
                                url: "{{route('add-availability')}}",
                                type: 'POST',
                                data: {
                                    date: info.dateStr,
                                    tutor_id: tutorId,
                                },
                                success: function(result) {

                                    var allData = result.data.original;

                                    toastr.success(result.error_msg);
                                    var data = result.data.original;

                                    calendar.refetchEvents();


                                }
                            });
                        },
                        cancel: function() {

                        },
                    }
                });
            },
*/



            events: function(fetchInfo, callback) {

                var events = [];
                $.ajax({
                    url: "{{route('get-tutor-availability')}}",
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

                                var eventTitle = r.user_details.first_name + "\r" + r.subject_details.main_title;

                                events.push({
                                    id: r.id,
                                    title: eventTitle,
                                    start: output + ' ' + timeslot[0],
                                    end: output + ' ' + timeslot[1],
                                    time: r.tuition_time,

                                })

                            });
                        }
                        callback(events);
                    }
                })


            },
            eventClick: function(info) {
                var setTime = info.event.extendedProps.time;
                var userId = info.event.id;
                // alert(userId);
                window.location.href = '{{url("/show-bookslot-data/")}}' + '/' + userId + '/' + setTime;
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