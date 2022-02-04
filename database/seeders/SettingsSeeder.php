<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            [
                'id'    => 3,
                'name' => 'Cutt_Off_Time',
                'value' => '17:00',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 4,
                'name' => 'Footer_Value',
                'value' => 'Free delivery on all orders. Prices stated exclude 15% GST',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 5,
                'name' => 'Debit_Authority_Number',
                'value' => '12345',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 6,
                'name' => 'Debit_Account_Number',
                'value' => '123-456-789',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
        ];
        Setting::insert($setting);  
    }
}
