<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class Setting extends Component
{
    public $company_name,$company_logo,$company_tagline,$company_address,$company_phone,$company_mail,$company_bank,$company_bank_account,$max_reschedule,$max_minutes_for_transfer_bank,$ticket_use_qrcode,$ticket_use_logo,$ticket_addtional_note,$ticket_free_to_reprint,$seat_total,$seat_per_row,$sms_services,$sms_services_url,$sms_services_key,$sms_services_user,$sms_services_password,$otp_services,$greeting_sms,$greeting_sms_text,$email_service,$payment_gateway;
    public $settingArray;

    public function mount()
    {
        $settings = \App\Models\Setting::all()->keyBy('name');
        foreach ($settings as $setting => $value)
        {
            $this->$setting = $value->value;
            $this->settingArray[] = $setting;
        }
    }

    public function render()
    {
        return view('livewire.setting');
    }

    public function save()
    {
        foreach ($this->settingArray as $setting)
        {
            \App\Models\Setting::where('name', $setting)->update(['value'=>$this->$setting]);
        }
    }
}
