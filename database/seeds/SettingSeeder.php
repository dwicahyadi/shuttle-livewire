<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([ 'name' => 'company_name', 'value' => 'Dwi Shuttle' ]);
        \App\Models\Setting::create([ 'name' => 'company_logo', 'value' => null ]);
        \App\Models\Setting::create([ 'name' => 'company_tagline', 'value' => null ]);
        \App\Models\Setting::create([ 'name' => 'company_address', 'value' => null ]);
        \App\Models\Setting::create([ 'name' => 'company_phone', 'value' => null ]);
        \App\Models\Setting::create([ 'name' => 'company_mail', 'value' => null ]);
        \App\Models\Setting::create([ 'name' => 'company_bank', 'value' => null ]);
        \App\Models\Setting::create([ 'name' => 'company_bank_account', 'value' => null ]);

        \App\Models\Setting::create([ 'name' => 'max_reschedule', 'value' => '2' ]);
        \App\Models\Setting::create([ 'name' => 'max_minutes_for_transfer_bank', 'value' => '120' ]);

        \App\Models\Setting::create([ 'name' => 'ticket_use_qrcode', 'value' => 'no' ]);
        \App\Models\Setting::create([ 'name' => 'ticket_use_logo', 'value' => 'no' ]);
        \App\Models\Setting::create([ 'name' => 'ticket_addtional_note', 'value' => null ]);
        \App\Models\Setting::create([ 'name' => 'ticket_free_to_reprint', 'value' => 'yes' ]);

        \App\Models\Setting::create([ 'name' => 'seat_total', 'value' => '10' ]);
        \App\Models\Setting::create([ 'name' => 'seat_per_row', 'value' => '3' ]);

        \App\Models\Setting::create([ 'name' => 'sms_services', 'value' => 'no'  ]);
        \App\Models\Setting::create([ 'name' => 'sms_services_url', 'value' => null  ]);
        \App\Models\Setting::create([ 'name' => 'sms_services_key', 'value' => null  ]);
        \App\Models\Setting::create([ 'name' => 'sms_services_user', 'value' => null  ]);
        \App\Models\Setting::create([ 'name' => 'sms_services_password', 'value' => null  ]);
        \App\Models\Setting::create([ 'name' => 'otp_services', 'value' => 'no'  ]);
        \App\Models\Setting::create([ 'name' => 'greeting_sms', 'value' => 'no'  ]);
        \App\Models\Setting::create([ 'name' => 'greeting_sms_text', 'value' => 'no'  ]);

        \App\Models\Setting::create([ 'name' => 'email_service', 'value' => null  ]);

        \App\Models\Setting::create([ 'name' => 'payment_gateway', 'value' => null  ]);


        /*Cities*/
        \App\Models\City::create(['id'=>1, 'code'=>'CRB','name'=>'Cirebon']);
        \App\Models\City::create(['id'=>2, 'code'=>'BDG', 'name'=>'Bandung']);

        /*Points*/
        \App\Models\Point::create(['city_id'=>1,'code'=>'CRB','name'=>'Cirebon','address'=>'','phone'=>'','active'=>true]);
        \App\Models\Point::create(['city_id'=>2,'code'=>'PST','name'=>'Pasteur','address'=>'','phone'=>'','active'=>true]);

        /*Cars*/
        \App\Models\Car::create(['code'=>'SHT01','license_number'=>'E1234AB','kilometers'=>0,'active'=>true]);
        \App\Models\Car::create(['code'=>'SHT02','license_number'=>'E1234CD','kilometers'=>0,'active'=>true]);

        /*Drivers*/
        \App\Models\Driver::create(['name'=>'Contoh 1','address'=>'Cirebon','phone'=>'087777777','active'=>true]);
        \App\Models\Driver::create(['name'=>'Contoh 2','address'=>'Cirebon','phone'=>'087777771','active'=>true]);

        /*Discounts*/
        \App\Models\Discount::create(['code'=>'OPN','name'=>'Promo Opening','amount'=>20000,'active'=>true]);
        \App\Models\Discount::create(['code'=>'MHS','name'=>'Promo Mahasiswa','amount'=>10000,'active'=>true]);

        /*user demo*/
        \App\Models\User::create(['name'=>'Demo Akun','email'=>'demo@demo.com', 'password'=>bcrypt('password')]);

        /*Roles*/
        \Spatie\Permission\Models\Role::create(['name'=>'MASTER', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Role::create(['name'=>'OPS', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Role::create(['name'=>'CSO', 'guard_name'=>'web']);

        /*Permissions*/
        \Spatie\Permission\Models\Permission::create(['name'=>'City', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Permission::create(['name'=>'Point', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Permission::create(['name'=>'Car', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Permission::create(['name'=>'Driver', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Permission::create(['name'=>'Discount', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Permission::create(['name'=>'Schedule', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Permission::create(['name'=>'Reservation', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Permission::create(['name'=>'Customer', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Permission::create(['name'=>'User', 'guard_name'=>'web']);
        \Spatie\Permission\Models\Permission::create(['name'=>'Setting', 'guard_name'=>'web']);

    }
}
