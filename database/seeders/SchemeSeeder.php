<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $schemes =[[
            'title' => 'Wedding Plan',
            'total_amount' => "300000.00",
            'total_period' => '10',
            'schedule_amount' => '2500.00',
            'description' => ''

        ],[
            'title' => 'Plan B',
            'total_amount' => "150000.00",
            'total_period' => '4',
            'schedule_amount' => '1000.00',
            'description' => ''

        ],
       ];
       foreach($schemes as $scheme)
       {
        $scheme['total_period']= $scheme['total_period'] * 12;
        DB::table('schemes')->insert($scheme);

      }
    }
}
