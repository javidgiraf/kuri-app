<option value="" selected disabled>Select the State</option>
@foreach($states as $state)
<option value="{{encrypt($state->id)}}" {{ isset($state_id)?($state_id==$state->id?'selected':''):''}}>{{$state->name}}</option>
@endforeach