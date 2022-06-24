 <table class="table table-separate table-head-custom">
     <thead>
         <tr>
             <th nowrap="nowrap"> ID</th>
             <th nowrap="nowrap"> Type</th>
             <th style="white-space: nowrap">Title </th>
             <th style="white-space: nowrap">Description</th>
             <th style="white-space: nowrap">Document</th>

         </tr>

     </thead>

     <tbody>


         @php
         $i = $page * 10 - 9;
         @endphp
         @if (count($data) > 0)
         @foreach ($data as $live_in)
         <tr>

             <td>
                 {{ $i++ }}
             </td>
             <td>
                 {{ $live_in->type }}
             </td>
             <td>
                 {{ $live_in->text_book_title}}

             </td>
             <td>
                 {!! Str::limit($live_in->text_book_description, 100) !!}

             </td>

             <td>
                 @php
                 $image_array = array('jpg','png','jpeg','gif','doc','docx');
                 $explode = explode('.',$live_in->text_book_upload);
                 @endphp
                 @if($live_in->text_book_upload)
                 @if(in_array($explode[4], $image_array))
                 <a href="{{$live_in->text_book_upload}}" target="_blank"><i class="far fa-file"></i></a>
                 @else
                 <a href="{{$live_in->text_book_upload}}#toolbar=0" target="_blank"><i class="far fa-file-pdf"></i></a>
                 @endif
                 @endif
             </td>

         </tr>
         @endforeach
         @endif
         @if (count($data) == 0)
         <tr>
             <td colspan="6">No record available</td>
         </tr>
         @endif

     </tbody>

 </table>


 {!! $data->render('pagination::bootstrap-5') !!}