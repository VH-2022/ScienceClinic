@extends('layouts.master')

@section('content')

<style>

    .remove-btn1 {

        margin-top: 26.5px;

    }



    .error {

        color: red;

    }
    .upload-photo-main{
        left: 42px;
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
                            <h3 class="card-label font-weight-bolder text-dark">Edit Past Papares</h3>
                        </div>
                    </div>



                    <form class="form" id="submitid" method="post" action="{{url('past-papers-cms')}}/{{$basic_details->id}}" enctype="multipart/form-data">

                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $basic_details->id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span></label>
                                        <select name="paper_category_id" id="paper_category_id" class="form-control validate_field" data-msg="Category" >
                                            <option value="">Select Category</option>
                                            @if(count($papersCategory) > 0)
                                                @foreach($papersCategory as $ckey)
                                                    <option value="{{$ckey->id}}" @php if($basic_details->paper_category_id !=''){ if($basic_details->paper_category_id == $ckey->id){ echo 'selected'; } } @endphp>{{$ckey->category_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="form-text error paper_category_id_error">{{ $errors->useredit->first('paper_category_id')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Paper Title <span class="text-danger">*</span></label>
                                        <input class="form-control validate_field" placeholder="Paper Title" autocomplete="off" id="paper_title" type="text" data-msg="Paper Title" name="paper_title" value="{{$basic_details->paper_title}}">
                                        <span class="form-text error paper_title_error">{{ $errors->useredit->first('paper_title')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Subject <span class="text-danger">*</span></label>
                                        <select name="subject_id" id="subject_id" class="form-control validate_field" data-msg="Subject" >
                                            <option value="">Select Subject</option>
                                            @if(count($subject_list) > 0)
                                                @foreach($subject_list as $ckey)
                                                    <option value="{{$ckey->id}}" @php if($basic_details->subject_id !=''){ if($basic_details->subject_id == $ckey->id){ echo 'selected'; } } @endphp>{{$ckey->main_title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="form-text error subject_id_error">{{ $errors->useredit->first('subject_id')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <label>Paper Sub Title <span class="text-danger">*</span></label>
                                            <input class="form-control validate_field" placeholder="Paper Sub Title" autocomplete="off" id="paper_sub_title" type="text" data-msg="Paper Sub Title" name="paper_sub_title" value="{{$basic_details->paper_sub_title}}">
                                            <span class="form-text error paper_sub_title_error">{{ $errors->useredit->first('paper_sub_title')}}</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="row" style="text-align:right">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <button type="button" onclick="appendMore()" class="btn btn-info btn-sm">Add</button>
                                    </div>
                                </div>
                            </div>
                            @if(count($paper_basic_details) > 0)
                            @php $i = 0;  @endphp
                                @foreach($paper_basic_details as $key)
                                <input type="hidden" name="detail_id[]" value="{{ $key->id}}">
                                    <div class="row" id="deleteRow_{{$i}}">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Subject Title <span class="text-danger">*</span></label>
                                                <input class="form-control validate_field" placeholder="Subject Title" autocomplete="off" id="subject_paper_title{{$i}}" type="text" data-msg="Paper Sub Title" name="subject_paper_title[]" value="{{$key->subject_paper_title}}">
                                                <span class="form-text error subject_paper_title_error_{{$i}}">{{ $errors->useredit->first('subject_paper_title')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Upload Paper <span class="text-danger">*</span></label>
                                                <div class="position-relative">
                                                    <input type="file" class="input-upload-cus" name="upload_paper[]" id="upload_paper{{$i}}" class="form-control validate_field" data-msg="Upload">
                                                    <div class="upload-photo-main">
                                                        <i class="fa fa-plus plus-sign-upload"></i>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="{{$key->upload_paper}}" id="upload_paperdata{{$i}}" />
                                                <span id="uploadBook{{$i}}"><a target="_blank" href="{{$key->upload_paper}}">View</a></span>
                                                <span class="form-text error upload_paper_error_{{$i}}"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Upload Mark Scheme <span class="text-danger">*</span></label>
                                                <div class="position-relative">
                                                    <input type="file" class="input-upload-cus" name="upload_mark_scheme[]" id="upload_mark_scheme{{$i}}" class="form-control validate_field" data-msg="Upload">
                                                    <div class="upload-photo-main">
                                                        <i class="fa fa-plus plus-sign-upload"></i>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="{{$key->upload_mark_scheme}}" id="upload_mark_schemeData{{$i}}" />
                                                <span id="uploadtitle{{$i}}"><a target="_blank" href="{{$key->upload_mark_scheme}}">View</a></span>
                                                <span class="form-text error upload_mark_scheme_error_{{$i}}"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-1"><div class="form-group"><button type="button" onclick="removeDeleteID({{$key->id}})" class="btn btn-secondary btn-sm">Delete</button></div></div>
                                    </div>
                                    @php $i++;  @endphp
                                @endforeach
                            @else
                                <input type="hidden" name="detail_id[]" value="0">
                                <div class="row">
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Subject Title <span class="text-danger">*</span></label>
                                            <input class="form-control validate_field" placeholder="Subject Title" autocomplete="off" id="subject_paper_title0" type="text" data-msg="Paper Sub Title" name="subject_paper_title[]">
                                            <span class="form-text error subject_paper_title_error_0">{{ $errors->useredit->first('subject_paper_title')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Upload Paper <span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="file" class="input-upload-cus" name="upload_paper[]" id="upload_paper0" class="form-control validate_field" data-msg="Upload">
                                                <div class="upload-photo-main">
                                                    <i class="fa fa-plus plus-sign-upload"></i>
                                                </div>
                                            </div>
                                            <input type="hidden" value="" id="upload_paperdata0" />
                                            <span id="uploadBook0"></span>
                                            <span class="form-text error upload_paper_error_0"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Upload Mark Scheme <span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="file" class="input-upload-cus" name="upload_mark_scheme[]" id="upload_mark_scheme0" class="form-control validate_field" data-msg="Upload">
                                                <div class="upload-photo-main">
                                                    <i class="fa fa-plus plus-sign-upload"></i>
                                                </div>
                                            </div>
                                            <input type="hidden" value="" id="upload_mark_schemeData0" />
                                            <span id="uploadtitle0"></span>
                                            <span class="form-text error upload_mark_scheme_error_0"></span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" id="deletedID" name="deletedID" />
                            <div id="appendData"></div>
                           
                        </div>

                        <div class="card-footer">

                            <button type="button" id="edit_subject" class="btn btn-primary mr-2" style="background-color:#3498db !important">Submit</button>

                            <button type="reset" class="btn btn-secondary" onclick='window.location.href="{{ url('past-papers-cms')}}"'>Cancel</button>

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

<script src="{{asset('assets/Modulejs/pastpapers.js')}}"></script>
<script>
$('#upload_paper0').change(function() {
    var name = $('#upload_paper0').val().split('\\').pop();
  	$('#uploadBook0').html(name);
  	$('#upload_paperdata0').val(name);
});

$('#upload_mark_scheme0').change(function() {
    var name = $('#upload_mark_scheme0').val().split('\\').pop();
  	$('#uploadtitle0').html(name);
  	$('#upload_mark_schemeData0').val(name);
});



var subjectData = {!!$subject_list!!};
var subjectHtml = '';
if(subjectData !=''){
    for(var i=0;i<subjectData.length;i++){
        subjectHtml +='<option value="'+subjectData[i].id+'">'+subjectData[i].main_title+'</option>';
    }
}
var _Add_SUBJECT = "{{route('past-papers-cms.store')}}";
var oldID = '{{$i}}';
var id = 1;
if(oldID !=''){
    id = oldID;
}

function appendMore(){
    var html ='<div class="row" id="deleteRow_'+id+'"><input type="hidden" name="detail_id[]" value="0"><div class="col-md-4"><div class="form-group"><label>Subject Title <span class="text-danger">*</span></label><input class="form-control validate_field" placeholder="Subject Title" autocomplete="off" id="subject_paper_title'+id+'" type="text" data-msg="Paper Sub Title" name="subject_paper_title[]"> <span class="form-text error subject_paper_title_error_'+id+'"></span></div></div><div class="col-md-3"><div class="form-group"><label>Upload Paper <span class="text-danger">*</span></label><div class="position-relative"><input type="file" class="input-upload-cus" name="upload_paper[]" id="upload_paper'+id+'" class="form-control validate_field" data-msg="Upload"><div class="upload-photo-main"><i class="fa fa-plus plus-sign-upload"></i></div></div><input type="hidden" value="" id="upload_paperdata'+id+'" /><span id="uploadBook'+id+'"></span><span class="form-text error upload_paper_error_'+id+'"></span></div></div><div class="col-md-3"><div class="form-group"><label>Upload Mark Scheme <span class="text-danger">*</span></label><div class="position-relative"><input type="file" class="input-upload-cus" name="upload_mark_scheme[]" id="upload_mark_scheme'+id+'" class="form-control validate_field" data-msg="Upload"><div class="upload-photo-main"><i class="fa fa-plus plus-sign-upload"></i></div></div><input type="hidden" value="" id="upload_mark_schemeData'+id+'" /><span id="uploadtitle'+id+'"></span><span class="form-text error upload_mark_scheme_error_'+id+'"></span></div></div><div class="col-md-1"><div class="form-group"><button type="button" onclick="removeID('+id+')" class="btn btn-secondary btn-sm">Delete</button></div></div></div>';

    $("#appendData").append(html);


    changes(id);

    id++;


}

function changes(id){
    $('#upload_paper'+id+'').change(function() {
       var name = $('#upload_paper'+id).val().split('\\').pop();
        $('#uploadBook'+id+'').html(name);
        $('#upload_paperdata'+id+'').val(name);
    });

    $('#upload_mark_scheme'+id+'').change(function() {
        var name = $('#upload_mark_scheme'+id).val().split('\\').pop();
        $('#uploadtitle'+id+'').html(name);
        $('#upload_mark_schemeData'+id+'').val(name);
    });
}

function removeID(id){
    $.confirm({
        title: 'Are you sure?',
        columnClass:"col-md-6",
        content: "you want to delete this item?",
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-danger',
                action: function () {
                    $("#deleteRow_"+id).remove();
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
        }
    });
}

var idArray = [];
function removeDeleteID(id){
    $.confirm({
    title: 'Are you sure?',
    columnClass:"col-md-6",
    content: "you want to delete this item?",
    buttons: {
        formSubmit: {
            text: 'Submit',
            btnClass: 'btn-danger',
            action: function () {
                idArray.push(id);
                $("#deletedID").val(idArray);
                $("#deleteRow_"+id).remove();
            }
        },
        cancel: function () {
            //close
        },
    },
    onContentReady: function () {
        // bind to events
    }
});
}
</script>

@endsection