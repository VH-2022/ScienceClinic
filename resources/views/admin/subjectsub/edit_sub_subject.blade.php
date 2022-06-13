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

            

                <div class="flex-row-fluid" >

                    <div class="card card-custom card-stretch">

                    

                        <div class="card-header py-3">

                            <div class="card-title align-items-start flex-column">

                                <h3 class="card-label font-weight-bolder text-dark">Edit Sub Subject</h3>

                            </div>

                        </div>

                    

                        <form class="form" id="submitid" method="post" action="{{url('sub-subject-master')}}/{{$basic_details->id}}" enctype="multipart/form-data">

                            @csrf

                            @method('put')

                            <input type="hidden" name="id" value="{{ $basic_details->id}}">

                            <div class="card-body">

                                <div class="card-title align-items-start flex-column">

                                    <h4 class="card-label font-weight-bolder text-dark">Banner Information</h4>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="exampleSelectd">Select Subject <span class="text-danger">*</span></label>

                                            <select class="form-control validate_field main_subject" name="main_subject" id="main_subject" data-msg="Subject">

                                            <option value="">Select Subject</option>

                                                @foreach($query as $val)

                                                    <option value="{{$val->id}}" @if(isset($basic_details->parent_id) && $basic_details->parent_id == $val->id) selected @endif>{{$val->main_title}}</option>

                                                @endforeach

                                            </select>

                                            <span class="form-text error main_subject_error">{{ $errors->useredit->first('main_subject')}}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Title <span class="text-danger">*</span></label>

                                            <input class="form-control validate_field" placeholder="Title" autocomplete="off" id="title" type="text" data-msg="Title" name="title" value="{{ $basic_details->main_title}}">

                                            <span class="form-text error title_error">{{ $errors->useredit->first('title')}}</span>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Sub Title</label>

                                            <input class="form-control validate_field" placeholder="Sub Title" autocomplete="off" id="sub_title" type="text" data-msg="Sub Title" name="sub_title"  value="{{ $basic_details->sub_title_one}}">

                                            <span class="form-text error sub_title_error">{{ $errors->useredit->first('sub_title')}}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>Sub Title 2</label>

                                            <input class="form-control validate_field" placeholder="Sub Title 2" autocomplete="off" id="sub_title_two" type="text" data-msg="Sub Title Two" name="sub_title_two" value="{{ $basic_details->sub_title_two}}">

                                            <span class="form-text error sub_title_two_error">{{ $errors->useredit->first('sub_title_two')}}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div id="solumailAddMore">



                                            @if(!empty($bannerSection[0]))

                                                

                                                @foreach($bannerSection as $key=> $val)

                                                    @php

                                                        $uniqid = uniqid();

                                                    @endphp

                                                    <div class="scopy_id" id="{{ $uniqid }}">

                                                        <div class="row">

                                                            <div class="col-md-6 mb-4">

                                                                <div class="form-group">

                                                                    <label> @if($key ==0) Title @endif</label>

                                                                    <input placeholder="Title" maxlength="255" class="form-control validate_field section_one_title_more{{ $uniqid }}_error" data-id="{{ $uniqid }}" autocomplete="off" id="section_one_title{{ $uniqid }}" type="text" data-msg="Section One Title" name="section_one_title_more[]" value="{{$val->title}}">

                                                                    <span class="form-text error section_one_title_more{{ $uniqid }}_error"></span>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-5 mb-4">

                                                                <div class="form-group">

                                                                    <label>@if($key ==0) Link  @endif</label>

                                                                    <input placeholder="Link" maxlength="255" class="form-control validate_field link_more{{ $uniqid }}_error" autocomplete="off" data-id="{{ $uniqid }}" id="link_more{{ $uniqid }}" type="text" data-msg="Link" name="link_more[]"  value="{{$val->link}}">

                                                                    <span class="form-text error link_more{{ $uniqid }}_error"></span>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-1 text-end p-0" style="@if(count($bannerSection) ==1) display:none @endif" id="remove_ids">

                                                                <a class="btn btn-danger  remove-btn1 mb-4" href="javascript:void(0)" onclick="removeSolution('{{ $uniqid }}');">Remove</a>

                                                            </div>

                                                        </div>



                                                    </div>

                                                @endforeach



                                            @else

                                            @php

                                            $uniqid = uniqid();

                                            @endphp

                                            <div class="scopy_id" id="{{ $uniqid }}">

                                                <div class="row">

                                                    <div class="col-md-6 mb-4">

                                                        <div class="form-group">

                                                            <label>Title</label>

                                                            <input placeholder="Title" class="form-control validate_field section_one_title_more{{ $uniqid }}_error" data-id="{{ $uniqid }}" autocomplete="off" id="section_one_title{{ $uniqid }}" type="text" data-msg="Section One Title" maxlength="255" name="section_one_title_more[]">

                                                            <span class="form-text error section_one_title_more{{ $uniqid }}_error"></span>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-5 mb-4">

                                                        <div class="form-group">

                                                            <label>Link</label>

                                                            <input placeholder="Link" class="form-control validate_field link_more{{ $uniqid }}_error" autocomplete="off" data-id="{{ $uniqid }}" id="link_more{{ $uniqid }}" type="text" data-msg="Link" maxlength="255" name="link_more[]">

                                                            <span class="form-text error link_more{{ $uniqid }}_error"></span>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-1 text-end p-0" style="display:none" id="remove_ids">

                                                        <a class="btn btn-danger  remove-btn1 mb-4" href="javascript:void(0)" onclick="removeSolution('{{ $uniqid }}');">Remove</a>

                                                    </div>

                                                </div>



                                            </div>

                                            @endif

                                           

                                            

                                        </div>

                                    </div>

                                    <div class="col-md-12 text-end">

                                        <a class="btn btn-primary float-right" href="javascript:void(0)" onclick="addMoreSolution();" style="width: 81px;">Add</a>

                                    </div>

                                </div>

                                <hr>

                                <div class="card-title align-items-start flex-column">

                                    <h4 class="card-label font-weight-bolder text-dark">Section One</h4>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Title</label>

                                            <input placeholder="Title" class="form-control validate_field" autocomplete="off" id="title_section_one" type="text" data-msg="Title" name="title_section_one" value="{{ $basic_details->title}}">

                                            <span class="form-text error title_section_one_error">{{ $errors->useredit->first('title_section_one')}}</span>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="row">

                                            <div class="col-md-10">

                                                <div class="form-group">

                                                    <label>Image</label>

                                                    <div>

                                                        <input type="file" name="subject_image" data-msg="Image" accept=".png, .jpg, .jpeg">

                                                        <span class="form-text error subject_image_error"></span>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-2">
                                                @if($basic_details->image)
                                                    <img src="{{ $basic_details->image}}" style="width:60px;height:60px;">
                                                @endif

                                            </div>

                                        </div>

                                        

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>Description</label>

                                            <textarea placeholder="Description" name="subject_description" id="subject_description" data-msg="Description" value="{{ $basic_details->description}}">{{ $basic_details->description}}</textarea>

                                            <span class="form-text error subject_description_error">{{ $errors->useredit->first('subject_description')}}</span>

                                        </div>

                                    </div>

                                </div>

                                <hr>

                                <div class="card-title align-items-start flex-column">

                                    <h4 class="card-label font-weight-bolder text-dark">Section Two</h4>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div id="solumailAddMoreSectionTwo">

                                        @if(!empty($SectionTwo[0]))

                                                

                                                @foreach($SectionTwo as $key=> $vals)

                                                    @php

                                                        $uniqid = uniqid();

                                                    @endphp

                                                    <div class="scopy_id_sec" id="{{ $uniqid }}">

                                                        <div class="row">

                                                            <div class="col-md-6 mb-4">

                                                                <div class="form-group">

                                                                    <label>Title</label>

                                                                    <input placeholder="Title" class="form-control validate_field title_section_two{{ $uniqid }}_error" autocomplete="off" data-id="{{ $uniqid }}" id="title_section_two{{ $uniqid }}" type="text" maxlength="255" data-msg="Title Section Two" name="title_section_two[]" value="{{ $vals->title}}">

                                                                    <span class="form-text error title_section_two{{ $uniqid }}_error"></span>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-5 mb-4">

                                                                <div class="form-group">

                                                                    <label>Description</label>

                                                                    <textarea type="text" placeholder="Description" data-id="{{ $uniqid }}" class="form-control validate_field description_section_two{{ $uniqid }}" name="description_section_two[]" id="description_section_two{{ $uniqid }}" value="{{ $vals->description}}"  data-msg="Description">{{ $vals->description}}</textarea>

                                                                    <span class="form-text error description_section_two{{ $uniqid }}_error"></span>

                                                                </div>

                                                            </div>



                                                            <div class="col-md-1 text-end p-0" style="@if(count($SectionTwo) ==1) display:none @endif" id="remove_ids_section_two">

                                                                <a class="btn btn-danger  remove-btn1 mb-4" href="javascript:void(0)" onclick="removeSolution('{{ $uniqid }}');">Remove</a>

                                                            </div>

                                                        </div>



                                                    </div>

                                                    <script> 

                                                    CKEDITOR.replace( 'description_section_two{{ $uniqid }}' );

                                                    

                                                    </script>

                                                    @endforeach

                                                    

                                        @else

                                        @php

                                            $uniqid = uniqid();

                                            @endphp

                                            <div class="scopy_id_sec" id="{{ $uniqid }}">

                                                <div class="row">

                                                    <div class="col-md-6 mb-4">

                                                        <div class="form-group">

                                                            <label>Title</label>

                                                            <input placeholder="Title" class="form-control validate_field title_section_two{{ $uniqid }}_error" autocomplete="off" data-id="{{ $uniqid }}" id="title_section_two{{ $uniqid }}" type="text" data-msg="Title Section Two" name="title_section_two[]">

                                                            <span class="form-text error title_section_two{{ $uniqid }}_error"></span>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-5 mb-4">

                                                        <div class="form-group">

                                                            <label>Description</label>

                                                            <textarea type="text" placeholder="Description" data-id="{{ $uniqid }}" class="form-control validate_field description_section_two{{ $uniqid }}" name="description_section_two[]" id="description_section_two"  data-msg="Description"></textarea>

                                                            <span class="form-text error description_section_two{{ $uniqid }}_error"></span>

                                                        </div>

                                                    </div>



                                                    <div class="col-md-1 text-end p-0" style="display:none" id="remove_ids_section_two">

                                                        <a class="btn btn-danger  remove-btn1 mb-4" href="javascript:void(0)" onclick="removeSolutionNew('{{ $uniqid }}');">Remove</a>

                                                    </div>

                                                </div>



                                            </div>

                                        @endif

                                            

                                        </div>

                                    </div>

                                    <div class="col-md-12 text-end">

                                        <a class="btn btn-primary float-right" href="javascript:void(0)" onclick="addMoreSolutionSectionTwo();" style="width: 81px;">Add</a>

                                    </div>

                                </div>

                            </div>

                            <div class="card-footer">

                                <button type="button" id="edit_subject" class="btn btn-primary mr-2" style="background-color:#3498db !important">Submit</button>

                                <a class="btn btn-secondary" href="{{ url('sub-subject-master')}}">Cancel</a>

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

