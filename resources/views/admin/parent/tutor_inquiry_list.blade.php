<table class="table">

    <thead>

        <tr>

        <tr>

            <th>ID</th>



            <th>Subject Name </th>

            <th>Tuition Level </th>

            <th>Tuition Day </th>

            <th>Idel Time</th>
            <th>Tutor Name</th>

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

            <td>{{ $val->subjectDetails->main_title }}</td>

            <td>{{ $val->levelDetails->title }}</td>

            <td>{{$val->tuition_day}}</td>

            <td>
                {{$val->tuition_time}}
            </td>
            <td>{{$val->tutorDetails ? $val->tutorDetails->first_name : ''}} {{$val->tutorDetails ? $val->tutorDetails->last_name : ''}}</td>

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