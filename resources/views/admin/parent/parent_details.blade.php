@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/jquery-confirmation/css/jquery-confirm.min.css') }}">

<div class="d-flex flex-column-fluid">

    <div class="container-fluid">

        <div class="d-flex flex-row">

            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom gutter-b">

                    <div class="card-header">

                        <div class="card-title">

                            <span class="nav-profile-name">Parent Detail</span>

                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>

                        </div>

                        <div class="card-toolbar">



                            @if($parents->status == '' || $parents->status == 'Pending')
                            <a href="javascript:void(0);" class="btn btn-success mr-2 accepted_id" onclick="changeStatus('Accepted',{{$parents->id}})" @if($parents->status=="Accepted") style="display:none" @endif>Accept</a>

                            <a href="javascript:void(0);" class="btn btn-danger mr-2 rejected_id" onclick="changeStatus('Rejected',{{$parents->id}})" @if($parents->status=="Rejected") style="display:none" @endif>Reject</a>
                            @endif
                        </div>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>Full Name : </strong>&nbsp;

                                    {{ $parents->first_name }} {{ $parents->last_name }}

                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>Email : </strong>&nbsp; {{ $parents->email }}

                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>Mobile No : </strong>&nbsp;

                                    {{ $parents->mobile_id }}

                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                <strong class="address-title">Address : </strong>&nbsp;

                                <span class="address-text">{{ $parents->address1 }}</span>

                                </div>

                            </div>







                            <div class="col-lg-4">

                                <strong>Status : </strong>&nbsp; <span id="status_id">@if($parents->status =='Pending') <span class="badge badge-primary">Pending</span> @elseif($parents->status =='Accepted') <span class="badge badge-success">Accepted</span> @else <span class="badge badge-danger">Rejected</span> @endif</span>



                            </div>




                        </div>

                    </div>

                </div>



                <!--begin::Header-->

                <div class="card card-custom">

                    <div class="card-header">

                        <div class="card-title tutor">

                            <ul class="nav nav-pills nav-fill">

                                <li class="nav-item">

                                    <a class="nav-link active" onclick="inquiryDetails(1)" href="#university" data-toggle="tab">

                                        <span class="nav-text">Inquiry Details</span>

                                    </a>

                                </li>
                                <li class="nav-item">

                                    <a class="nav-link"  href="{{url('calander-booking?id=')}}{{$parents->id}}" >

                                        <span class="nav-text">Booking</span>

                                    </a>

                                </li>





                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="tabs">
                        <div class="tab-pane active" id="parentinquiry">
                            <span id="responsive_id"></span>
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

<div class="modal fade title-edit" id="editajax-crud-modal" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Edit Book Lesson</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <i aria-hidden="true" class="ki ki-close"></i>

                    </button>

                </div>
                @php $daysArr = [ 'Monday' =>'monday',
                                                    'Tuesday' => 'tuesday',
                                                    'Wednesday' => 'wednesday',
                                                    'Thursday' => 'thursday',
                                                    'Friday' => 'friday',
                                                    'Saturday' => 'saturday',
                                                    'Sunday' => 'sunday'] @endphp

                <form id="editLesson" name="editLesson" class="form-horizontal" Method="POST">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-body">

                        <input type="hidden" name="lesson_id" id="lesson_edit">

                        <div class="form-group row">

                            <label for="name" class="col-md-4 col-form-label">Day of Tuition<span

                                    class="text-danger">*</span></label>

                            <div class="col-md-12">
                            <select name="days"  class="form-control" id="days">
                                <option value="">Select Days</option>
                                @foreach($daysArr as $key=>$val)
                                <option value="{{$val}}">
                                    {{$key}}
                                </option>
                                @endforeach
                            </select>
                                

                                <span class="title error_msg error" id="title_error"></span>

                            </div>

                        </div>
                        <div class="form-group row">

                            <label for="name" class="col-md-4 col-form-label">Ideal Tuition Time<span

                                    class="text-danger">*</span></label>

                            <div class="col-md-12">
                            <select name="tuition_time"  class="form-control" id="time">
                                <option value="">Select Time</option>
                                <option value="08:00:00-09:00:00">
                                    8am- 9am
                                </option>
                                <option value="09:00:00-10:00:00">
                                    9am - 10am
                                </option>
                                <option value="10:00:00-11:00:00">
                                    10am - 11am
                                </option>
                            </select>
                                

                                <span class="title error_msg error" id="error_time"></span>

                            </div>

                        </div>
                        

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" id="btn-update" value="update" title="Update">Update

                        </button>

                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" aria-hidden="true"

                            title="Cancel">Cancel</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection

