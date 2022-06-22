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

                                    </span>Add a subject
                                </a>

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

<div class="d-flex flex-column-fluid">

    <div class="container-fluid">

        <div class="d-flex flex-row">

            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom card-stretch">

                    <div class="card-header py-3">

                        <div class="card-title align-items-start flex-column">

                            <h3 class="card-label font-weight-bolder text-dark">Resources</h3>

                        </div>

                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline mr-2">

                                <a href="javascript:void(0)" class="btn btn-light-primary font-weight-bolder mr-2" id="resource-modal" data-toggle="modal" data-target="#resource-ajax-crud-modal" title="Resources">

                                    <span class="svg-icon svg-icon-md">

                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->

                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                <rect x="0" y="0" width="24" height="24"></rect>

                                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>

                                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>

                                            </g>

                                        </svg>

                                        <!--end::Svg Icon-->

                                    </span>Resources</a>

                                <!--begin::Dropdown Menu-->
                            </div>
                        </div>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive" id="response_resource_id">

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

<!-- Add Resources -->
<div class="modal fade" id="resource-ajax-crud-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="resource-modal">Add a resource</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form action="{{ route('tutor-resource.store') }}" method="post" id="resourceForm" name="resourceForm" enctype="multipart/form-data" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="exampleSelectd">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" maxlength="30" id="resource-title" placeholder="Enter Title">
                            <span class="title error_msg error" style="color: red;" id="title_error">{{ $errors->add->first('title')}}</span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="exampleSelectd">Description <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control validate_field" placeholder="Enter Description" name="description" id="resource-description"></textarea>
                            <span class="title error_msg error" style="color: red;" id="description_error">{{ $errors->add->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="position-relative">
                                <input type="file" class="input-upload-cus" id="text_book_upload" style="max-width: max-content;" name="document" id="document">
                            </div>
                            <div class="upload-photo-main" style="max-width: max-content;">
                                <i class="fa fa-plus plus-sign-upload"></i> <span class="mr-1">Upload Document</span><span class="text-danger">*</span>
                            </div>
                            <span id="uploadtitle"></span>
                            <span class="title error_msg error" style="color: red;" id="document_error">{{ $errors->add->first('document')}}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-resource-save" title="Submit">Submit</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" aria-hidden="true" title="Cancel">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Resources -->

<!-- Edit Resources -->
<div class="modal fade" id="resource-edit-ajax-crud-modal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Edit Resource</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form action="{{ route('tutor-resource.update','1') }}" enctype="multipart/form-data" id="formReourceEdit" name="formReourceEdit" class="form-horizontal" Method="post">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @method('put')

                <div class="modal-body">

                    <input type="hidden" name="user_id" id="user_id">

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="exampleSelectd">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title_edit" class="form-control" maxlength="30" id="resource_title_edit" placeholder="Enter Title">
                            <span class="title error_msg error" style="color: red;" id="title_error_edit">{{ $errors->edit->first('title_edit')}}</span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="exampleSelectd">Description <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control validate_field" placeholder="Enter Description" name="description_edit" id="resource_description_edit"></textarea>
                            <span class="title error_msg error" style="color: red;" id="description_error_edit">{{ $errors->edit->first('description_edit')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="position-relative">
                                <input type="file" id="text_book_upload_edit" class="input-upload-cus" style="max-width: max-content;" name="document_edit" id="document_edit">
                            </div>
                            <div class="upload-photo-main" style="max-width: max-content;">
                                <i class="fa fa-plus plus-sign-upload"></i> <span>Upload Document</span>
                            </div>
                            <span id="uploadtitleEdit"><a class="view-document" href="javascript:void(0);" target="_blank">View</a></span>
                            <span class="title error_msg error" style="color: red;" id="document_error_edit">{{ $errors->edit->first('document_edit')}}</span>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" id="btn-update-resource" value="update" title="Update">Update

                    </button>

                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal" aria-hidden="true" title="Cancel">Cancel</button>

                </div>

            </form>

        </div>

    </div>
</div>
<!-- End Edit Resources -->
@endsection
@section('page-js')
<script src="{{ asset('assets/js/pages/jquery-confirmation/js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.2.9') }}"></script>
<script src="{{ asset('assets/js/pages/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
    var _AJAX_LIST = "{{ route('tutor-subject-ajax') }}";
    var _AJAX_ONLINE_SUBJECT_LIST = "{{ route('tutor-online-subject-ajax') }}";
    var _AJAX_RESOURCE_LIST = "{{ route('tutor-resource-ajax') }}";

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

    function resourceAjaxList(page) {
        $('.ki-close').click();
        $.ajax({
            type: "GET",
            url: _AJAX_RESOURCE_LIST,
            data: {
                'page': page,
            },
            success: function(res) {
                $('#response_resource_id').html("");
                $('#response_resource_id').html(res);
            }

        })
    }
    ajaxList(1);
    onlineAjaxList(1);
    resourceAjaxList(1);
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
        <?php if (Request::get('addpopupresource') == '1') { ?>
            $("#resource-ajax-crud-modal").modal('show');
        <?php } ?>
        <?php if (Request::get('editpopupresource') == '1') { ?>
            var edit = <?php echo Request::get('id'); ?>;
            $.ajax({
                async: false,
                global: false,
                url: "{{URL::to('tutor-resource')}}/" + edit,
                type: "GET",
                success: function(response) {
                    var val = JSON.parse(res);
                    $("#title_edit").val(val.title);
                    $("#description_edit").val(val.description);
                    $('.view-document').attr("href", val.upload_data);
                    $("#user_id").val(val.id);
                }
            });
            $('#resource-edit-ajax-crud-modal').modal('show');
        <?php } ?>
    });
    $('#text_book_upload').change(function() {
        var name = $('#text_book_upload').val().split('\\').pop();
        $('#uploadtitle').html(name);
    });
    $('#text_book_upload_edit').change(function() {
        var name = $('#text_book_upload_edit').val().split('\\').pop();
        $('#uploadtitleEdit').html(name);
    });
    $('#btn-resource-save').click(function(e) {
        var titleVal = $('#resource-title').val();
        var descriptionVal = $('#resource-description').val();
        var document = $('#text_book_upload').val();
        var cnt = 0;
        console.log(titleVal);
        $('#title_error').html("");
        $('#description_error').html("");
        $('#document_error').html("");
        if (titleVal.trim() == '') {
            $('#title_error').html("Title is required");
            cnt = 1;
        }
        if (descriptionVal.trim() == '') {
            $('#description_error').html("Description is required");
            cnt = 1;
        }
        regex = new RegExp("(.*?)\.(jpeg|png|jpg|gif|docx|ppt|pdf|doc)$");
        if (document != "") {
            if (!(regex.test(document))) {
                $('#document_error').html("Document must be Type!! Like: JPEG, PNG, JPG, GIF, PPT, PDF, DOCX, and DOC");
                cnt = 1;
            }
        }else {
            $('#document_error').html("Please enter Document");
            cnt = 1;
        } 
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    });

    function editResourceDetail(id) {
        if (id != "") {
            $('#resource-edit-ajax-crud-modal').modal('show');
            $.ajax({
                url: "{{URL::to('tutor-resource')}}/" + id,
                type: "GET",
                success: function(res) {
                    var val = JSON.parse(res);
                    $("#resource_title_edit").val(val.title);
                    $("#resource_description_edit").val(val.description);
                    $('.view-document').attr("href", val.upload_data);
                    $("#user_id").val(val.id);
                }
            });

        }
    }

    $('#btn-update-resource').click(function(e) {
        var title = $('#resource_title_edit').val();
        var description = $('#resource_description_edit').val();
        var document = $('#text_book_upload').val();
        var cnt = 0;
        $('#title_error_edit').html("");
        $('#description_error_edit').html("");
        $('#document_error_edit').html("");
        if (title.trim() == '') {
            $('#title_error_edit').html("Title is required");
            cnt = 1;
        }
        if (description.trim() == '') {
            $('#description_error_edit').html("Description is required");
            cnt = 1;
        }
        regex = new RegExp("(.*?)\.(jpeg|png|jpg|gif|docx|ppt|pdf|doc)$");
        if (document != "") {
            if (!(regex.test(document))) {
                $('#document_error_edit').html("Document must be Type!! Like: JPEG, PNG, JPG, GIF, PPT, PDF, DOCX, and DOC");
                cnt = 1;
            }
        }
        if (cnt == 1) {
            return false;
        } else {
            return true;
        }
    });

    function deleteResourceDetail(deleteId) {
        event.preventDefault(); // prevent form submit
        $.confirm({
            title: 'Delete!',
            content: 'you want to delete this resource?',
            buttons: {
                confirm: function() {
                    $.ajax({
                        url: "{{route('tutor-resource.destroy','')}}" + "/" + deleteId,
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
</script>
@endsection