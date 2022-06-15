<table class="table table-separate table-head-custom">
    <thead>
        <tr>
            <th nowrap="nowrap">ID</th>
            <th style="white-space: nowrap">Name </th>
            <th style="white-space: nowrap">Email </th>
            <th style="white-space: nowrap">User Type </th>
            <th style="white-space: nowrap">Message </th>
            <th style="white-space: nowrap">Created Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = $page * 10 - 9;
           
        @endphp
         @if (count($query) > 0)
        @foreach ($query as $val)
        @php
        $userType ='';
            if($val->userDetails->type == '2'){
                $userType ='<span class="badge badge-primary">Tutor</span>';
            }else if($val->userDetails->type == '3'){
                $userType ='<span class="badge badge-success">Parent</span>';
            }
        @endphp
        <span id="desc{{$val->id}}" style="display:none">{{ $val->support_msg}}</span>
            <tr>
                <td style="white-space: nowrap">{{ $i++ }}</td>
                <td style="white-space: nowrap">{{ $val->userDetails->first_name }}</td>
                <td style="white-space: nowrap">{{ $val->userDetails->email }}</td>
                <td style="white-space: nowrap">{!!  $userType !!}</td>
                <td style="white-space: nowrap">{{ strlen($val->support_msg) > 50 ? substr($val->support_msg,0,50)."..." :$val->support_msg }}</td>
                <td style="white-space: nowrap">
                    @if ($val->created_at != '')
                        {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}
                    @endif
                </td>
                <td style="white-space: nowrap">
                    <a href="javascript:void(0)" class="view-detail" data-id="{{ $val->id}}"><i class="fa fa-eye"></i></a>
               
                </td>
            </tr>
        @endforeach
        @endif
        @if (count($query) == 0)
                <tr>
                    <td colspan="9">No record available</td>
                </tr>
            @endif
    </tbody>
</table>
{!! $query->withQueryString()->links('pagination::bootstrap-5') !!}

