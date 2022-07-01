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

                            <h3 class="card-label font-weight-bolder text-dark">Lesson Payment</h3>

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


@endsection
@section('page-js')
<script>
    function ajaxList(page) {
        $('.ki-close').click();
        $.ajax({
            type: "GET",
            url: "{{route('parent-lesson-payment-ajax')}}",
            data: {
                'page': page
            },
            success: function(res) {
                $('#response_id').html("");
                $('#response_id').html(res);
            }
        })
    }
    ajaxList(1);
</script>
@endsection