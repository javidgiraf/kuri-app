<option value="" selected disabled>Select the Scheme</select>
@foreach($userSubscriptionLists as $userSubscriptionList)
   <option value="{{encrypt($userSubscriptionList->id)}}">{{$userSubscriptionList->scheme->title}}</option>
@endforeach