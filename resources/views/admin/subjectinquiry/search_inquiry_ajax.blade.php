<table class="table table-separate table-head-custom">

    <thead>

        <tr>

            <th nowrap="nowrap">ID</th>

            <th style="white-space: nowrap">Tuition Often </th>
            <th style="white-space: nowrap">Subject Name</th>
            <th style="white-space: nowrap">Level Name</th>
            <th style="white-space: nowrap">Post Code</th>
            <th style="white-space: nowrap">Created Date</th>
        </tr>

    </thead>

    <tbody>

        @php

        $i = $page * 10 - 9;

        @endphp

        @if (count($query) > 0)

        @foreach ($query as $val)

        <tr>

            <td>{{ $i++ }}</td>

            <td>@if($val->tuition_often == null) N/A @else {{$val->tuition_often}} @endif</td>
            <td>@if($val->subject == null) N/A @else {{$val->subject}} @endif</td>
            <td>@if($val->level == null) N/A @else {{$val->level}} @endif</td>
            <td>@if($val->pincode == null) N/A @else {{$val->pincode}} @endif</td>
            <td>

                @if ($val->created_at != '')

                {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}

                @endif

            </td>

            <!-- <td>

                <a href="javascript:void(0)" onclick="editDetail('{{$val->id}}')" class="edit-details" data-id="{{$val->id}}}"><i class="fa fa-edit"></i></a>

                <a href="javascript:void(0)" onclick="deleteDetail('{{$val->id }}')" class="delete-details" data-id="{{$val->id}}}"><i class="fa fa-trash"></i></a>

            </td> -->

        </tr>

        @endforeach

        @endif

        @if (count($query) == 0)

        <tr>

            <td colspan="4">No record available</td>

        </tr>

        @endif

    </tbody>

</table>

{!! $query->withQueryString()->links('pagination::bootstrap-5') !!}