<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PremioSeeder
 */
class PremioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('premios')->insert([
            'volumeNegocio' => 100,
            'oferta' => 5
        ]);
    }
}
