<?php

use App\Sistema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ProdutosSeeder
 */
class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Sistema $sistema
     * @return void
     */
    public function run(Sistema $sistema)
    {
        DB::table('ramos')->insert([
            'codProduto' => $sistema->getCodProduto()+1,
            'descricao' => 'Ramo de Natal',
            'preco' => 7.5,
            'quantidade_stock' => 2,
            'ocasiao_id' => 3,
            'promocao_id' => 9,
            'image_path' => '/images/ramonatal.jpg',
        ]);
        $sistema->setCodProduto($sistema->getCodProduto());

        DB::table('ramos')->insert([
            'codProduto' => $sistema->getCodProduto()+1,
            'descricao' => 'Ramo Aniversário Pequeno',
            'preco' => 5.5,
            'quantidade_stock' => 5,
            'ocasiao_id' => 2,
            'promocao_id' => 9,
            'image_path' => '/images/ramoanip.jpg',
        ]);
        $sistema->setCodProduto($sistema->getCodProduto());

        DB::table('flors')->insert([
            'codProduto' => $sistema->getCodProduto()+1,
            'descricao' => 'Rosa',
            'epoca_id' => '1',
            'preco' => 2.5,
            'quantidade_stock' => 10,
            'promocao_id' => 2,
            'image_path' => '/images/rosa.jpg',
        ]);
        $sistema->setCodProduto($sistema->getCodProduto());

        DB::table('flors')->insert([
            'codProduto' => $sistema->getCodProduto()+1,
            'descricao' => 'Zínias',
            'epoca_id' => '4',
            'preco' => 1.99,
            'quantidade_stock' => 30,
            'promocao_id' => 4,
            'image_path' => '/images/zinia.jpg',
        ]);
        $sistema->setCodProduto($sistema->getCodProduto());

        DB::table('flors')->insert([
            'codProduto' => $sistema->getCodProduto()+1,
            'descricao' => 'Orquidea',
            'epoca_id' => '1',
            'preco' => 2,
            'quantidade_stock' => 10,
            'image_path' => '/images/orquidea.jpg',
        ]);
        $sistema->setCodProduto($sistema->getCodProduto());

        DB::table('flors')->insert([
            'codProduto' => $sistema->getCodProduto()+1,
            'descricao' => 'Dálias',
            'epoca_id' => 4,
            'preco' => 1.5,
            'quantidade_stock' => 9,
            'image_path' => '/images/dalia.jpg',
        ]);
        $sistema->setCodProduto($sistema->getCodProduto());

        DB::table('extras')->insert([
            'codProduto' => $sistema->getCodProduto()+1,
            'descricao' => 'Brilhantes',
            'preco' => 0.75,
            'quantidade_stock' => 10,
            'promocao_id' => 6,
            'image_path' => '/images/brilhantes.jpg',
        ]);
        $sistema->setCodProduto($sistema->getCodProduto());

        DB::table('produto_manutencaos')->insert([
            'codProduto' => $sistema->getCodProduto()+1,
            'descricao' => 'Pá',
            'quantidade_stock' => 10,
            'preco' => 5.99,
            'image_path' => '/images/pá.jpg',
        ]);
        $sistema->setCodProduto($sistema->getCodProduto());

        DB::table('flors')->insert([
            'codProduto' => $sistema->getCodProduto()+1,
            'descricao' => 'Malmequer',
            'epoca_id' => '1',
            'preco' => 2.5,
            'quantidade_stock' => 10,
            'promocao_id' => 2,
            'image_path' => '/images/malmequer.jpeg',
        ]);
        $sistema->setCodProduto($sistema->getCodProduto());
    }
}
