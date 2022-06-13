<table class="table table-separate table-head-custom">
    <thead>
        <tr>
            <th nowrap="nowrap">ID</th>
            <th style="white-space: nowrap">Name </th>
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
            <tr>
                <td>{{ $i++ }}</td>
                <td id="title{{$val->id}}">{{ $val->title }}</td>
                <td>
                    @if ($val->created_at != '')
                        {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}
                    @endif
                </td>
                <td>
                    <a href="javascript:void(0)" onclick="editDetail('{{$val->id}}')" class="edit-details" data-id="{{$val->id}}}"><i class="fa fa-edit"></i></a>
                    <a href="javascript:void(0)" onclick="deleteDetail('{{$val->id }}')" class="delete-details" data-id="{{$val->id}}}"><i class="fa fa-trash"></i></a>
                </td>
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


