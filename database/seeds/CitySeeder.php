<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\City::create(['code'=>'CRB','name'=>'Cirebon']);
        \App\Models\City::create(['code'=>'Baandung']);
    }
}
