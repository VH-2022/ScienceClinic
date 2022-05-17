<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
    <thead>
        <tr>
            <th nowrap="nowrap">No</th>
            <th style="white-space: nowrap">Title </th>
            <th style="white-space: nowrap">Created Date</th>
            
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = $page * 10 - 9;
            
        @endphp
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
                    <a href="javascript:void(0)" onclick="functionDelete('{{$val->id }}')" class="delete-details" data-id="{{$val->id}}}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        @if(count($query) ==0)
            <tr>
                <td>No record available</td>
            </tr>
        @endif
    </tbody>
</table>


