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
                                <h3 class="card-label font-weight-bolder text-dark">Add Blog Master</h3>
                            </div>
                        </div>

                        <form class="form" id="submitid" method="post" action="{{ route('blog-master.store') }}"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input placeholder="Title" class="form-control validate_field"
                                                autocomplete="off" id="title" type="text" data-msg="Title" name="title">
                                            <span class="form-text error title_error"
                                                id="title_error">{{ $errors->first('title') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image <span class="text-danger">*</span></label>
                                            <div>
                                                <input type="file" name="image" data-msg="Image" id="image"
                                                    accept=".png, .jpg, .jpeg">
                                                <span class="form-text error image_error" 
                                                id="title_error">{{ $errors->first('image') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea type="text" data-msg="Description" class="form-control validate_field" placeholder="Description"
                                                name="description" id="description" data-msg="Description"></textarea>
                                                @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="add_blog" class="btn btn-primary mr-2"
                                    style="background-color:#3498db !important" >Submit</button>
                                <button type="reset" class="btn btn-secondary"
                                    onclick='window.location.href="{{ url('blog-master') }}"'>Cancel</button>
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



    //     var _Add_SUBJECT = "{{ route('blog-master.store') }}";
    // </script>
    //  <script>
    //   $('#add_blog').click(function(e) {

    //         var title = $('#title').val();
    //         var image = $('#image').val();
    //         var description = $('#description').val();

    //         var temp = 0;
          
    //         if (title.trim() == '') {
    //             $('#title_error').html("Name is required");
    //             temp++;
    //            } else   {
    //             $('#title_error').html("");
    //             }

           
    //         if (description.trim() == '') {
    //             $('#description_error').html("Description is required");
    //            temp++;
    //         } else {
    //             $('#description_error').html("");
    //         }
    //             $.ajax({
    //                 url: _Add_SUBJECT,
    //                 type: "POST",
    //                 data: {
    //                     _token: '{{csrf_token()}}',
    //                     title: title,
    //                     image: image,
    //                     description: description,
    //                 },
    //                 success: function(response) {
    //                     console.log(response);
    //                     toastr.success(response.messages);
    //                 },
    //                 error: function(response) {
    //                     toastr.success(response.messages);
    //                 }
    //             });
            
    //     })
    </script>
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script>
    function validation(){
       var temp=0;
       var title=$('#title').val();
    if(title==""){
        $('#title_error').html('Please enter city');
        temp++;
    }else{
        $('#title_error').html("");
    }
    if(temp==0)
    {
        return true;
    }else{
        return false;
    }

  } --}}
    {{-- </script> --}}
@endsection
