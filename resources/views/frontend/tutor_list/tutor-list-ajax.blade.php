@if(count($tutorList)>0)
<div class="row">
@foreach($tutorList as $val)
    <div class="col-md-6 col-lg-4 tutor-card">
        <a class="tutor-content" href="{{route('tutors-details',sha1($val->id))}}">
            <div class="single-product-item">
                <div class="single-product-image">
                    @if($val->profile_photo)
                    <img src="{{$val->profile_photo}}">
                    @else
                    <img src="{{asset('uploads/avatar.jpg')}}">
                    @endif
                </div>
                <div class="single-product-text">
                    <h4 class="testing-user"> {{$val->first_name}}</h4>
                </div>
            </div>
        </a>
    </div>
@endforeach
</div>
@else
<div>No record available</div>
@endif

<div class="paginate">
{!! $tutorList->withQueryString()->links('pagination::bootstrap-5') !!}
</div>