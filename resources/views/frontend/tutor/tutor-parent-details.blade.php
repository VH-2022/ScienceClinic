@extends('layouts.master')

@section('content')
<div class="d-flex flex-column-fluid">

    <!--begin::Container-->

    <div class="container-fluid">

        <!--begin::Subject List-->

        <div class="d-flex flex-row">

            <!--begin::Content-->

            <div class="flex-row-fluid" id="personam_id">



                <!--begin::Header-->

                <div class="card card-custom gutter-b">

                    <div class="card-header">

                        <div class="card-title">

                            <span class="nav-profile-name">Parent Detail</span>

                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>

                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>Full Name: </strong>
                                    {{$parentData->first_name}} {{$parentData->last_name}}

                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>Email: </strong>
                                    {{$parentData->email}}
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>Mobile No: </strong>
                                    {{$parentData->mobile_id}}
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="d-flex mb-4">

                                    <strong>Address1: </strong>
                                    {{$parentData->address1}}
                                </div>

                            </div>





                        </div>

                    </div>

                </div>



                <!--begin::Header-->

                <div class="card card-custom">

                    <div class="card-header">

                        <div class="card-title tutor">

                            <ul class="nav nav-pills nav-fill">

                                <li class="nav-item">

                                    <a class="nav-link active" onclick="addSubjectList()" href="#subjectlist" data-toggle="tab">
                                        <span class="nav-text">Subject List</span>
                                    </a>

                                </li>
                            </ul>

                        </div>

                    </div>
                    <div class="tab-content" id="tabs">

                        <div class="tab-pane active" id="subjectlist">

                            <span id="responsive_id"></span>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script>
    $(document).ready(function() {
        addSubjectList();
    });

    function addSubjectList() {

        $.ajax({

            type: "GET",

            url: "{{ route('parent-subject-details') }}",

            data: {

            },

            success: function(res) {

                $('#responsive_id').html("");

                $('#responsive_id').html(res);

            }

        })
    }


    function addTeacingHours(id) {

        $.confirm({
            title: 'Add Teaching Hours',
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Enter Hours</label>' +
                '<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" maxlength="3" placeholder="Your Hours" class="hours form-control number-only" required />' +
                '<span class="text-danger" id="error_hours"></span>' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function() {
                        var hours = this.$content.find('.hours').val();
                        if (hours.trim() == '') {
                            $('#error_hours').html("Please enter teaching hours");
                            return false;
                        }

                        $.ajax({

                            type: "post",

                            url: "{{ route('add-teaching-hours') }}",
                            data: {
                                'id': id,
                                'hours': hours,
                                "_token": "{{ csrf_token() }}"

                            },

                            success: function(res) {
                                if (res.status == 1) {
                                    toastr.success(res.error_msg);
                                    addSubjectList(1);
                                } else {
                                    toastr.error(res.error_msg);
                                }
                            }

                        })
                    }
                },
                cancel: function() {

                },
            },
            onContentReady: function() {

                var jc = this;
                this.$content.find('form').on('submit', function(e) {

                    e.preventDefault();
                    jc.$$formSubmit.trigger('click');
                });
            }
        });
    }
</script>
@endsection