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
                            <h3 class="card-label font-weight-bolder text-dark">Student who have left you feedback</h3>
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
<script src="{{ asset('assets/js/pages/jquery-confirmation/js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.2.9') }}"></script>
<script src="{{ asset('assets/js/pages/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
    var _AJAX_LIST = "{{ route('tutor-feedback-ajax') }}";

    function ajaxList(page) {
        $('.ki-close').click();
        $.ajax({
            type: "GET",
            url: _AJAX_LIST,
            data: {
                'page': page,
            },
            success: function(res) {
                $('#response_id').html("");
                $('#response_id').html(res);
            }

        })
    }

    ajaxList(1);
    function viewDetail(id){
        var htmls = $('#desc'+id).html();
        $.dialog({
            title: 'Description',
            content: htmls,
        });
    }
</script>
@endsection