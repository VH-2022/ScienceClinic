@extends('layouts.master')

@section('content')
@section('page-css')
<link rel="stylesheet" href="{{asset('front/main.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" /> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" /> -->
<meta name="csrf-token" content="{{ csrf_token() }}">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

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
            displayEventTime: true,
            allDaySlot: false,
            html: true,
            dateClick: function(info) {
                // alert('clicked ' + info.dateStr);
                // $(this).css('background-color', 'red');
                // alert('selected ' + info.dateStr);

                // alert(info.dateStr);
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are You Sure Want to Book This Slot !',
                    buttons: {
                        confirm: function() {
                            $.ajax({
                                url: "{{route('add-tutor-availability')}}",
                                type: 'POST',
                                data: {
                                    date: info.dateStr,
                                    tutor_id: tutorId,
                                },
                                success: function(result) {

                                    toastr.success(result.error_msg);
                                    getAjaxData();
                                    // calendar.fullCalendar('renderEvent', {
                                    //     icon: "<i class='fa fa-click'></i>",
                                    // }, true);
                                    // calendar.fullCalendar('unselect');
                                    // eventRender: function(result, element) {
                                    //     if (event.icon) {
                                    //         result.find(".fc-title").prepend("<i class='fa fa-" + result.icon + "'></i>");
                                    //     }
                                    // }
                                }
                            });
                        },
                        cancel: function() {

                        },
                    }
                });
            },
            
        });
        calendar.render();

    });

    function getAjaxData() {
        
    
            $.ajax({
                url: "{{route('add-tutor-availability-data')}}",
                type: 'get',
                success: function(result) {

                }
            });
        
        }
        // document.addEventListener('DOMContentLoaded', function() {
        //     var calendarEl = document.getElementById('calendar');

        //     var calendar = new FullCalendar.Calendar(calendarEl, {
        //         headerToolbar: {
        //             left: 'prev,next',
        //             center: 'title',
        //             right: ''
        //         },
        //         contentHeight: 450,
        //         selectable: true,
        //         editable: true,
        //         initialView: 'timeGridWeek',
        //         slotDuration: '01:00',
        //         displayEventTime: true,
        //         allDaySlot: false,
        //         dateClick: function(info) {
        //             alert('clicked ' + info.dateStr);
        //             // alert(info.dateStr);
        //             $(this).css('background-color', 'red');
        //         },
        //         // selectOverlap: function(event) {
        //         //     return event.rendering === $(this).css('background-color', 'red');
        //         // },

        //         eventContent: {
        //             html: '<i class="fa-solid fa-check"></i>'
        //         },


        //     });

        //     calendar.render();
        // });

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