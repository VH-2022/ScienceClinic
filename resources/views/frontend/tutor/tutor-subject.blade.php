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

            <form action="{{ route('tutor-subject-store') }}" method="post" id="subjectForm" name="userForm" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Subject <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="main_subject" id="main_subject">

                                <option value="">Select Subject</option>

                                @foreach($subject as $val)
                                @if(!in_array($val->id, $selectedSubject))
                                <option value="{{$val->id}}">{{$val->main_title}}</option>
                                @endif
                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="subject_error">{{ $errors->subject->first('main_subject')}}</span>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Level <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="level" id="level">

                                <option value="">Select Level</option>

                                @foreach($level as $val)
                                @if(!in_array($val->id, $selectedLevel))
                                <option value="{{$val->id}}">{{$val->title}}</option>
                                @endif

                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="level_error">{{ $errors->subject->first('level')}}</span>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" id="btn-save" title="Submit">Submit

                    </button>

                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" aria-hidden="true" title="Cancel">Cancel</button>

                </div>

            </form>

        </div>

    </div>

</div>

<div class="modal fade title-edit" id="editajax-crud-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form action="{{ route('tutor-subject-update') }}" id="formEdit" name="formEdit" class="form-horizontal" Method="post">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @method('put')

                <div class="modal-body">

                    <input type="hidden" name="level_id_edit" id="level_id_edit">
                    <input type="hidden" name="main_id_edit" id="main_id_edit">

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Subject <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="main_subject_edit" id="main_subject_edit">

                                <option value="">Select Subject</option>

                                @foreach($subject as $val)
                                <option value="{{$val->id}}">{{$val->main_title}}</option>
                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="subject_error_edit">{{ $errors->edit->first('main_subject_edit')}}</span>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Level <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="level_edit" id="level_edit">

                                <option value="">Select Level</option>

                                @foreach($level as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="level_error_edit">{{ $errors->edit->first('level_edit')}}</span>

                        </div>

                    </div>


                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" id="btn-update" value="update" title="Update">Update

                    </button>

                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" aria-hidden="true" title="Cancel">Cancel</button>

                </div>

            </form>

        </div>

    </div>

</div>


<div class="d-flex flex-column-fluid">

    <div class="container-fluid">

        <div class="d-flex flex-row">

            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom card-stretch">

                    <!--begin::Header-->

                    <div class="card-header py-3">

                        <div class="card-title align-items-start flex-column">

                            <h3 class="card-label font-weight-bolder text-dark">My Online Subjects</h3>

                        </div>


                    </div>

                    <div class="card-body">

                        <div class="table-responsive" id="response_online_id">

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

<div class="modal fade title-edit" id="edit-online-ajax-crud-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form action="{{ route('tutor-subject-update') }}" id="formEdit" name="formEdit" class="form-horizontal" Method="post">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @method('put')

                <div class="modal-body">

                    <input type="hidden" name="level_id_edit" id="level_id_online_edit">
                    <input type="hidden" name="main_id_edit" id="main_id_online_edit">

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Subject <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="main_subject_edit" id="main_subject_online_edit">

                                <option value="">Select Subject</option>

                                @foreach($subject as $val)
                                <option value="{{$val->id}}">{{$val->main_title}}</option>
                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="subject_error_online_edit">{{ $errors->edit->first('main_subject_edit')}}</span>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Level <span class="text-danger">*</span></label>

                            <select class="form-control validate_field main_subject" name="level_edit" id="level_online_edit">

                                <option value="">Select Level</option>

                                @foreach($level as $val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                                @endforeach

                            </select>

                            <span class="title error_msg error" style="color: red;" id="level_error_online_edit">{{ $errors->edit->first('level_edit')}}</span>

                        </div>

                    </div>


                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" id="btn-update-online" value="update" title="Update">Update

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
    var _AJAX_LIST = "{{ route('tutor-subject-ajax') }}";
    var _AJAX_ONLINE_SUBJECT_LIST = "{{ route('tutor-online-subject-ajax') }}";

    function ajaxList(page) {
        $('.ki-close').click();
        $.ajax({
            type: "GET",
            url: _AJAX_LIST,
            data: {
                'page': page,
            },
            success: function(res) {
                $('#response_id').html("");
                $('#response_id').html(res);
            }

        })
    }
    function onlineAjaxList(page) {
        $('.ki-close').click();
        $.ajax({
            type: "GET",
            url: _AJAX_ONLINE_SUBJECT_LIST,
            data: {
                'page': page,
            },
            success: function(res) {
                $('#response_online_id').html("");
                $('#response_online_id').html(res);
            }

        })
    }
    ajaxList(1);
    onlineAjaxList(1);
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
            return true;
        }
    })

    $('#btn-update').click(function(e) {
        var name = $('#main_subject_edit').val();
        var level = $('#level_edit').val();
        var id = $('#level_id_edit').val();
        var mainId = $('#main_id_edit').val();
        var cnt = 0;
        $('#subject_error_edit').html("");
        $('#level_error_edit').html("");
        if (name == '') {
            $('#subject_error_edit').html("Subject is required");
            cnt = 1;
        } else {
            $.ajax({
                async: false,
                global: false,
                url: "{{route('check-level-subject')}}",
                type: "POST",
                data: {
                    name: name,
                    level: level,
                    id: id,
                    mainId: mainId,
                    _token: "{{ csrf_token()}}"
                },
                success: function(response) {
                    if (response == 1) {
                        $('#level_error_edit').html("Level is already exist");
                        $('#subject_error_edit').html("Subject is already exist");
                        cnt = 1;
                    } else {
                        $('#level_error_edit').html("");
                        $('#subject_error_edit').html("");
                    }
                }
            });
        }
        if (level == '') {
            $('#level_error_edit').html("Level is required");
            cnt = 1;
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    })

    $('#btn-update-online').click(function(e) {
        var name = $('#main_subject_online_edit').val();
        var level = $('#level_online_edit').val();
        var id = $('#level_id_online_edit').val();
        var mainId = $('#main_id_online_edit').val();
        var cnt = 0;
        $('#subject_error_online_edit').html("");
        $('#level_error_online_edit').html("");
        if (name == '') {
            $('#subject_error_online_edit').html("Subject is required");
            cnt = 1;
        } else {
            $.ajax({
                async: false,
                global: false,
                url: "{{route('check-level-subject')}}",
                type: "POST",
                data: {
                    name: name,
                    level: level,
                    id: id,
                    mainId: mainId,
                    _token: "{{ csrf_token()}}"
                },
                success: function(response) {
                    if (response == 1) {
                        $('#level_error_online_edit').html("Level is already exist");
                        $('#subject_error_online_edit').html("Subject is already exist");
                        cnt = 1;
                    } else {
                        $('#level_error_online_edit').html("");
                        $('#subject_error_online_edit').html("");
                    }
                }
            });
        }
        if (level == '') {
            $('#level_error_online_edit').html("Level is required");
            cnt = 1;
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    })

    function editDetail(id) {
        if (id != "") {
            $('#editajax-crud-modal').modal('show');
            $.ajax({
                url: "{{ url('tutor-subject-edit') }}/" + id,
                type: "GET",
                success: function(res) {
                    var val = JSON.parse(res);
                    $("#main_subject_edit").find("option[value=" + val.subject_id + "]").attr('selected', true);
                    $("#level_edit").find("option[value=" + val.level_id + "]").attr('selected', true);
                    $("#level_id_edit").val(val.tutor_id);
                    $("#main_id_edit").val(val.id);
                }
            });

        }
    }

    function editOnlineDetail(id) {
        if (id != "") {
            $('#edit-online-ajax-crud-modal').modal('show');
            $.ajax({
                url: "{{ url('tutor-online-subject-edit') }}/" + id,
                type: "GET",
                success: function(res) {
                    var val = JSON.parse(res);
                    $("#main_subject_online_edit").find("option[value=" + val.subject_id + "]").attr('selected', true);
                    $("#level_online_edit").find("option[value=" + val.level_id + "]").attr('selected', true);
                    $("#level_id_online_edit").val(val.tutor_id);
                    $("#main_id_online_edit").val(val.id);
                }
            });

        }
    }

    function deleteDetail(deleteId) {
        event.preventDefault(); // prevent form submit
        $.confirm({
            title: 'Delete!',
            content: 'you want to delete this subject?',
            buttons: {
                confirm: function() {
                    $.ajax({
                        url: "{{ url('remove-subject') }}/" + deleteId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                },
                cancel: function() {}
            }
        });
    }
    function deleteOnlineDetail(deleteId) {
        event.preventDefault(); // prevent form submit
        $.confirm({
            title: 'Delete!',
            content: 'you want to delete this subject?',
            buttons: {
                confirm: function() {
                    $.ajax({
                        url: "{{ url('remove-subject') }}/" + deleteId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                },
                cancel: function() {}
            }
        });
    }
    $(document).ready(function() {
        <?php if (Request::get('addpopup') == '1') { ?>
            $("#ajax-crud-modal").modal('show');
        <?php } ?>
        <?php if (Request::get('editpopup') == '1') { ?>
            var edit = <?php echo Request::get('id'); ?>;
            $.ajax({
                async: false,
                global: false,
                url: "{{ url('tutor-subject-edit') }}/" + edit,
                type: "GET",
                success: function(response) {
                    var val = JSON.parse(res);
                    $("#main_subject_edit").find("option[value=" + val.subject_id + "]").attr('selected', true);
                    $("#level_edit").find("option[value=" + val.level_id + "]").attr('selected', true);
                    $("#level_id_edit").val(val.tutor_id);
                    $("#main_id_edit").val(val.id);
                }
            });
            $('#editajax-crud-modal').modal('show');
        <?php } ?>
    });
</script>
@endsection