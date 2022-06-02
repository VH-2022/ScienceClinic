@extends('layouts.master')

@section('content')
@section('page-css')
<link rel="stylesheet" href="{{asset('front/main.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">
@endsection

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
                            <h3 class="card-label font-weight-bolder text-dark">Schedule Lessons</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-pills personaltab-ul" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="personal-info-tab" data-toggle="pill" href="#personal-info" role="tab" aria-controls="pills-home" aria-selected="true">My Bookings</a>
                            </li>


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
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            contentHeight: 450,
            selectable: true,
            allDaySlot: false,
            initialView: 'timeGridWeek',
            slotDuration: '01:00',
            displayEventTime: true,
            dateClick: function(info) {
                alert('clicked ' + info.dateStr);
                // $(this).css('background-color', 'red');
            },

            events: [

                {
                    title: 'Booked',
                    start: '2022-03-27T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-28T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-29T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-30T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-30T02:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-03-29T01:00:00',
                    classNames: 'event-no-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-03-29T02:00:00',
                    classNames: 'event-no-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-03-31T03:00:00',
                    classNames: 'event-no-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-04-01T03:00:00',
                    classNames: 'event-no-book-label',
                }

            ],

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