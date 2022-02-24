<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateVendasTable
 */
class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->float('total')->default(0.00);
            $table->float('descontoTotal')->default(0.00);
            $table->boolean('aberta')->default(true);
            $table->unsignedBigInteger('numContribuinte');
            $table->unsignedBigInteger('premio_id');
            $table->timestamps();

            $table->foreign('numContribuinte')->references('numContribuinte')->on('Clientes');
            $table->foreign('premio_id')->references('id')->on('vendas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
