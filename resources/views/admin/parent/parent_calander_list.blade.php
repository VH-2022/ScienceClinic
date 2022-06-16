@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="{{asset('front/css/jquery-ui.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/fullcalender-css/main.min.css')}}">

<div class="d-flex flex-column-fluid">

    <div class="container-fluid">

        <div class="d-flex flex-row">

            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom gutter-b">

                    <div class="card-header">

                        <div class="card-title">

                            <span class="nav-profile-name">Parent Subject Booking Detail</span>

                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>

                        </div>

                        

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            
                        <div id='calendar'></div>

                        </div>

                    </div>

                </div>



               


                


            </div>

            <!--end::Subject List-->

        </div>

        <!--end::Container-->

    </div>

    <!--end::Card-->

</div>

<!--end::Container-->



@endsection

@section('page-js')
<script src="{{asset('assets/js/fullcalender-js/main.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var parentID = '{{$parent_id}}';
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            contentHeight: "auto",


            initialView: 'timeGridWeek',
            slotDuration: '01:00',
            displayEventTime: false,
            allDaySlot: false,
            html: true,

            
            events: function(fetchInfo, callback) {

                var events = [];
                $.ajax({
                    url: "{{route('parent-book-lesson-data')}}",
                    type: 'get',
                    data: {
                        parentID: parentID
                    },
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
    </script>
@endsection