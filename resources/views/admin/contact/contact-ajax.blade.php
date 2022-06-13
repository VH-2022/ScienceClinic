<table class="table table-separate table-head-custom">
    <thead>
        <tr>
            <th nowrap="nowrap">ID</th>
            <th style="white-space: nowrap">Name </th>
            <th style="white-space: nowrap">Phone No </th>
            <th style="white-space: nowrap">Tutor Type </th>
            <th style="white-space: nowrap">Email </th>
            <th style="white-space: nowrap">address </th>
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
        <span id="desc{{$val->id}}" style="display:none">{{ $val->message}}</span>
            <tr>
                <td style="white-space: nowrap">{{ $i++ }}</td>
                <td style="white-space: nowrap">{{ $val->name }}</td>
                <td style="white-space: nowrap">{{ $val->phone_no }}</td>
                <td style="white-space: nowrap">{{ $val->tutor_type }}</td>
                <td style="white-space: nowrap">{{ $val->email }}</td>
                <td style="white-space: nowrap">{{ $val->address }}</td>
                <td style="white-space: nowrap">{{ strlen($val->message) > 50 ? substr($val->message,0,50)."..." :$val->message }}</td>
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

