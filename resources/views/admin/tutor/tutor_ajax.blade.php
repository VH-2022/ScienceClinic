<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
    <thead>
        <tr>
            <th nowrap="nowrap">Serial No</th>
            <th style="white-space: nowrap">Full Name </th>
            <th style="white-space: nowrap">Email </th>
            <th style="white-space: nowrap">Mobile </th>
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
                <td>{{ $val->first_name }}</td>
                <td>{{ $val->email }}</td>
                <td>{{ $val->mobile_id }}</td>
                <td>
                    @if ($val->created_at != '')
                        {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}
                    @endif
                </td>
                <td></td>
                <td>
                    <a href="{{ url('tutor-master')}}/{{$val->id}}" class="show-details"><i class="fa fa-eye"></i></a>
                    <a href="javascript:void(0)" onclick="functionDelete('{{ $val->id }}')" class="delete-details"
                        data-id="{{ $val->id }}}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
