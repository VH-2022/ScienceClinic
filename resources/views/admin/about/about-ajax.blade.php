<table class="table table-separate table-head-custom">
    <thead>
        <tr>
            <th nowrap="nowrap">ID</th>
            <th style="white-space: nowrap">Type</th>
            <th style="white-space: nowrap">Content1 </th>
            <th style="white-space: nowrap">Content2 </th>
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
                    <td>{{ $val->type }}</td>
                    <td>
                        {!! strlen($val->content1) > 100 ? substr($val->content1, 0, 100) . '...' : $val->content1 !!}</td>
                    <td> {!! strlen($val->content2) > 100 ? substr($val->content2, 0, 100) . '...' : $val->content2 !!}</td>
                    <td>
                        @if ($val->created_at != '')
                            {{ Utility::convertYMDTimeToDMYTime($val->created_at) }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('about-list') }}/{{ $val->id }}/edit"class="edit-details" data-id="{{$val->id}}"><i class="fa fa-edit"></i></a>

                    </td>
                </tr>
            @endforeach
        @endif
        @if (count($query) == 0)
            <tr>
                <td colspan="7">No record available</td>
            </tr>
        @endif
    </tbody>
</table>
{!! $query->withQueryString()->links('pagination::bootstrap-5') !!}
