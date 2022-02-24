<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras', function (Blueprint $table) {
            $table->integer('codProduto')->primary();
            $table->double('preco');
            $table->string('descricao');
            $table->integer('quantidade_stock');
            $table->unsignedBigInteger('promocao_id')->nullable();
            $table->string('image_path')->nullable()->unique();
            $table->timestamps();

            $table->foreign('promocao_id')->references('id')->on('promocaos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extras');
    }
}
