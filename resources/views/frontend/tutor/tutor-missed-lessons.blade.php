@extends('layouts.master')

@section('content')

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
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="payment-tab" data-toggle="pill" href="javascript:void(0)" onclick="window.location.href='tutor-availability'" role="tab" aria-controls="pills-home" aria-selected="true">My Avalibility</a>
                            </li>
                            <li class="nav-item active" role="presentation">
                                <a class="nav-link active" id="missed-lesson-tab" data-toggle="pill" href="javascript:void(0)" role="tab" aria-controls="pills-home" aria-selected="true">Missed Lessons</a>
                            </li>
                            <input type="hidden" value="{{Auth::user()->id}}" id="tutor_id">
                        </ul>

                        <div class="tab-pane fade show active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="prime-container">
                                <h3>Missed Lessons</h3>
                                <br></br>
                                <div class="main-custom-calendar">
                                    <div id="missed-lesson"></div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>


    </div>



</div>

<!-- Add Reason -->
<div class="modal fade" id="reason-ajax-crud-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="reason-modal">Add a Reason</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form method="post" id="reasonForm" name="reasonForm" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="reasonid" id="reason_id">

                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="exampleSelectd">Reason <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control validate_field" placeholder="Enter Reason" name="reason" id="reason"></textarea>
                            <span class="title error_msg error" style="color: red;" id="reason_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-reason-save" title="Submit">Submit</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" aria-hidden="true" title="Cancel">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Reason -->

@endsection
@section('page-js')
<script>
    var _AJAX_LIST = "{{ route('tutor-missed-lesson-ajax') }}";

    function ajaxList(page) {
        $('.ki-close').click();
        $.ajax({
            type: "GET",
            url: _AJAX_LIST,
            data: {
                'page': page,
            },
            success: function(res) {
                $('#missed-lesson').html("");
                $('#missed-lesson').html(res);
            }

        })
    }

    function addReason(id) {
        $('#reason-ajax-crud-modal').modal('show');
        $('#reason_id').val(id);
    }
    $('#btn-reason-save').click(function() {
        var reason = $('#reason').val();
        var id = $('#reason_id').val();
        var cnt = 0;
        $('#reason_error').html("");
        if (reason.trim() == '') {
            $('#reason_error').html("Reason is required");
            cnt = 1;
        }
        $.ajax({
            async: false,
            global: false,
            url: "{{ route('add-missed-lesson-reason') }}",
            type: "POST",
            data: {
                reason: reason,
                id: id,
                _token: "{{csrf_token()}}"
            },
            success: function(response) {
                if (response.status == 1) {
                    toastr.success(response.success_msg);
                    $('#reason-ajax-crud-modal').modal('hide');
                    ajaxList(1);
                } else {
                    toastr.error(response.success_msg);
                    $('#reason-ajax-crud-modal').modal('show');
                }
            }

        });
    });
    function showReason(id){
        var htmls = $('#desc'+id).html();
        $.dialog({
            title: 'Description',
            content: htmls,
        });
    }
    ajaxList(1);
</script>
@endsection