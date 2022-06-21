@extends('layouts.master')

@section('content')
@section('page-css')
<link rel="stylesheet" href="{{asset('front/main.css')}}">
<link rel="stylesheet" href="{{asset('front/css/font-awesome.min.css')}}">
<style>
    .fc-event-main {
        float: middle;
        text-align: center;
    }

    .rate .half:before {
        content: "\f089 ";
        position: absolute;
        padding-right: 0;
    }

    .rate .half:before {
        content: "\f089 ";
        position: absolute;
        padding-right: 0;
    }

    .rate>label:before {
        display: inline-block;
        font-size: 2rem;
        padding: 0.3rem 0.2rem;
        margin: 0;
        cursor: pointer;
        font-family: FontAwesome;
        content: "\f005 ";
    }
</style>
@endsection

<div class="d-flex flex-column-fluid">

    <!--begin::Container-->

    <div class="container-fluid">

        <!--begin::Subject List-->

        <div class="d-flex flex-row">

            <!--begin::Content-->


            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom card-stretch">
                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Feedback Form</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="prime-container">
                            <form id="add-feedback" method="post">
                                @csrf
                                <div class="row row-spacing">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-control-spacing">
                                            <label for="example-text-input" class="form-label">
                                                Description</label> <span style="color:red" class="required-error">*</span>
                                            <textarea class="form-control placeholder2" id="description" name="description" autocomplete="off" placeholder="Description"></textarea>

                                            <span id="description_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="unique_id" id="unique_id" value="{{$unique_id}}">


                                    <div class="col-md-6 mb-3">
                                        <div class="form-control-spacing">
                                            <label for="example-text-input" class="form-label">
                                                Subject</label> <span style="color:red" class="required-error">*</span>
                                            <input type="text" class="form-control placeholder2" id="subject" name="subject" autocomplete="off" placeholder="Subject">
                                            <span id="subject_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-control-spacing">
                                            <label for="example-text-input" class="form-label">
                                                Outcome</label> <span style="color:red" class="required-error">*</span>
                                            <input type="text" class="form-control placeholder2" id="outcome" name="outcome" autocomplete="off" placeholder="Outcome">

                                            <span id="outcome_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <div class="stars-review">
                                            <div>
                                                <fieldset class="rate">
                                                    <input type="radio" id="rating10" name="rating" value="5" class="mb-0" /><label for="rating10" title="5 stars"></label>
                                                    <input type="radio" id="rating9" name="rating" value="4.5" /><label class="half" for="rating9" title="4.5 stars"></label>
                                                    <input type="radio" id="rating8" name="rating" value="4" /><label for="rating8" title="4 stars"></label>
                                                    <input type="radio" id="rating7" name="rating" value="3.5" /><label class="half" for="rating7" title="3.5 stars"></label>
                                                    <input type="radio" id="rating6" name="rating" value="3" /><label for="rating6" title="3 stars"></label>
                                                    <input type="radio" id="rating5" name="rating" value="2.5" /><label class="half" for="rating5" title="2.5 stars"></label>
                                                    <input type="radio" id="rating4" name="rating" value="2" /><label for="rating4" title="2 stars"></label>
                                                    <input type="radio" id="rating3" name="rating" value="1.5" /><label class="half" for="rating3" title="1.5 stars"></label>
                                                    <input type="radio" id="rating2" name="rating" value="1" /><label for="rating2" title="1 star"></label>
                                                    <input type="radio" id="rating1" name="rating" value="0.5" /><label class="half" for="rating1" title="0.5 star"></label>

                                                </fieldset>
                                            </div>
                                            <span class="text-danger" id="error_rating"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 offset-md-9 mt-3">
                                        <input id="submitBtn" class="btn btn-primary w-100" type="button" value="Update" onclick="submitreview('{{$unique_id}}')" href="javascript:void(0)">
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script src="{{ asset('front/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        getFeedback();
    });

    function getFeedback() {
        var uid = $('#unique_id').val();

        $.ajax({
            type: "GET",
            url: "{{ url('get-feedback') }}",
            data: {
                'unique_id': uid
            },
            success: function(res) {
               
                $('#description').val(res.descriptions);
                $('#subject').val(res.subject);
                $('#outcome').val(res.outcome);
                $("input[name='rating'][value='" + res.rating + "']").attr('checked', 'checked');
            }
        })
    }

    function submitreview(tutorId) {
        var description = $('#description').val();
        var subject = $('#subject').val();
        var outcome = $('#outcome').val();
        var temp = 0;
        var rating = $("input[name='rating']:checked").val();
        $('#description_error').html('');
        $('#subject_error').html('');
        $('#outcome_error').html('');
        $('#error_rating').html('');


        if (description.trim() == '') {
            $('#description_error').html('Description is required');
            temp++;
        }
        if (subject.trim() == '') {
            $('#subject_error').html('Subject is required');
            temp++;
        }
        if (outcome.trim() == '') {
            $('#outcome_error').html('Outcome is required');
            temp++;
        }
        if ($('input[name="rating"]:checked').length == 0) {
            $('#error_rating').html('Rating is required');
            temp++;
        }

        if (temp == 0) {
            $.ajax({
                url: "{{ route('submit-parent-review')}}",
                method: 'post',
                data: new FormData($('#add-feedback')[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(res) {
                    toastr.success(res.error_msg);
                    $('#add-feedback').trigger("reset");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var tempVal = 0;
                    if (jqXHR.responseJSON.message.description) {
                        tempVal++;
                        $('#description_error').text(jqXHR.responseJSON.message.description);
                    } else {
                        $('#description_error').text('');
                    }
                    if (jqXHR.responseJSON.message.subject) {
                        tempVal++;
                        $('#subject_error').text(jqXHR.responseJSON.message.subject);
                    } else {
                        $('#subject_error').text('');
                    }
                    if (jqXHR.responseJSON.message.outcome) {
                        tempVal++;
                        $('#outcome_error').text(jqXHR.responseJSON.message.outcome);
                    } else {
                        $('#outcome_error').text('');
                    }
                    if (jqXHR.responseJSON.message.rating) {
                        tempVal++;
                        $('#error_rating').text(jqXHR.responseJSON.message.rating);
                    } else {
                        $('#error_rating').text('');
                    }
                    if (tempVal == 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            })


        } else {
            return false;
        }

    }
</script>

@endsection