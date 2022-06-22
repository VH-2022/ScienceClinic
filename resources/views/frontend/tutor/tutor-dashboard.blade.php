@extends('layouts.master')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Subheader-->

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">

        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

            <!--begin::Info-->

            <div class="mr-2 w-100">
                <div class="row">
                    <div class="col-md-12">
                        <!--begin::Page Title-->
                        @php
                        date_default_timezone_set("Europe/London");
                        $h = date('G');
                        $val = '';
                        @endphp
                        @if($h>=5 && $h<=11) @php $val="Good morning" ; @endphp @elseif($h>=12 && $h<=15) @php $val="Good afternoon" ; @endphp @else @php $val="Good evening" ; @endphp @endif <div class="row">
                                <div class="col-md-6">
                                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="text-dark font-weight-bold mt-2 mb-2 mr-5 greeting-text">{{$val}} {{Auth::user()->first_name}}</h4>
                                </div>
                    </div>
                </div>
            </div>
            <!--end::Page Title-->

        </div>

        <!--end::Info-->

    </div>

</div>

<!--end::Subheader-->

<!--begin::Entry-->

<div class="d-flex flex-column-fluid">

    <!--begin::Container-->

    <div class="container-fluid">

        <!--begin::Dashboard-->
        <div class="d-flex flex-row">

            <!--begin::Content-->

            <div class="flex-row-fluid" id="personam_id">

                <div class="card card-custom card-stretch">

                    <!--begin::Header-->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-10">
                                <h5>You must have a DBS less than a year old or be on an update serve for your account to be approved. </h5>
                                <div class="apply-details-inner">
                                    <div class="ml-4">
                                        <input class="form-check-input example" type="checkbox" id="valid-dbs" name="dbs" value="1" @if(Auth::user()->valid_dbs == 1) checked @endif onclick="dbsData(1)">
                                        <label class="form-check-label">I have a valid DBS</label>
                                    </div>
                                </div>
                                <div class="apply-details-inner">
                                    <div class="ml-4">
                                        <input class="form-check-input example" type="checkbox" id="no-valid-dbs" name="dbs" @if(Auth::user()->valid_dbs == 0) checked @endif onclick="dbsData(0)" value="0">
                                        <label class="form-check-label">I have no valid DBS</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="apply-main">
                                    <h5>Apply for an Enhanced DBS</h5>
                                    <div class="apply-details">
                                        <div class="apply-details-inner">
                                            <i class="fa fa-check mr-2"></i>
                                            <div>
                                                We can process your DBS application and verify your documents.
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <button class="btn start-dbs btn-primary">
                                    Start DBS Application
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!--end::Content-->

        </div>
        <!--end::Dashboard-->

    </div>

    <!--end::Container-->

</div>

<!--end::Entry-->

</div>

@endsection

@section('page-js')
<script>
    $('input.example').on('change', function() {
        $('input.example').not(this).prop('checked', false);
    });

    function dbsData(value) {
        $.ajax({
            url: "{{route('change-dbs')}}",
            type: 'POST',
            data: {
                'dbs': value,
                "_token": "{{ csrf_token() }}"
            },
            success: function(result) {
                if (result.status == 1) {
                    toastr.success(result.error_msg);
                } else {
                    toastr.error(result.error_msg);
                }
            }
        });
    }
</script>
@endsection