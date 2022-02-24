<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateRamosTable
 */
class CreateRamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramos', function (Blueprint $table) {
            $table->integer('codProduto')->primary();
            $table->double('preco');
            $table->string('descricao');
            $table->integer('quantidade_stock');
            $table->boolean('personalizavel')->default(false);
            $table->unsignedBigInteger('promocao_id')->nullable();
            $table->unsignedBigInteger('ocasiao_id')->nullable();
            $table->string('image_path')->nullable()->unique();
            $table->timestamps();
            $table->foreign('promocao_id')->references('id')->on('promocaos');
            $table->foreign('ocasiao_id')->references('id')->on('ocasiao_especials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ramos');
    }
}
