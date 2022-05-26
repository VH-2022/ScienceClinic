<table class="table table-separate table-head-custom">

    <thead>

        <tr>

            <th nowrap="nowrap">ID</th>

            <th style="white-space: nowrap">Parent Name</th>
            <th style="white-space: nowrap">Email</th>
            <th style="white-space: nowrap">Phone</th>
            <th style="white-space: nowrap">Address</th>
            <th style="white-space: nowrap">Created Date</th>
            <th style="white-space: nowrap">Status</th>
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

            <td>{{$val->first_name}} {{$val->last_name}}</td>
            <td>{{$val->email}}</td>
            <td>{{$val->mobile_id}}</td>
            <td>{{$val->address1}}</td>
            <td>

                @if ($val->created_at != '')

                {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}

                @endif

            </td>
            <td>{{$val->status}}</td>
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