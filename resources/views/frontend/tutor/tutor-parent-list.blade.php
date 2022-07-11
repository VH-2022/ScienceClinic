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

                            <h3 class="card-label font-weight-bolder text-dark">Parents List</h3>

                        </div>


                    </div>

                    <div class="card-body">

                        <table class="table table-separate table-head-custom">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Parent First Name</th>
                                    <th>Parent Last Name</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>


                                @if (count($parentslist) > 0)
                                @php $temp = 1; @endphp
                                @foreach($parentslist as $value)
                                <tr>
                                    <td>{{$temp}}</td>
                                    <td>{{isset($value->userDetails->first_name) ? $value->userDetails->first_name :''}}</td>
                                    <td>{{isset($value->userDetails->last_name) ? $value->userDetails->last_name :''}}</td>
                                    <td>{{isset($value->userDetails->address1) ? Str::limit($value->userDetails->address1, 20) :''}}</td>
                                    <td>
                                        <a href="{{route('tutor-parent-details',$value->user_id)}}"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @php $temp++; @endphp
                                @endforeach
                                @endif

                                @if (count($parentslist) == 0)

                                <tr>

                                    <td colspan="4">No record available</td>

                                </tr>

                                @endif
                            </tbody>
                        </table>
                        {!! $parentslist->withQueryString()->links('pagination::bootstrap-5') !!}

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
@endsection