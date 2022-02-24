<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class SugestoesSeeder
 */
class SugestoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sugestaos')->insert([
            'tipo' => 'Plantações',
            'texto' => 'No mês de junho é muito bom plantar Rosas.',
            'epoca_id' => 4
        ]);

        DB::table('sugestaos')->insert([
            'tipo' => 'Plantações',
            'texto' => 'Em agosto é bom colher batata.',
            'epoca_id' => 1
        ]);

        DB::table('sugestaos')->insert([
            'tipo' => 'Manutenção',
            'texto' => 'Não regue em demasia as suas flores.',
            'epoca_id' => 2
        ]);

        DB::table('sugestaos')->insert([
            'tipo' => 'Flores',
            'texto' => 'Os girassóis são muito bonitos nesta altura.',
            'epoca_id' => 4
        ]);
    }
}
