<?php

namespace App\Services;

use App\Models\District;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DistrictService
{

    public function getDistricts(int $perPage = 10): Object
    {
        return District::paginate($perPage);
    }

    public function createDistrict(array $userData): District
    {
        $create = [
            'state_id'    => $userData['state_id'],
            'name'    => $userData['name'],
            'code'    => $userData['code'],
            'status'    => $userData['status'],

        ];
        $district = District::create($create);
        return $district;
    }

    public function getDistrict($id): Object
    {
        return District::find($id);
    }


    public function updateDistrict(District $district, array $userData, string $imageUrl = null): void
    {

        $update = [
            'state_id'    => $userData['state_id'],
            'name'    => $userData['name'],
            'code'    => $userData['code'],
            'status'    => $userData['status'],

        ];
        $district->update($update);
    }

    public function deleteDistrict(District $district): void
    {
        // delete scheme
        District::find($district->id)->delete();
    }
}
