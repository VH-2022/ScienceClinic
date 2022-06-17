<table class="table table-separate table-head-custom">

    <thead>

        <tr>

            <th nowrap="nowrap">ID</th>

            <th style="white-space: nowrap">Title </th>

            <th style="white-space: nowrap">Description</th>

            <th style="white-space: nowrap">Document</th>

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

            <td id="title">{{ $val->title }}</td>

            <td id="description">{{ Str::limit($val->description, 100) }}</td>

            <td>
            @php
            $image_array = array('jpg','png','jpeg','gif');
            $explode = explode('.',$val->upload_data);
            @endphp
            @if($val->upload_data)
            @if(in_array($explode[4], $image_array))
            <a href="{{$val->upload_data}}" download><i class="fas fa-photo-video"></i></a>
            @else
            <a href="{{$val->upload_data}}" download><i class="far fa-file"></i></a>
            @endif
            @endif
            </td>

            <td>

                <a href="javascript:void(0)" onclick="editResourceDetail('{{$val->id}}')" class="edit-details" data-id="{{$val->id}}}"><i class="fa fa-edit"></i></a>

                <a href="javascript:void(0)" onclick="deleteResourceDetail('{{$val->id }}')" class="delete-details" data-id="{{$val->id}}}"><i class="fa fa-trash"></i></a>

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