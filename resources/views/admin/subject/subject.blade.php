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
                            <h3 class="card-label font-weight-bolder text-dark">Subject List</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{route('subject-master.create')}}" class="btn btn-primary mr-2" style="background-color:#3498db !important">Add</a>
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
<script src="{{asset('assets/Modulejs/subject.js')}}"></script>
<script>
    var _AJAX_LIST = "{{url('subject-master-ajax-list')}}";
</script>

@endsection