<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateArtigoRamosTable
 */
class CreateArtigoRamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigo_ramos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ramo_id');
            $table->integer('codProduto');
            $table->string('descricao');
            $table->float('preco_artigo_uni');
            $table->integer('percentagemPromo')->nullable();
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('ramo_id')->references('codProduto')->on('ramos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artigo_ramos');
    }
}
