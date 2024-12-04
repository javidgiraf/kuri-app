<option value="" selected disabled>Select the State</option>
@foreach($states as $state)
    <option value="{{ $state->id }}" 
        <?= (old('state_id', $state_id ?? '') == $state->id) ? 'selected' : '' ?>>
        {{ $state->name }}
    </option>
@endforeach