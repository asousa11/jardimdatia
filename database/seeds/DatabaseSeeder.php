<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EpocasSeeder::class);
        $this->call(OcasiaoEspecialSeeder::class);
        $this->call(SugestoesSeeder::class);
        $this->call(PromocoesSeeder::class);
        $this->call(ClientesSeeder::class);
        $this->call(PremioSeeder::class);
        $this->call(ProdutosSeeder::class);
        $this->call(ArtigoRamoSeeder::class);
    }
}
