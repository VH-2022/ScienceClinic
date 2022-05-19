<table class="table">
    <thead>
        <tr>
        <tr>
            <th>ID</th>
            <th>Tutor_Id</th>
            <th>University Name </th>
            <th>Qualification </th>
            <th>document_image </th>
            <th>Created Date</th>
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
                    <td>{{ $val->university_name }}</td>
                    <td>{{ $val->qualification }}</td>
                    <td>{{ $val->document_image }}</td>
                    <td>
                        @if ($val->created_at != '')
                            {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}
                        @endif
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