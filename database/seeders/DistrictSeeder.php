<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       $districts =[[
            'state_id' => '1',
            'name' => "Alappuzha",
            'code' => 'AL',

        ],[
            'state_id' => '1',
            'name' => "Ernakulam",
            'code' => 'ER',

        ],
        [
            'state_id' => '1',
            'name' => "Idukki",
            'code' => 'ID',

        ],
        [
            'state_id' => '1',
            'name' => "Kannur",
            'code' => 'KN',

        ],
        [
            'state_id' => '1',
            'name' => "Kasaragod",
            'code' => 'KS',

        ],
        [
            'state_id' => '1',
            'name' => "Kollam",
            'code' => 'KL',

        ],
        [
            'state_id' => '1',
            'name' => "Kottayam",
            'code' => 'KT',

        ],
        [
            'state_id' => '1',
            'name' => "Kozhikode",
            'code' => 'KZ',

        ],
        [
            'state_id' => '1',
            'name' => "Malappuram",
            'code' => 'MA',

        ],
        [
            'state_id' => '1',
            'name' => "Palakkad",
            'code' => 'PL',

        ],
        [
            'state_id' => '1',
            'name' => "Pathanamthitta",
            'code' => 'PT',

        ],
        [
            'state_id' => '1',
            'name' => "Thiruvananthapuram",
            'code' => 'TV',

        ],
        [
            'state_id' => '1',
            'name' => "Thrissur",
            'code' => 'TS',

        ],
        [
            'state_id' => '1',
            'name' => "Wayanad",
            'code' => 'WA',

        ],];
       foreach($districts as $district)
       {
        DB::table('districts')->insert($district);

      }

    }
}
