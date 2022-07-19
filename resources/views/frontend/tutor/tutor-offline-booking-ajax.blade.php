<table class="table table-separate table-head-custom custom-table-td">

    <thead>

        <tr>

            <th nowrap="nowrap">ID</th>

            <th style="white-space: nowrap">Student Name</th>

            <th style="white-space: nowrap">Subject</th>

            <th style="white-space: nowrap">Level</th>

            <th>Day</th>

            <th>Time</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody>
        @php

        $i = $page * 10 - 9;

        @endphp
        @if(count($data) > 0)

        @foreach ($data as $val)
        <tr>

            <td >{{ $i++ }}</td>

            <td>{{ $val->userName }}</td>

            <td>{{ $val->subjectDetails->main_title }}</td>

            <td>{{ $val->levelDetails->title }}</td>

            <td style="text-transform: capitalize;">{{ $val->tuition_day }}</td>

            <td>{{ Utility::convertTime($val->teaching_start_time) }}</td>

            <td>
                <a href="javascript:void(0)" onclick="editDetail('{{$val->id}}')" class="edit-details" data-id="{{$val->id}}"><i class="fa fa-edit"></i></a>
            </td>

        </tr>

        @endforeach

        @else

        <tr>

            <td colspan="4">No record available</td>

        </tr>

        @endif

    </tbody>

</table>

{!! $data->render('pagination::bootstrap-5') !!}