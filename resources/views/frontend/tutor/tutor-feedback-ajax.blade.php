<table class="table table-separate table-head-custom">

    <thead>

        <tr>

            <th nowrap="nowrap">ID</th>
            <th style="white-space: nowrap">Name</th>
            <th style="white-space: nowrap">Description</th>
            <th style="white-space: nowrap">Subject Name</th>
            <th style="white-space: nowrap">Outcome</th>
            <th style="white-space: nowrap">Rating</th>
            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        @php

        $i = $page * 10 - 9;

        @endphp

        @if (count($query) > 0)

        @foreach ($query as $val)
        <span id="desc{{$val->mainId}}" style="display:none">{{ $val->descriptions}}</span>
        <tr>

            <td>{{ $i++ }}</td>
            <td>{{ $val->userDetails->first_name }} {{ $val->userDetails->last_name }}</td>
            <td>{{ Str::limit($val->descriptions, 50) }}</td>
            <td>{{ $val->subjectDetails->main_title }}</td>
            <td>{{ $val->outcome }}</td>
            <td>
                <div class="review-score">
                    <div class="stars stars2" style="--rating: {{$val->rating}};" aria-label="Rating of this product is 2.3 out of 5."></div>
                </div>
            </td>

            <td>
                <a href="javascript:void(0)" onclick="viewDetail('{{$val->mainId}}')" class="edit-details" data-id="{{$val->id}}}"><i class="fa fa-eye"></i></a>
            </td>

        </tr>

        @endforeach

        @endif

        @if (count($query) == 0)

        <tr>

            <td colspan="4">Currently you have no feedback</td>

        </tr>

        @endif

    </tbody>

</table>

{!! $query->withQueryString()->links('pagination::bootstrap-5') !!}