<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

/**
 * Class EpocasSeeder
 */
class EpocasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('epocas')->insert([
            'designacao' => 'Inverno',
            'datainicio' => Date::create(2020,12, 21 ),
            'datafim' => Date::create(2021,3, 20 )
        ]);
        DB::table('epocas')->insert([
            'designacao' => 'Outono',
            'datainicio' => Date::create(2020,9, 22 ),
            'datafim' => Date::create(2020,12, 21 )
        ]);
        DB::table('epocas')->insert([
            'designacao' => 'Primavera',
            'datainicio' => Date::create(2020,3, 20 ),
            'datafim' => Date::create(2020,6, 20 )
        ]);
        DB::table('epocas')->insert([
            'designacao' => 'Verão',
            'datainicio' => Date::create(2020,6, 20 ),
            'datafim' => Date::create(2021,9, 22 )
        ]);
    }
}
