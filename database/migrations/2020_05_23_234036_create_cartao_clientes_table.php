<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCartaoClientesTable
 */
class CreateCartaoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartao_clientes', function (Blueprint $table) {
            $table->integer('numCartao')->primary();
            $table->double('consumoAcumulado')->default(0);
            $table->double('consumoUsado')->default(0);
            $table->double('saldoAcumulado')->default(0);
            $table->integer('pontosDisponiveis')->default(0);
            $table->unsignedBigInteger('numContribuinte')->nullable();
            $table->integer('lastQuiz')->default(0);
            $table->timestamps();
            $table->foreign('numContribuinte')->references('numContribuinte')->on('clientes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartao_clientes');
    }
}
