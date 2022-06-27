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

                            <h3 class="card-label font-weight-bolder text-dark">Support Ticket</h3>

                        </div>

                        <div class="card-toolbar">

                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">

                                <a href="javascript:void(0)" class="btn btn-primary mr-2" id="add-ticket" data-toggle="modal" data-target="#ajax-crud-modal" title="Add a Support Ticket">

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

                                    </span>Add a Support Ticket
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

                <h5 class="modal-title" id="exampleModalLabel">Add a Ticket</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form action="{{ route('parent-support-ticket.store') }}" method="post" id="subjectForm" name="userForm" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="exampleSelectd">Message <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control validate_field" placeholder="Enter Message" name="message" id="message"></textarea>
                            <span class="title error_msg error" style="color: red;" id="message_error">{{ $errors->add->first('message')}}</span>
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

                <h5 class="modal-title" id="exampleModalLabel">Edit Ticket</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            <form action="{{ route('parent-support-ticket.update','1') }}" id="formEdit" name="formEdit" class="form-horizontal" Method="post">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="editid" id="editid">

                @method('put')

                <div class="modal-body">

                    <div class="form-group row">

                        <div class="col-md-12">

                            <label for="exampleSelectd">Message <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control validate_field" placeholder="Enter Message" name="message_edit" id="message_edit"></textarea>
                            <span class="title error_msg error" style="color: red;" id="message_edit_error">{{ $errors->edit->first('message_edit')}}</span>

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

@endsection
@section('page-js')
<script src="{{asset('assets/Modulejs/support-ticket.js')}}"></script>
<script>
    var id = $('#editid').val();
    var _AJAX_LIST = "{{ route('parent-support-ajax') }}";
    var _GET_DATA_TICKET = "{{ url('parent-support-ticket') }}/" + id;
    var _DELETE_TICKET = "{{ route('parent-support-ticket.destroy','') }}";
    var _TOKEN = "{{ csrf_token() }}";
</script>
<script>
    $(document).ready(function() {
        <?php if (Request::get('addpopup') == '1') { ?>
            $("#ajax-crud-modal").modal('show');
        <?php } ?>
        <?php if (Request::get('editpopup') == '1') { ?>
            var edit = <?php echo Request::get('id'); ?>;
            $.ajax({
                async: false,
                global: false,
                url: "{{ url('parent-support-edit') }}/" + edit,
                type: "GET",
                success: function(response) {
                    var val = JSON.parse(response);
                    $("#message_edit").val(val.support_msg);
                }
            });
            $('#editajax-crud-modal').modal('show');
        <?php } ?>
    });
</script>
@endsection