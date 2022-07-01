@extends('layouts.master')

@section('content')
<link href="{{ asset('assets/css/pages/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">

<style>
    .daterangepicker {

        z-index: 999999 !important;

    }
</style>
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
                            <h3 class="card-label font-weight-bolder text-dark">Tutors Payment History</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-pills personaltab-ul" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="personal-info-tab" data-toggle="pill" onclick="window.location.href='tutor-payment-history'" role="tab" aria-controls="pills-home" aria-selected="true">Paid</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="pills-profile" aria-selected="false">Unpaid</a>
                            </li>

                        </ul>
                        <button class="btn btn-success" id="multipay" style="background-color: #1BC5BD !important;border-color: #1BC5BD !important; display: none;">Pay</button>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">

                            </div>
                            <div class="tab-pane fade show active" id="password" role="tabpanel" aria-labelledby="password-tab">

                                <div class="prime-container">
                                    <div class="table-responsive" id="response_id">

                                    </div>
                                </div>
                            </div>

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

<div id="kt_demo_panel" class="offcanvas offcanvas-right p-10 ">

    <!--begin::Header-->

    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7" kt-hidden-height="47">

        <h4 class="font-weight-bold m-0">Search</h4>

        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">

            <i class="ki ki-close icon-xs text-muted"></i>

        </a>

    </div>

    <!--end::Header-->

    <!--begin::Content-->

    <div class="offcanvas-content">

        <!--begin::Wrapper-->
        <div class="form-group row">

            <label class="col-4 col-form-label">Name</label>

            <div class="col-8">

                <input class="form-control" placeHolder="Enter Search Name" type="text" name="name" id="name">

            </div>

        </div>

        <div class="form-group row">

            <label class="col-4 col-form-label">Created Date</label>

            <div class="col-8">

                <div class="input-group" id="kt_daterangepicker_3">

                    <input type="text" name="created_date" id="created_date" class="form-control" placeholder="Created Date">

                </div>

            </div>

        </div>

        <!--end::Wrapper-->

        <!--begin::Purchase-->

        <div class="offcanvas-footer" kt-hidden-height="38">

            <div class="row">

                <div class="col-6">

                    <a class="btn btn-block btn-danger btn-shadow font-weight-bolder text-uppercase search_id">Apply</a>



                </div>

                <div class="col-6">

                    <a class="btn btn-block btn-secondary btn-shadow font-weight-bolder text-uppercase clear">Cancel</a>

                </div>

            </div>

        </div>

        <!--end::Purchase-->

    </div>

    <!--end::Content-->

</div>

@endsection

@section('page-js')


<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.2.9') }}"></script>

<script src="{{ asset('assets/js/pages/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#select_all').on('click', function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('.checkbox').on('click', function() {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });
    });

    function checkVal() {
        if ($("input[name='checkboxval']:checked").length > 1) {
            $('#multipay').css("display", "block");
        } else {
            $('#multipay').css("display", "none");
        }

    }




    function tutor_pay_amount(Id, tutorAmount) {
        event.preventDefault();
        $.confirm({
            title: 'Pay!',
            content: 'you want to pay this tutor?',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-danger',
                    action: function() {
                        $.ajax({
                            method: "POST",
                            url: "{{ route('tutor-pay-amounts') }}",
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'id': Id,
                                'tutorAmount': tutorAmount,
                            }
                        }).done(function(r) {
                            toastr.success(r.error_msg);
                            ajaxList(1);
                        }).fail(function() {
                            toastr.error('Sorry, something went wrong. Please try again.');
                        });



                    }

                }

            }

        });
    }





    function ajaxUnpaidList(page) {

        var name = $('#name').val();
        var created_date = $('#created_date').val();
        $('.ki-close').click();

        $.ajax({

            type: "GET",

            url: "{{route('tutor-paid-payment-list-ajax')}}",

            data: {

                'name': name,
                'page': page,
                'created_date': created_date

            },

            success: function(res) {
                $('#response_id').html("");

                $('#response_id').html(res);

            }
        })

    }

    ajaxUnpaidList(1);

    $('body').on('click', '.pagination a', function(event) {

        $('li').removeClass('active');

        $(this).parent('li').addClass('active');

        event.preventDefault();

        var myurl = $(this).attr('href');

        var page = $(this).attr('href').split('page=')[1];

        ajaxUnpaidList(page);


    });
</script>

<script type="text/javascript">
    function isName(event) {

        var regex = new RegExp("^[a-zA-Z \s]+$");

        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

        if (!regex.test(key)) {

            event.preventDefault();

            return false;

        }

    }



    $(function() {

        var start = moment().subtract(29, 'days');

        var end = moment();

        $('#kt_daterangepicker_3').daterangepicker({

            buttonClasses: ' btn',

            applyClass: 'btn-primary',

            cancelClass: 'btn-secondary',

            startDate: start,

            endDate: end,

            ranges: {

                'Today': [moment(), moment()],

                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],

                'Last 7 Days': [moment().subtract(6, 'days'), moment()],

                'Last 30 Days': [moment().subtract(29, 'days'), moment()],

                'This Month': [moment().startOf('month'), moment().endOf('month')],

                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]

            }

        }, function(start, end, label) {

            $('#kt_daterangepicker_3 .form-control').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));

        });

    })
    $('.clear').click(function(e) {
        $('#name').val("");

        $('#created_date').val("");



        ajaxUnpaidList(1);

    })

    $('.search_id').click(function(e) {
        ajaxUnpaidList(1);
    });
</script>

@endsection