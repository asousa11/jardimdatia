<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ArtigoRamoSeeder
 */
class ArtigoRamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artigo_ramos')->insert([
            'ramo_id' => 1,
            'codProduto' => 2,
            'descricao' => 'Rosa',
            'quantidade' => 2,
            'preco_artigo_uni' => 2.5,
            'percentagemPromo' => 7
        ]);
        DB::table('artigo_ramos')->insert([
            'ramo_id' => 1,
            'codProduto' => 6,
            'descricao' => 'Malmequer',
            'quantidade' => 1,
            'preco_artigo_uni' => 2.5,
            'percentagemPromo' => 7
        ]);

        DB::table('artigo_ramos')->insert([
            'ramo_id' => 2,
            'codProduto' => 2,
            'descricao' => 'Rosa',
            'quantidade' => 1,
            'preco_artigo_uni' => 2.5,
            'percentagemPromo' => 7
        ]);
        DB::table('artigo_ramos')->insert([
            'ramo_id' => 2,
            'codProduto' => 6,
            'descricao' => 'Malmequer',
            'quantidade' => 2,
            'preco_artigo_uni' => 1.5,
        ]);
    }
}
