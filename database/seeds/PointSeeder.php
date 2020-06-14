<?php

use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Point::create(['city_id'=>1,'code'=>'CRB','name'=>'Cirebon','address'=>'','phone'=>'','active'=>true]);
        \App\Models\Point::create(['city_id'=>2,'code'=>'PST','name'=>'Pasteur','address'=>'','phone'=>'','active'=>true]);
    }
}
