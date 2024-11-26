<option value="" selected disabled>Select the Districts</option>
@foreach($districts as $district)
<option value="{{encrypt($district->id)}}" {{ isset($district_id)?($district_id==$district->id?'selected':''):''}}>{{$district->name}}</option>
@endforeach