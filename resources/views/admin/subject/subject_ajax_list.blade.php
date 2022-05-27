
<table class="table table-separate table-head-custom">
    <thead>
        <tr>
            <th nowrap="nowrap"> ID</th>
            <th style="white-space: nowrap">Title </th>
           
            <th style="white-space: nowrap">Created Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @php
        
        $i = $page * 50 - 49;
    @endphp
     @if (count($query) > 0)
        @foreach ($query as $live_in)
            
            <tr>
                <td>
                    {{ $i++}}
                </td>
                <td>
                    {{ $live_in->main_title}}
                </td>
                
                <td>
                 @if($live_in->created_at !='')
                            {{ Utility::convertYMDTimeToDMYTime($live_in->created_at) }}
                        @endif
                </td>
                <td>
                    <a href="{{ url('subject-master') }}/{{$live_in->id}}/edit"><i class="fa fa-edit"></i></a>
                    <a href="javascript:void(0)" class="delete-category" data-id="{{ $live_in->id}}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        
    @endif
    @if (count($query) == 0)
            <tr>
                <td colspan="6">No record available</td>
            </tr>
        @endif
    </tbody>
</table>

{!! $query->withQueryString()->links('pagination::bootstrap-5') !!}

