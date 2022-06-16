@extends('layouts.master')
@section('content')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/css/fullcalender-css/main.min.css')}}">

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

                            <input type="hidden" value="{{Auth::user()->id}}" id="tutor_id">
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                                <div class="prime-container">
                                    <h3>My Bookings</h3>
                                    <br></br>
                                    <div class="main-custom-calendar">
                                        <div id='calendar'></div>
                                        <div id='calendar1'></div>
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
    var today = moment();
    
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
            selectable: false,
            editable: false,
            slotMinTime: "00:00:00",
            slotMaxTime: "24:00:00",
            initialView: 'timeGridWeek',
            slotDuration: '01:00',

            displayEventTime: false,
            allDaySlot: false,
            html: true,
          
        
            events: function(fetchInfo, callback) {

                var events = [];
                $.ajax({
                    url: "{{route('add-tutor-availability-data')}}",
                    type: 'get',
                    success: function(result) {

                        if (!!result) {
                            $.map(result, function(r) {

                                var d = new Date();
                                var month = d.getMonth()+1;
                                var day = d.getDate();
                                var output = d.getFullYear() + '-' +
                                    ((''+month).length<2 ? '0' : '') + month + '-' +
                                    ((''+day).length<2 ? '0' : '') + day;
                                var timeslot = r.tuition_time.split('-');
                                var eventTitle = r.subject_details.main_title+"\r"+r.tutor_details.first_name;
                                events.push({
                                    title: eventTitle,
                                    start: output+' '+timeslot[0],
                                    end: output+' '+timeslot[1],
                                })


                            });
                        }
                        callback(events);
                    }
                })


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