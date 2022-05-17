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
                                <h3 class="card-label font-weight-bolder text-dark">Tutor Master List</h3>
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
        var _AJAX_LIST = "{{ url('tutor-master-ajax') }}";

        function ajaxList(page) {
            var first_name = $('#first_name').val();
            var email = $('#email').val();
            var mobile_id = $('#mobile_id').val();
            var created_date = $('#kt_daterangepicker_6').val();

            $.ajax({
                type: "GET",
                url: _AJAX_LIST,
                data: {
                    'first_name': first_name,
                    'email': email,
                    'mobile_id': mobile_id,
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
    </script>
    <script type="text/javascript">
        function functionDelete(Id) {
            event.preventDefault(); // prevent form submit
            $.confirm({
                title: 'Delete!',
                content: '"Are you sure Delete?"',
                buttons: {
                    confirm: function() {
                        $.ajax({
                            url: "{{ url('tutor-master') }}/" + Id,
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: "DELETE",

                            },
                            success: function(response) {
                                toastr.success(response.message);
                                ajaxList(1);
                            }
                        });
                    },
                    cancel: function() {}
                }
            });
        }
</script>
@endsection