<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flors', function (Blueprint $table) {
            $table->integer('codProduto')->primary();
            $table->double('preco');
            $table->string('descricao');
            $table->integer('quantidade_stock');
            $table->unsignedBigInteger('epoca_id');
            $table->unsignedBigInteger('promocao_id')->nullable();
            $table->string('image_path')->nullable()->unique();
            $table->timestamps();

            $table->foreign('promocao_id')->references('id')->on('promocaos')->onDelete('cascade');

            $table->foreign('epoca_id')->references('id')->on('epocas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flors');
    }
}
