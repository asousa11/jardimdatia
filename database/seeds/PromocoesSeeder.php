<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

/**
 * Class PromocoesSeeder
 */
class PromocoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promocaos')->insert([
            'descricao' => 'Promoção de Maio',
            'datainicio' => Date::create(2020,5, 20 ),
            'datafim' => Date::create(2020,5, 30 ),
            'percentagem' => 10
        ]);

        DB::table('promocaos')->insert([
            'descricao' => 'Promoção de junho',
            'datainicio' => Date::create(2020,6, 1 ),
            'datafim' => Date::create(2020,6, 30 ),
            'percentagem' => 7
        ]);

        DB::table('promocaos')->insert([
            'descricao' => 'Promoção de julho',
            'datainicio' => Date::create(2020,7, 1 ),
            'datafim' => Date::create(2020,7, 31 ),
            'percentagem' => 5
        ]);

        DB::table('promocaos')->insert([
            'descricao' => 'Promoçao Inicio do Verão',
            'datainicio' => Date::create(2020,6, 20 ),
            'datafim' => Date::create(2020,7, 10 ),
            'percentagem' => 20
        ]);

        DB::table('promocaos')->insert([
            'descricao' => 'Promoçao de Outono',
            'datainicio' => Date::create(2020,10, 1 ),
            'datafim' => Date::create(2020,10, 10 ),
            'percentagem' => 12
        ]);

        DB::table('promocaos')->insert([
            'descricao' => 'Promoçao de Verão',
            'datainicio' => Date::create(2020,6, 20 ),
            'datafim' => Date::create(2020,11, 20 ),
            'percentagem' => 50
        ]);

        DB::table('promocaos')->insert([
            'descricao' => 'Promoçao de Inverno',
            'datainicio' => Date::create(2020,11, 15 ),
            'datafim' => Date::create(2020,11, 30 ),
            'percentagem' => 15
        ]);

        DB::table('promocaos')->insert([
            'descricao' => 'Promoçao de Natal',
            'datainicio' => Date::create(2020,12, 20 ),
            'datafim' => Date::create(2020,12, 25 ),
            'percentagem' => 25
        ]);

        DB::table('promocaos')->insert([
            'descricao' => 'Ramo Personalizado',
            'datainicio' => Date::create(2020,1, 1 ),
            'datafim' => Date::create(2020,12, 31 ),
            'percentagem' => 10
        ]);
    }
}
