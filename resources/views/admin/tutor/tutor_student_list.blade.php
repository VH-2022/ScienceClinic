<table class="table table-bordered">

    <thead>

        <tr>

        <tr>

            <th style="white-space:nowrap">ID</th>

            <th  style="white-space:nowrap">Name</th>

            <th style="white-space:nowrap">Subejct Name</th>

            <th style="white-space:nowrap">Level</th>

            <th style="white-space:nowrap">Day</th>

            <th style="white-space:nowrap">Time </th>

            <th style="white-space:nowrap">Hours </th>

        </tr>

    </thead>

    <tbody>

        @php

        $i = $page * 10 - 9;

        @endphp

        @if (count($query) > 0)

        @foreach ($query as $val)
        <tr>

            <td style="white-space:nowrap">{{ $i++ }}</td>

            <td style="white-space:nowrap">{{ $val->userDetails->first_name ?: ''  }} {{ $val->userDetails->last_name ?: ''  }}</td>

            <td style="white-space:nowrap">{{ $val->subjectDetails->main_title ?: ''  }}</td>

            <td style="white-space:nowrap">{{ $val->levelDetails->title ?: ''  }}</td>

            <td style="white-space:nowrap; text-transform: capitalize;">{{ $val->tuition_day ?: ''  }}</td>

            <td>{{ $val->tuition_time }}</td>

            <td>{{ $val->teaching_hours }}</td>
        </tr>

        @endforeach

        @endif

        @if (count($query) == 0)

        <tr>

            <td align="center" colspan="5">No record available</td>

        </tr>

        @endif

    </tbody>

</table>