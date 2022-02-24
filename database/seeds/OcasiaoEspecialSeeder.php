<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

/**
 * Class OcasiaoEspecialSeeder
 */
class OcasiaoEspecialSeeder extends Seeder
{
    /**
     * Seeder Ocasiao Espcecial
     */
    public function run()
    {
        DB::table('ocasiao_especials')->insert([
            'designacao' => 'Verão',
            'datainicio' => Date::create(2020,6, 21),
            'datafim' => Date::create(2021,9, 22)
        ]);
        DB::table('ocasiao_especials')->insert([
            'designacao' => 'Aniversários',
            'datainicio' => Date::create(2020,1, 1),
            'datafim' => Date::create(2020,12, 31)
        ]);
        DB::table('ocasiao_especials')->insert([
            'designacao' => 'Natal',
            'datainicio' => Date::create(2020,12, 15),
            'datafim' => Date::create(2020,12, 31)
        ]);
        DB::table('ocasiao_especials')->insert([
            'designacao' => 'Páscoa',
            'datainicio' => Date::create(2020,4, 1),
            'datafim' => Date::create(2020,4, 31)
        ]);
    }
}
