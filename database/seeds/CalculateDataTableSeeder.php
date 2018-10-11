<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CalculateDataTableSeeder extends Seeder
{
    const CALCULATE_DATA = [
        'switchedTip' => '0',
        'bets' => '30000',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $basicDataTable = DB::table('basic_data');
//        try {
//            $basicDataTable->insert([
//                'key' => 'basic-data',
//                'value' => json_encode(static::CALCULATE_DATA),
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now()
//            ]);
//        } catch (PDOException $e) {
//            $this->command->warn('Error_code: '.$e->getCode().", Data won't be loaded.\n");
//        }
    }
}
