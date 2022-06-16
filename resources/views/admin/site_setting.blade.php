@extends('layouts.master')
@section('content')
    <style>
        .remove-btn1 {
            margin-top: 26.5px;
        }

        .error {
            color: red;
        }

    </style>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="d-flex flex-row">
                <div class="flex-row-fluid">
                    <div class="card card-custom card-stretch">

                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">Site Setting</h3>
                            </div>
                        </div>

                        <form class="form" id="submitid" method="POST"
                            action="{{ route('site-setting.update', $sitesetting->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $sitesetting->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Commission(%) <span class="text-danger">*</span></label>
                                            <input placeholder="Commission" class="form-control validate_field number"
                                                autocomplete="off" id="commission_value" type="text" data-msg="Commission" name="commission_value"
                                                value="{{ $sitesetting->commission_value }}">
                                            <span class="form-text error title_error"
                                                id="title_error">{{ $errors->first('commission_value') }}</span>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" title="Submit"
                                    id="edit_blog">Update</button>
                            </div>
                            <!--end::Body-->
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Subject List-->
    </div>
    <!--end::Container-->
@endsection
@section('page-js')
    <script>
        CKEDITOR.replace('description');
        $('#edit_blog').click(function(e) {

            var commission_value = $('#commission_value').val();

            var temp = 0;

            if (commission_value.trim() == '') {
                $('#title_error').html("Commission is required");
                temp++;
            } else {
                if (commission_value < 0 || commission_value > 99) {
                    $("#title_error").html('IDG Commission is invalid.');
                    temp++;
                }else{
                    $("#title_error").html('');
                }
            }

           

            if (temp == 0) {
                return true;
            } else {
                return false;
            }
        });
</script>
<script>
        $('.number').keypress(function(event) {
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
        ((event.which < 48 || event.which > 57) &&
          (event.which != 0 && event.which != 8))) {
        event.preventDefault();
      }
  
      var text = $(this).val();
  
      if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 2) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
        event.preventDefault();
      }
    });
    </script>
@endsection