@section('page-js')

<script src="{{ asset('assets/js/pages/jquery-confirmation/js/jquery-confirm.min.js') }}"></script>

<script>
   
    function inquiryDetails(page) {
        var parentStatus = '{{$parents->status}}';
        $.ajax({

            type: "GET",

            url: "{{ route('tutor.inquiry') }}",

            data: {

                'tutor_id': '{{ $parents->id }}',
                'page': page,
                'parentStatus': parentStatus,

            },

            success: function(res) {

                $('#responsive_id').html("");

                $('#responsive_id').html(res);
                $("#calendar").css('display','none');
            }

        })

    }

    inquiryDetails(1);
</script>

<script>
    function changeStatus(status, id) {

        $.confirm({

            title: 'Are you sure?',

            columnClass: "col-md-6",



            content: "you want to change status?",

            buttons: {

                formSubmit: {

                    text: 'Submit',

                    btnClass: 'btn-primary',

                    action: function() {

                        $.ajax({

                            method: "GET",

                            url: "{{ route('changestatus') }}",

                            data: {





                                'id': id,

                                'status': status

                            }



                        }).done(function(r) {



                            toastr.success(r.error_msg);

                            $('.rejected_id').attr('style', 'display:block');

                            $('.accepted_id').attr('style', 'display:block');

                            if (r.data.status == "Accepted") {

                                var html_res = '<span class="badge badge-success">Accepted</span>';

                                $('.accepted_id').attr('style', 'display:none');
                                $('.rejected_id').attr('style', 'display:none');

                            } else {

                                var html_res = '<span class="badge badge-danger">Rejected</span>';
                                $('.accepted_id').attr('style', 'display:none');
                                $('.rejected_id').attr('style', 'display:none');

                            }


                            inquiryDetails(1);
                            $('#status_id').html(html_res);



                        }).fail(function() {

                            _self.setContent('Something went wrong. Contact Support.');

                            toastr.error('Sorry, something went wrong. Please try again.');

                        });



                    }

                },

                cancel: function() {

                    //close

                },

            },

            onContentReady: function() {

                // bind to events



            }

        });



    }

    function sendPaymentmail(id) {
        $.confirm({
            title: 'Are you sure?',
            columnClass: "col-md-6",
            content: "you want to book lesson?",
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-primary',
                    action: function() {
                        $.ajax({
                            method: "GET",
                            url: "{{ route('send-payment-link-parent') }}",
                            data: {
                                'id': id,
                            }
                        }).done(function(r) {
                            toastr.success('Payment mail are sending successfully. Please also check spam.');
                            inquiryDetails(1);
                        }).fail(function() {
                            toastr.error('Sorry, something went wrong. Please try again.');
                        });
                    }
                },
                cancel: function() {},
            },
            onContentReady: function() {}
        });
    }

    function editDetail(id) {

        if (id != "") {

            $.ajax({

                url: "{{url('getBooklesson?id=')}}"+id,

                type: "GET",

                success: function(res) {
                    var json = res.data[0];
                    $("#lesson_edit").val(json.id);

                    $('#days option[value='+json.tuition_day+']').attr('selected','selected');
                    $('#time option[value="'+json.tuition_time+'"]').attr('selected','selected');
                    $('#editajax-crud-modal').modal('show');
                }
            });
        }
    }

    $('#editLesson').submit(function (event) {
        event.preventDefault();

        var tuition_day = $('#days').val();
        var tuition_time = $('#time').val();

        var id = $('#level_id_edit').val();

        var cnt = 0;

        $('#title_error').html("");
        $('#error_time').html("");

        if (tuition_day.trim() == '') {

            $('#title_error').html("Day of Tuition is required");

            cnt = 1;

        }
    
        if (tuition_time.trim() == '') {

            $('#error_time').html("Ideal Tuition Time is required");

            cnt = 1;

        }

        if (cnt == 1) {

            return false;

        } else {

            var fornData = $('#editLesson')[0];

            var newform = new FormData(fornData);

            newform.append('_token', '{{ csrf_token() }}');





            $.ajax({

                type: "POST",

                url: '{{ url("update-book-lesson") }}',

                data: newform,

                processData: false,

                contentType: false,

                success: function(res) {

                    $('#editajax-crud-modal').modal('hide');
                    toastr.success(res.error_msg);
                    inquiryDetails(1);

                },

                error: function(data) {

                    toastr.error(data.error_msg);

                }

            });

        }

        });
</script>

@endsection