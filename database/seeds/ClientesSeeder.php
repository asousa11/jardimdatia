<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

/**
 * Class EpocasSeeder
 */
class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'numContribuinte' => '123123122',
            'nome' => 'Diogo Figueiredo',
            'email' => 'diogo@gmail.com',
            'morada' => 'Rua de Cima',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('clientes')->insert([
            'numContribuinte' => '123123124',
            'nome' => 'André Sousa',
            'email' => 'andre@gmail.com',
            'morada' => 'Rua de Baixo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('clientes')->insert([
            'numContribuinte' => '123123126',
            'nome' => 'Rui Sousa',
            'email' => 'rui@gmail.com',
            'morada' => 'Rua de Lado',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
