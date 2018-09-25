<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicDataTableSeeder extends Seeder
{
    const BASIC_DATAS = [
        1 => ['key' => 'startMoney', 'value' => '10000'],
        2 => ['key' => 'finishMoney', 'value' => '30000'],
        3 => ['key' => 'odds', 'value' => '1.83'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $basicDataTable = DB::table('basic_data');

        foreach (static::BASIC_DATAS as $id => $basicData) {
            try {
                $basicDataTable->insert([
                    'key' => $basicData['key'],
                    'value' => $basicData['value'],
                ]);
            } catch (PDOException $e) {
                $this->command->warn('Import: Basic data key is already in use: <'.$basicData['key'].'>, Error_code: '.$e->getCode().", Data won't be loaded.\n");
            }
        }
    }
}
