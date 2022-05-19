<table class="table">
    <thead>
        <tr>
        <tr>
            <th>ID</th>
          
            <th>Level Name</th>
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
                    
                    <td>{{ $val->tutorLevelRelation->title }}</td>
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
                <td align="center" colspan="4">No record available</td>
            </tr>
        @endif
    </tbody>
</table>
