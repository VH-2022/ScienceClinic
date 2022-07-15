<table class="table table-separate table-head-custom ">

    <thead>

        <tr>

            <th nowrap="nowrap">ID</th>
            <th style="white-space: nowrap">Tutor Name</th>
            <th style="white-space: nowrap">Parent Name</th>
            <th style="white-space: nowrap">Day of Tution</th>
            <th style="white-space: nowrap">Time of Tution</th>
            <th style="white-space: nowrap">Rate</th>
            <th style="white-space: nowrap">Commission</th>
            <th style="white-space: nowrap">Month</th>
            <th style="white-space: nowrap">Amount to be Paid</th>
        </tr>

    </thead>

    <tbody>

        @php

        $i = $page * 10 - 9;

        @endphp

        @if (count($query) > 0)

        @foreach ($query as $val)
        @php $percentage = 100 / $val->pay_amount;
            $tutorAmount = $val->pay_amount - $val->total_commision;
        @endphp
        <tr>

            <td>{{ $i++ }}</td>
            <td>{{isset($val->parentDetail->tutorDetails->first_name) ? $val->parentDetail->tutorDetails->first_name :''}}</td>
            <td>{{isset($val->userDetails->first_name) ? $val->userDetails->first_name :''}} {{isset($val->userDetails->last_name) ? $val->userDetails->last_name :''}}</td>
            <td>{{isset($val->parentDetail->tuition_day) ? $val->parentDetail->tuition_day :''}}</td>
            <td>{{isset($val->parentDetail->tuition_time) ? $val->parentDetail->tuition_time :''}}</td>
            <td>{{$val->pay_amount}}</td>
            <td>{{number_format($percentage)}}%</td>
            <td>
                @if ($val->created_at != '')
                    {{ date('m', strtotime($val->created_at)) }}
                @endif
            </td>
            <td>{{$tutorAmount}}</td>
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