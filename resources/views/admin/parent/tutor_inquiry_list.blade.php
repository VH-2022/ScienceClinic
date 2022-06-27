<table class="table">

    <thead>

        <tr>

        <tr>

            <th>ID</th>
            <th>Subject Name </th>
            <th>Tuition Level </th>
            <th>Tuition Day </th>
            <th>Ideal Time</th>
            <th>Tutor Name</th>
            <th>Action</th>

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
            <td>
                @php 
                
                
                    if($val->payment_status == 'Pending'){
                        $payment_status = '<span class="badge badge-warning">Payment Pending</span>';
                    }else{
                        $payment_status = '<span class="badge badge-success">Payment Success</span>';
                    }
                @endphp
                @php 
                
                if($parentStatus != '' && $parentStatus != 'Pending' && $parentStatus != 'Rejected'){ @endphp
                @if($val->payment_link_flag == '0')
                    @if($val->hourly_rate !='' && $val->teaching_start_time !='' && $val->teaching_hours !='')
                        <a href="javascript:void(0);" onclick="editDetail('{{$val->id}}')" class="btn btn-success btn-sm">Edit Lesson</a>
    
                        <a href="javascript:void(0);" onclick="sendPaymentmail({{$val->id}})" class="btn btn-info btn-sm">Book Lesson</a>
                    @endif
                        
                    @else
                    
                        @php echo $payment_status; @endphp
    
                    @endif
                @php  } @endphp
                    
                
            </td>

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