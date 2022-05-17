@extends('layouts.master')

@section('content')
<style>
    .error{
        color:red;
    }
    </style>
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
                                <h3 class="card-label font-weight-bolder text-dark">Tutor Level List</h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-level" data-toggle="modal" data-target="#ajax-crud-modal" title="Add TutorLevel">Add</a>
                            </div>
                       </div>
                        <div class="card-body">
                            <div class="table-responsive" id="response_id">
                            </div>
                        </div>
                    </div>
                </div><!--end::Content-->
            </div><!--end::Subject List-->
        </div> <!--end::Container-->
    </div>
    <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add TutorLevel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
              <form id="userForm" name="userForm" class="form-horizontal">
                  <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <div class="modal-body">
                    
                        <div class="form-group">
                        <label for="name" >Name</label><span class="error">*</span>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Name" value="" onkeypress="return isName(event)" maxlength="50">
                            <span class="title error" id="titleerror"></span>
                        </div>

                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="create" title="submit">Save 
                    </button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"
                    aria-hidden="true">Cancel</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <div class="modal fade title-edit" id="editajax-crud-modal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit TutorLevel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
              </div>
              <form id="formEdit" name="formEdit" class="form-horizontal" Method="GET">
                 <input type="hidden" name="_token" value="{{ csrf_token()}}"> 
                  @method('put')
                <div class="modal-body">
                    <input type="hidden" name="level_id" id="level_id_edit">
                    <div class="form-group">
                      <label for="name">Name</label><span class="error">*</span>
                      <input type="text" class="form-control" id="title-edit" name="title" placeholder="Enter Name" value="" onkeypress="return isName(event)" maxlength="50" >
                          <span class="title error" id="title_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-update" value="update">Update
                    </button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"
                    aria-hidden="true" title="cancel">Cancel</button>
                </div>
              </form>
          </div>
        </div>
      </div>
@endsection
@section('page-js')
    <script>
        var _AJAX_LIST = "{{ url('tutor-level-ajax') }}";

        function ajaxList(page) {
            var title = $('#title').val();
            var created_date = $('#kt_daterangepicker_6').val();

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

        $('#btn-save').click(function(e){
            var title = $('#title').val();
            var cnt =0;
            $('#titleerror').html("");
            if(title.trim() ==''){
                $('#titleerror').html("Name is required");
                cnt =1;
            }

            if(cnt ==1){
                return false;
            }else{
                $.ajax({
                data: $('#userForm').serialize(),
                url: "{{ route('tutor-level.store')}}",
                type: "POST",
               
                success: function (data) {
                    $('#userForm').trigger("reset");
                    $('#ajax-crud-modal').modal('hide');
                    toastr.success(data.error_msg);
                    ajaxList(1);
                  },
                error: function (data) {
                    toastr.success(data.error_msg);
                    }
            });
            }
        })

    function editDetail(id){
        if(id !=""){
            $.ajax({
                url: "{{ url('tutor-level')}}/"+id+"/edit",
                type: "GET",
                success: function (res){
                  var json = res.data[0];
                  $('#title-edit').val(json.title);
                  $('#level_id_edit').val(json.id);
                  $('#editajax-crud-modal').modal('show')
                }
            });

        }
    }
    $('#btn-update').click(function(e){
            var title = $('#title-edit').val();
            var id = $('#level_id_edit').val();
            var cnt =0;
            $('#title_error').html("");
            if(title.trim() ==''){
                $('#title_error').html("Name is required");
                cnt =1;
            }
            if(cnt ==1){
                return false;
            }else{
                var fornData = $('#formEdit')[0];
                var newform = new FormData(fornData);
                newform.append('_token','{{ csrf_token()}}');
                newform.append('_method',"PUT");

                $.ajax({
                    type: "POST",
                    url: '{{ url("tutor-level")}}/'+id,
                    data: newform,
                    processData: false,
                    contentType: false,
                success: function (res) {
                    $('#editajax-crud-modal').modal('hide');
                    toastr.success(res.error_msg);
                    var json = res.data[0];
                  $('#title'+json.id).html(json.title);
                  },
                error: function (data) {
                    toastr.error(data.error_msg);
                    }
            });
            }
        })
</script>
<script type="text/javascript">
    function functionDelete(deleteId) {
        event.preventDefault(); // prevent form submit
        $.confirm({
            title: 'Delete!',
            content: 'Are you sure Delete?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        url: "{{url('tutor-level')}}/"+deleteId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method:"DELETE"
            
                        },
                        success: function(response) {
                            toastr.success(response.message);
                                ajaxList(1);
                        }
                    });
                },
                cancel: function () {
                   
                }
            }
        });    
    }
    $('#ajax-crud-modal').on('hidden.bs.modal', function () {
        $('#titleerror').html("");
        $('#userForm')[0].reset();
})
$('#editajax-crud-modal').on('hidden.bs.modal', function () {
        $('#title_error').html("");
        $('#formEdit')[0].reset();
})
function isName(event) {
    var regex = new RegExp("^[a-zA-Z \s]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
}
</script>
@endsection
