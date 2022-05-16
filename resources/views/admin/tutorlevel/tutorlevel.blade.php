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
                                <h3 class="card-label font-weight-bolder text-dark">Tutor Level List</h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-level" data-toggle="modal" data-target="#ajax-crud-modal">Add</a>
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
                  <h4 class="modal-title" id="userCrudModal"></h4>
              </div>
              <form id="userForm" name="userForm" class="form-horizontal">
                  <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <div class="modal-body">
                    <input type="hidden" name="leval_id" id="leval_id">
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="" maxlength="50">
                          <span class="title" id="titleerror"></span>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="create">
                      Save 
                    </button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="userCrudModal"></h4>
              </div>
              <form id="userForm" name="userForm" class="form-horizontal" >
                  <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <div class="modal-body">
                    <input type="hidden" name="leval_id" id="leval_id">
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="" maxlength="50">
                          <span class="title" id="titleerror"></span>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-update" value="update">
                  Update
                    </button>
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
            $('.btn-close').click();
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

        
        $('#btn-update').click(function(e){
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
                url: "{{ route('tutor-level.update/'.$id)}}",
                type: "PUT",
               
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
        

</script>
<script>
  
</script>
@endsection
