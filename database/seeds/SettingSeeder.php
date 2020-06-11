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

    }
}
