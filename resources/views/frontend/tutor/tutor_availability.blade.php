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
                                <a class="nav-link" id="personal-info-tab" data-toggle="pill" href="javascript:void(0)" onclick="window.location.href='tutor-bookings'" role="tab" aria-controls="pills-home" aria-selected="true">My Bookings</a>
                            </li>
                            <li class="nav-item active" role="presentation">
                                <a class="nav-link active" id="payment-tab" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">My Avalibility</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="payment-tab" data-toggle="pill" href="javascript:void(0)" onclick="window.location.href='tutor-missed-lessons'" role="tab" aria-controls="pills-home" aria-selected="true">Missed Lessons</a>
                            </li>
                            <input type="hidden" value="{{Auth::user()->id}}" id="tutor_id">
                        </ul>

                        <div class="tab-pane fade show active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="prime-container">
                                <h3>My Avalibility</h3>
                                <br></br>
                                <div class="main-custom-calendar">
                                    <div id="calendar-new"></div>

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
        var calendarElNew = document.getElementById('calendar-new');
        var tutorId = $('#tutor_id').val();
        var calendarNew = new FullCalendar.Calendar(calendarElNew, {
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
                                    console.log(result);
                                    calendarNew.refetchEvents();
                                }
                            });
                        },
                        cancel: function() {},
                    }
                });
            },
            eventContent: {
                html: '<a><i class="fa fa-check"></i></a>'
            },
            events: function(fetchInfo, callback) {
                var events = [];

                $.ajax({
                    url: "{{route('get-tutor-availability')}}",
                    type: 'get',
                    success: function(result) {
                        if (!!result) {
                            $.map(result, function(r) {
                                events.push({
                                    start: r.available_datetime,
                                    title: 'Available',
                                    "textColor": "#ffffff"
                                })
                            });
                        }
                        callback(events);
                    }
                })
            },
        });

        calendarNew.render();
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