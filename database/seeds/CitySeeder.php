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
        \App\Models\City::create(['id'=>1, 'code'=>'CRB','name'=>'Cirebon']);
        \App\Models\City::create(['id'=>2, 'code'=>'BDG', 'name'=>'Bandung']);
    }
}
