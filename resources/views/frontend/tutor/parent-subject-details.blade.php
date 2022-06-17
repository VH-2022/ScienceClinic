<table class="table">

    <thead>

        <tr>

        <tr>

            <th>ID</th>
            <th>Subject Name </th>
            <th>Tuition Level </th>
            <th>Tuition Day </th>
            <th>Ideal Time</th>

            <th>Add Hours</th>

        </tr>

    </thead>

    <tbody>

        @php

        $i = 1;

        @endphp

        @if (count($query) > 0)

        @foreach ($query as $val)

        <tr>

            <td>{{ $i }}</td>

            <td>{{ $val->subjectDetails->main_title }}</td>

            <td>{{ $val->levelDetails->title }}</td>

            <td>{{$val->tuition_day}}</td>

            <td>
                {{$val->tuition_time}}
            </td>

            <td>
                @if($val->teaching_hours == '')
                <button class="btn btn-primary" onclick="addTeacingHours({{$val->id}});">Add Hours</button>
                @else
                {{$val->teaching_hours}}
                @endif
            </td>

        </tr>
        @php

        $i++;

        @endphp
        @endforeach

        @endif

        @if (count($query) == 0)

        <tr>

            <td align="center" colspan="5">No record available</td>

        </tr>

        @endif

    </tbody>

</table>