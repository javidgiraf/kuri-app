<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Scheme;

class UserSchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userschemes =[[
            'user_id' => '45',
            'scheme_id' => "1",
            'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'end_date' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')


        ],[
            'user_id' => '45',
            'scheme_id' => "2",
            'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'end_date' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

        ],
        [
            'user_id' => '44',
            'scheme_id' => "2",
            'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'end_date' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

        ],
       ];
       foreach($userschemes as $userscheme)
       {
            $scheme=Scheme::where('id',$userscheme['scheme_id'])->first();
            $total_period = $scheme->total_period;
            $userscheme['start_date']= date("Y-m-d", strtotime($userscheme['start_date']));

            $userscheme['end_date'] = date('Y-m-d', strtotime("+$total_period months", strtotime($userscheme['start_date'])));
            DB::table('user_subscriptions')->insert($userscheme);

      }
    }
}