<script src="{{asset('assets/Modulejs/subsubject.js')}}"></script>



<script>

    var _Add_SUBJECT = "{{route('sub-subject-master.store')}}";

</script>

<script>

    // Class definition

    var uniqid = '{{ uniqid() }}';

    

    CKEDITOR.replace( 'subject_description' );

    CKEDITOR.replace( 'description_section_two'+uniqid );



    function addMoreSolution() {

        var html_solution = '';

        var uniqid = '{{ uniqid() }}';

        var copyLength = $('.scopy_id').length;

        var length = uniqid + '' + copyLength + 1;

        var lengths = "'" + length + "'";

        var htmls = '<div class="scopy_id" id="' + length + '">' +

            '<div class="row">' +

            '<div class="col-md-6 mb-4"><div class="form-group"><input placeholder="Title" class="form-control validate_field section_one_title_more{{ $uniqid }}_error" data-id="{{ $uniqid }}" autocomplete="off" id="section_one_title{{ $uniqid }}" type="text" data-msg="Section One Title" name="section_one_title_more[]" maxlength="255"><span class="form-text error section_one_title_more{{ $uniqid }}_error"></span></div></div>' +

            '<div class="col-md-5 mb-4"><div class="form-group"><input placeholder="Link" class="form-control validate_field link_more{{ $uniqid }}_error" autocomplete="off" data-id="{{ $uniqid }}" id="link_more{{ $uniqid }}" type="text" data-msg="Link" name="link_more[]"><span class="form-text error link_more{{ $uniqid }}_error" maxlength="255"></span></div></div>' +

            '<div class="col-md-1 text-end p-0" id="remove_ids">' +

            '<a class="btn btn-danger" href="javascript:void(0)" onclick="removeSolution(' + lengths +

            ');">Remove</a>' +

            '</div>'+

            '</div>'+

            '</div>'

        $('#solumailAddMore').append(htmls);

        if ($('.scopy_id').length > 1) {

            $('#remove_ids').attr('style', '');

        }

    }



    function addMoreSolutionSectionTwo() {

        var html_solution = '';

        var uniqid = '{{ uniqid() }}';

        var copyLength = $('.scopy_id_sec').length;

        var length = Math.floor(100000000 + Math.random() * 900000000);;

        var lengths = "'" + length + "'";

        var htmls = '<div class="scopy_id_sec" id="' + length + '">' +

            '<div class="row">' +

            '<div class="col-md-6 mb-4"><div class="form-group"><input placeholder="Title" class="form-control validate_field title_section_two'+uniqid+'" autocomplete="off" data-id="'+uniqid+'" id="title_section_two'+uniqid+'" type="text" data-msg="Title Section Two" name="title_section_two[]" maxlength="255"><span class="form-text error title_section_two'+uniqid+'_error"></span> </div></div>' +

            '<div class="col-md-5 mb-4"><div class="form-group"><textarea type="text" placeholder="Descritpion" data-id="'+length+'" class="form-control validate_field description_section_two'+length+'" name="description_section_two[]" id="description_section_two'+length+'" data-msg="Description"></textarea><span class="form-text error description_section_two'+length+'_error"></span></div></div>' +

            '<div class="col-md-1 text-end p-0" id="remove_ids_section_two">' +

            '<a class="btn btn-danger" href="javascript:void(0)" onclick="removeSolutionSection(' + lengths +

            ');">Remove</a>' +

            '</div>' +

            '</div>'



            +

            '</div>'

        $('#solumailAddMoreSectionTwo').append(htmls);

        if ($('.scopy_id_sec').length > 1) {

            $('#remove_ids_section_two').attr('style', '');

            var id= '#description_section_two'+uniqid;

            

            

        }

        CKEDITOR.replace( 'description_section_two'+length );

    }





    function removeSolution(id) {

        var copyLength = $('.scopy_id').length;

        $('#' + id).remove();

        if ($('.scopy_id').length == 1) {

            $('#remove_ids').attr('style', 'display:none');

        }



    }



    function removeSolutionSection(id){

        var copyLength = $('.scopy_id_sec').length;

        $('#' + id).remove();

        if ($('.scopy_id_sec').length == 1) {

            $('#remove_ids_section_two').attr('style', 'display:none');

        }

    }

</script>



@endsection

