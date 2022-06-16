<table class="table">

    <thead>

        <tr>
            <th>ID</th>

            <th>Subject Name</th>
            <th>Level Name</th>


            <th>Created Date</th>
            <th>Hourly Rate</th>

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


            <td>{{ $val->main_title }}</td>
            <td>{{ $val->level_name }}</td>

            <td>

                @if ($val->created_at != '')

                {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}

                @endif

            </td>
            <td>@if($val->hourly_rate == '')
                <button class="btn btn-primary" onclick="addhourlyrate({{$val->subject_id}});">Add</button>
                @else
                {{ $val->hourly_rate }}
                @endif
            </td>


        </tr>

        @endforeach

        @endif

        @if (count($query) == 0)

        <tr>

            <td align="center" colspan="4">No record available</td>

        </tr>

        @endif

    </tbody>

</table>