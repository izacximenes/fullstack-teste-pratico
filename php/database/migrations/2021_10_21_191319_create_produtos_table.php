<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produto', function (Blueprint $table) {
            $table->integer('id_produto')->autoIncrement();
            $table->integer('id_categoria_planejamento')->index();
            $table->dateTime('data_cadastro');
            $table->string('nome_produto', 150);
            $table->float('valor_produto', 10, 2);
            $table->foreign('id_categoria_planejamento')->references('id_categoria_planejamento')->on('tb_categoria_produto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_produto');
    }
}
