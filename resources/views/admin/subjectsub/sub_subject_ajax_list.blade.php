<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">

    <thead>

        <tr>

            <th nowrap="nowrap"> ID</th>

            <th style="white-space: nowrap">Title </th>

            <th style="white-space: nowrap">Main Category</th>

            <th style="white-space: nowrap">Created Date</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

    
    @if (count($query) > 0)
    @php
        $i = $page * 10 - 9;
    @endphp

        @foreach ($query as $live_in)

            

            <tr>

                <td>

                    {{ $i++}}

                </td>

                <td>

                    {{ $live_in->main_title}}

                </td>

                <td>

                    {{ $live_in->mtitle}}

                </td>

                <td>

                 @if($live_in->created_at !='')

                            {{ Utility::convertYMDTimeToDMYTime($live_in->created_at) }}

                        @endif

                </td>

                <td>

                    <a href="{{ url('sub-subject-master') }}/{{$live_in->id}}/edit"><i class="fa fa-edit"></i></a>
                    

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

<div class="pagination">
@if (count($query) > 0)
{{ $query->appends(request()->query())->links() }}
@endif
</div>