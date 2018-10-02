<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BasicDataTableSeeder extends Seeder
{
//    const BASIC_DATA = [
//        ['key' => 'startMoney', 'value' => '10000'],
//        ['key' => 'finishMoney', 'value' => '30000'],
//        ['key' => 'odds', 'value' => '1.83'],
//    ];
    const BASIC_DATA = [
        'startMoney' => '10000',
        'finishMoney' => '30000',
        'odds' => '1.83'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $basicDataTable = DB::table('basic_data');
        try {
            $basicDataTable->insert([
                'key' => 'basic-data',
                'value' => json_encode(static::BASIC_DATA),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } catch (PDOException $e) {
            $this->command->warn('Error_code: '.$e->getCode().", Data won't be loaded.\n");
        }
    }
}
