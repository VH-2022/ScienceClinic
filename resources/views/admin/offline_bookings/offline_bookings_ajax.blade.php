<table class="table table-separate table-head-custom ">

    <thead>

        <tr>

            <th nowrap="nowrap">ID</th>

            <th style="white-space: nowrap">Student Name</th>
            <th style="white-space: nowrap">Tutor Name</th>
            <th style="white-space: nowrap">Subject Name</th>
            <th style="white-space: nowrap">Level</th>
            <th style="white-space: nowrap">Day</th>
            <th style="white-space: nowrap">Time</th>

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

            <td>{{$val->user_name}}</td>
            <td>{{$val->tutorDetails->first_name}}</td>
            <td>{{$val->subjectDetails->main_title}}</td>
            <td class="parent-address">{{$val->levelDetails->title}}</td>
            <td style="text-transform: capitalize;">{{$val->tuition_day}}</td>
            <td>{{Utility::convertTime($val->teaching_start_time)}}</td>
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