<table class="table table-bordered">

    <thead>

        <tr>

        <tr>

            <th style="white-space:nowrap">ID</th>

            <th  style="white-space:nowrap">DBS Disclosure</th>

            <th style="white-space:nowrap">DBS Disclosure Document</th>

            <th style="white-space:nowrap">Experience in the UK </th>

            <th style="white-space:nowrap">Total Experience in the UK </th>

            <th style="white-space:nowrap">Pay Tax</th>

            <th style="white-space:nowrap">Created Date</th>

        </tr>

    </thead>

    <tbody>

        @php

        $i = $page * 10 - 9;

        @endphp

        @if (count($query) > 0)

        @foreach ($query as $val)
        <tr>

            <td style="white-space:nowrap">{{ $i++ }}</td>

            <td style="white-space:nowrap">{{ $val->dbs_disclosure }}</td>

            @php
                $dbsVal = $val->dbs_disclosure;
                $expUk = $val->experience_in_uk;
            @endphp

            @if($dbsVal == "Yes")
                <td style="white-space:nowrap">
                    @php 
                        $image_array = array('jpg','png','jpeg','gif');
                        $explode = explode('.',$val->document);
                        
                    @endphp
                    @if($val->document)
                        @if(in_array($explode[4], $image_array))
                            <a  href="{{$val->document}}" download ><i class="fas fa-photo-video"></i></a>
                        @else
                            <a href="{{$val->document}}" download><i class="far fa-file-pdf"></i></a>
                        @endif
                    @endif
                </td>
            @else
                <td style="white-space:nowrap">No</td>
            @endif

            <td style="white-space:nowrap">{{ $val->experience_in_uk }}</td>

            @if($expUk == "Yes")
                @if($val->total_experience_in_uk == 1)
                    <td style="white-space:nowrap">1-2 years</td>
                @elseif($val->total_experience_in_uk == 2)
                    <td style="white-space:nowrap">3-5 years</td>
                @else
                    <td style="white-space:nowrap">5 plus years</td>
                @endif
            @else
                <td style="white-space:nowrap">No</td>
            @endif

            <td style="white-space:nowrap">{{$val->pay_tex}}</td>
            <td style="white-space:nowrap">

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