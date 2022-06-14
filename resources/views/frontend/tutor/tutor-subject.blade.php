@extends('layouts.master')

@section('content')

<div class="d-flex flex-column-fluid">

    <div class="container-fluid">

        <div class="d-flex flex-row">

            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom card-stretch">

                    <!--begin::Header-->

                    <div class="card-header py-3">

                        <div class="card-title align-items-start flex-column">

                            <h3 class="card-label font-weight-bolder text-dark">My Subjects</h3>

                        </div>

                        <div class="card-toolbar">

                            <!--begin::Dropdown-->

                            <div class="dropdown dropdown-inline mr-2">

                                <a href="javascript:void(0)" class="btn btn-primary mr-2" id="add-subject" data-toggle="modal" data-target="#ajax-crud-modal" title="Add a subject">

                                    <span class="svg-icon svg-icon-md">

                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->

                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                <rect x="0" y="0" width="24" height="24"></rect>

                                                <circle fill="#000000" cx="9" cy="15" r="6"></circle>

                                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>

                                            </g>

                                        </svg>

                                        <!--end::Svg Icon-->

                                    </span>Add a subject</a>

                                <!--begin::Dropdown Menu-->

                            </div>

                            <!--end::Dropdown-->

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive" id="response_id">

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
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Add a subject</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form id="subjectForm" name="userForm" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Subject <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="main_subject" id="main_subject">

                                <option value="">Select Subject</option>

                                @foreach($subject as $val)
                                @if(!in_array($val->id, $tutorSubject))
                                <option value="{{$val->id}}">{{$val->main_title}}</option>
                                @endif
                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="subject_error"></span>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Level <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="level" id="level">

                                <option value="">Select Level</option>

                                @foreach($level as $val)
                                @if(!in_array($val->id, $tutorLevel))
                                <option value="{{$val->id}}">{{$val->title}}</option>
                                @endif

                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="level_error"></span>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="btn-save" title="Submit">Submit

                    </button>

                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" aria-hidden="true" title="Cancel">Cancel</button>

                </div>

            </form>

        </div>

    </div>

</div>


@endsection
@section('page-js')
<script src="{{ asset('assets/js/pages/jquery-confirmation/js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.2.9') }}"></script>
<script src="{{ asset('assets/js/pages/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
    var _AJAX_LIST = "{{ route('tutor-level-ajax') }}";
    function ajaxList(page) {
        var title = $('#title').val();
        var created_date = $('#created_date').val();
        $('.ki-close').click();
        $.ajax({

            type: "GET",

            url: _AJAX_LIST,

            data: {

                'title': title,

                'page': page,

                'created_date': created_date

            },

            success: function(res) {

                $('#response_id').html("");

                $('#response_id').html(res);

            }

        })

    }

    ajaxList(1);
    $('#btn-save').click(function(e) {
        var name = $('#main_subject').val();
        var level = $('#level').val();
        var cnt = 0;
        $('#subject_error').html("");
        $('#level_error').html("");
        if (name == '') {
            $('#subject_error').html("Subject is required");
            cnt = 1;
        }
        if (level == '') {
            $('#level_error').html("Level is required");
            cnt = 1;
        }
        if (cnt == 1) {
            return false;
        } else {
            $.ajax({

                data: $('#subjectForm').serialize(),

                url: "{{ route('tutor-subject-store') }}",

                type: "POST",

                success: function(data) {
                    $('#subjectForm').trigger("reset");
                    $('#ajax-crud-modal').modal('hide');
                    toastr.success(data.error_msg);
                    ajaxList(1);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var tempVal = 0;
                    if (jqXHR.responseJSON.message.main_subject) {
                        tempVal++;
                        $('#subject_error').text(jqXHR.responseJSON.message.main_subject);
                    } else {
                        $('#subject_error').text('');
                    }
                    if (jqXHR.responseJSON.message.level) {
                        tempVal++;
                        $('#level_error').text(jqXHR.responseJSON.message.level);
                    } else {
                        $('#level_error').text('');
                    }
                    if (tempVal == 0) {
                        $('#ajax-crud-modal').modal('hide');
                        return true;
                    } else {
                        $('#ajax-crud-modal').modal('show');
                        return false;
                    }
                }

            });

        }

    })
</script>
@endsection