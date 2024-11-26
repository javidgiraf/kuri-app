<?php

namespace App\Services;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CountryService
{

    public function getCountries(): Object
    {

        return Country::all();
    }
    public function createCountry(array $userData): Country
    {
        $create = [
            'name'    => $userData['name'],
            'code'    => $userData['code'],
            'status'    => $userData['status'],

        ];
        $country = Country::create($create);
        return $country;
    }

    public function getCountry($id): Object
    {
        return Country::find($id);
    }


    public function updateCountry(Country $country, array $userData, string $imageUrl = null): void
    {

        $update = [
            'name'    => $userData['name'],
            'code'    => $userData['code'],
            'status'    => $userData['status'],

        ];
        $country->update($update);
    }

    public function deleteCountry(Country $country): void
    {
        // delete country
        Country::find($country->id)->delete();
    }

    public function getStatesbyCountry($id): Object
    {
        return State::where('country_id', $id)->get();
    }
}
