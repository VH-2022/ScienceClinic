@extends('layouts.master')

@section('content')
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

                            <h3 class="card-label font-weight-bolder text-dark">Booked Slot Details</h3>

                        </div>


                    </div>

                    <div class="card-body">

                        <table class="table table-separate table-head-custom">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Parent Name</th>
                                    <th>Subject Name</th>
                                    <th>Booked Time</th>
                                    <th>Day</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $temp = 1; @endphp
                                @foreach($bookslots as $val)


                                <tr>
                                    <td>{{$temp}}</td>

                                    <td>{{$val->userDetails->first_name}} {{$val->userDetails->last_name}}</td>

                                    <td>{{$val->subjectDetails->main_title}}</td>

                                    <td>{{$val->tuition_time}}</td>

                                    <td>{{$val->tuition_day}}</td>
                                    <td>
                                        <a onclick="editslot('{{$val->id}}','{{$val->tuition_time}}','{{$val->user_id}}');" class="btn btn-info btn-sm">Edit Bookings</a>
                                        <a class=" btn btn-danger btn-sm" onclick="deleteslot('{{$val->id}}');">Cancel Booking</a>
                                    </td>

                                </tr>
                                @php $temp++; @endphp
                                @endforeach
                            </tbody>
                        </table>

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
<script>
    function editslot(id,time, userId) {

        var dayArr = {
            'Monday': 'monday',
            'Tuesday': 'tuesday',
            'Wednesday': 'wednesday',
            'Thursday': 'thursday',
            'Friday': 'friday',
            'Saturday': 'saturday',
            'Sunday': 'sunday'
        };
        var timeArr = {
            '8am- 9am': '08:00:00-09:00:00',
            '9am- 10am': '09:00:00-10:00:00',
            '10am- 11am': '10:00:00-11:00:00',

        }

        $.ajax({
            url: "{{route('edit-book-slot')}}",
            type: 'get',
            data: {
                'time': time,
                'id': id
            },
            success: function(result) {
                console.log(result);
                var html_res = '';
                $.each(dayArr, function(key, value) {
                    var selectedVal = result.tuition_day == value ? 'selected' : '';
                    html_res += '<option value="' + value + '" ' + selectedVal + ' >' + key + '</option>';
                });

                var html_time = '';
                $.each(timeArr, function(key, value) {
                    var selectedVal = result.tuition_time == value ? 'selected' : '';
                    html_time += '<option value="' + value + '" ' + selectedVal + ' >' + key + '</option>';
                });
                $.confirm({
                    title: 'Edit Bookings',
                    content: '' +
                        '<form id="editslotbook" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Select Day</label>' +
                        '<select class="form-control" id="day">' +
                        '<option value="">Please Select Day</option>' + html_res +
                        '</select>' +
                        '<span class="text-danger" id="day_error"></span>' +
                        '</div>' +
                        '<input type="hidden" id="user_id" value="' + userId + '">' +
                        '<div class="form-group">' +
                        '<label>Select Time</label>' +
                        '<select class="form-control" id="time">' +
                        '<option value="">Please Select Time</option>' + html_time +
                        '</select>' +
                        '<span class="text-danger" id="time_error"></span>' +
                        '</div>' +
                        '</form>',

                    buttons: {
                        formSubmit: {
                            text: 'Submit',
                            btnClass: 'btn-blue',
                            action: function() {
                                var day = $('#day').val();
                                var time = $('#time').val();
                                var temp = 0;

                                if (day == '') {
                                    $('#day_error').html('Please Select Day');
                                    temp++;
                                }
                                if (time == '') {
                                    $('#time_error').html('Please Select Time');
                                    temp++;
                                }

                                if (temp == 0) {
                                    $.ajax({
                                        url: "{{route('update-book-slot')}}",
                                        type: 'post',
                                        data: {
                                            'time': time,
                                            'id': id,
                                            'day': day,
                                            '_token': '{{csrf_token()}}'
                                        },
                                        success: function(result) {
                                            toastr.success(result.error_msg);
                                            location.reload();
                                        }
                                    })
                                } else {
                                    return false;
                                }
                            }
                        },
                        cancel: function() {},
                    },
                    onContentReady: function() {
                        var jc = this;
                        this.$content.find('form').on('submit', function(e) {

                            e.preventDefault();
                            jc.$$formSubmit.trigger('click');
                        });
                    }
                });

            }
        })
    }

    function deleteslot(userId) {
        $.confirm({
            title: 'Cancel Booking!',
            content: 'you want to cancel this booking?',
            buttons: {
                confirm: function() {
                    $.ajax({
                        url: "{{ url('cancel-slot') }}",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            userId: userId
                        },
                        success: function(response) {
                            if (response.status == '1') {
                                toastr.success(response.error_msg);
                                window.location.href = '{{url("tutor-availability")}}';
                            } else {
                                toastr.error(response.error_msg);
                            }

                        }
                    });
                },
                cancel: function() {}
            }
        });

    }
</script>
@endsection