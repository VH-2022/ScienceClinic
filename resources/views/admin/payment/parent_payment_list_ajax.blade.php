<table class="table table-separate table-head-custom ">

    <thead>

        <tr>

            <th nowrap="nowrap">ID</th>

            <th style="white-space: nowrap">Parent Name</th>
            <th style="white-space: nowrap">Tutor Name</th>
            <th style="white-space: nowrap">Subject Name</th>
            <th style="white-space: nowrap">Level</th>
            <th style="white-space: nowrap">Pay Amount</th>
            <th style="white-space: nowrap">Pay Type</th>
            <th style="white-space: nowrap">Pay Status</th>
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

            <td>{{isset($val->userDetails->first_name) ? $val->userDetails->first_name :''}} {{isset($val->userDetails->last_name) ? $val->userDetails->last_name :''}}</td>
            <td>{{isset($val->parentDetail->tutorDetails->first_name) ? $val->parentDetail->tutorDetails->first_name :''}} {{isset($val->parentDetail->tutorDetails->last_name) ? $val->parentDetail->tutorDetails->last_name : ''}}</td>
            <td>{{isset($val->parentDetail->subjectDetails->main_title) ? $val->parentDetail->subjectDetails->main_title :''}}</td>
            <td>{{isset($val->parentDetail->levelDetails->title) ? $val->parentDetail->levelDetails->title :''}}</td>
            <td>{{$val->pay_amount}}</td>
            <td>{{ucfirst($val->payment_type)}}</td>
            
            <td> @if($val->payment_status =='pending')
                <span class="badge badge-primary">Pending</span>
                @else
                <span class="badge badge-success">Success</span>
                @endif
            </td>
            <td>
                @if ($val->created_at != '')
                    {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}
                @endif
               
            </td>


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