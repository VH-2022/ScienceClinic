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

                            <h3 class="card-label font-weight-bolder text-dark">Text Books List</h3>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive" id="response_id">


                            <table class="table table-separate table-head-custom">

                                <thead>

                                    <tr>

                                        <th nowrap="nowrap"> ID</th>
                                        <th nowrap="nowrap"> Type</th>
                                        <th style="white-space: nowrap">Title </th>
                                        <th style="white-space: nowrap">Description</th>
                                        <th style="white-space: nowrap">Document</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @php



                                    $i = $page * 50 - 49;

                                    @endphp

                                    @if (count($query) > 0)

                                    @foreach ($query as $live_in)
                                    <tr>

                                        <td>

                                            {{ $i++ }}

                                        </td>
                                        <td>

                                            {{ $live_in->type }}

                                        </td>

                                        <td>

                                            {{ $live_in->text_book_title}}

                                        </td>



                                        <td>

                                            {!! Str::limit($live_in->text_book_description, 100) !!}

                                        </td>

                                        <td>
                                           
                                        </td>

                                    </tr>

                                    @endforeach



                                    @endif

                                    @if (count($query) == 0)

                                    <tr>

                                        <td colspan="6">No record available</td>

                                    </tr>

                                    @endif

                                </tbody>

                            </table>



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