<?php

namespace App\Services;

use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;
use Carbon\Carbon;


class StateService
{

    public function getStates(): Object
    {

        return State::all();
    }
    public function createState(array $userData): State
    {
        $create = [
            'country_id'    => $userData['country_id'],
            'name'    => $userData['name'],
            'code'    => $userData['code'],
            'status'    => $userData['status'],

        ];
        $state = State::create($create);
        return $state;
    }

    public function getState($id): Object
    {
        return State::find($id);
    }




    public function updateState(State $state, array $userData, string $imageUrl = null): void
    {

        $update = [
            'country_id'    => $userData['country_id'],
            'name'    => $userData['name'],
            'code'    => $userData['code'],
            'status'    => $userData['status'],

        ];
        $state->update($update);
    }

    public function deleteState(State $state): void
    {
        // delete scheme
        State::find($state->id)->delete();
    }
    public function getDistrictsbyState($id): Object
    {
        return District::where('state_id', $id)->get();
    }
}
