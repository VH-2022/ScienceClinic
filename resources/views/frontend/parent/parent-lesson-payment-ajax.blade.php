<table class="table table-separate table-head-custom">

    <thead>

        <tr>

            <th nowrap="nowrap">ID</th>

            <th style="white-space: nowrap">Subject Name</th>

            <th style="white-space: nowrap">Tutor Name</th>

            <th style="white-space: nowrap">Booking Date</th>

            <th>Status</th>

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

            <td>{{ $val->subjectDetails->main_title }}</td>

            <td>{{ $val->tutorDetails->first_name }}</td>

            <td>
                @if ($val->booking_date != '')
                {{ Utility::convertDMY($val->booking_date) }}
                @endif
            </td>

            <td>
                {{ $val->payment_status }}
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
