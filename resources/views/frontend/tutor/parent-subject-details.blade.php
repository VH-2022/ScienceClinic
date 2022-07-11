<table class="table">

    <thead>

        <tr>

        <tr>

            <th>ID</th>
            <th>Subject Name </th>
            <th>Tuition Level </th>
            <th>Tuition Day </th>
            <th>Ideal Time</th>
            <th>Teaching Hours</th>
            <th>Hourly Rate</th>
            <th>Action</th>

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
                {{$val->teaching_hours}}
            </td>
            <td>
                {{$val->hourly_rate}}
            </td>
            <span id="desc{{$val->id}}" style="display:none">{{ $val->tuition_time}}</span>
            <td>
                @if($val->teaching_hours == '')
                <button class="btn btn-primary" onclick="addTeachingHours({{$val->id}});">Add</button>
                @else
                @php 
                    $currentDate = date('Y-m-d H:i:s');

                    $bookingDatetime = $val->booking_date.' '. $val->teaching_start_time;
                    $currentTime = date('Y-m-d H:i:s', strtotime('-15 minutes', strtotime($bookingDatetime)));
                    $endDatetime = date('Y-m-d H:i:s', strtotime('+ 1 hours',strtotime($val->teaching_start_time)));

                        if (($currentDate >= $currentTime) && ($currentDate <= $endDatetime)){ 
                            if($val->attend_class == '1' && $val->schedule_class == 1 ){ echo '<span class="text-success">A Link has been Sent on Mail. Please Check Mail.</span>';  } elseif($val->attend_class == '1'){ echo '<span class="text-success">Attended</span>'; } else {    
                    @endphp
                        
                    @if($val->payment_status == "Success")
                        <button class="btn btn-primary" onclick="attendClass({{$val->id}},{{$val->subject_id}},{{$val->teaching_type}});">Attend</button>
                    @endif
                   @php } } 
                @endphp
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