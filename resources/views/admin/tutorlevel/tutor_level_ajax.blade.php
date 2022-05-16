<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
    <thead>
        <tr>
            <th nowrap="nowrap">Serial No</th>
            <th style="white-space: nowrap">Title </th>
            <th style="white-space: nowrap">Created Date</th>
            <th>Status</th>
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
                <td>{{ $val->title }}</td>
                <td>
                    @if ($val->created_at != '')
                        {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}
                    @endif
                </td>
                <td></td>
                <td>
                    <a href="{{ url('tutor-level') }}/{{ $val->id }}/edit"><i class="fa fa-edit"></i></a>
                    <a href="{{ url('tutor-level') }}/{{ $val->id }}/delete"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


