<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicaos', function (Blueprint $table) {
            $table->id();
            $table->string('autor_requisicao');
            $table->string('livro_requisicao');
            $table->string('editora_requisicao');
            $table->integer('quantidade_requisicao');
            $table->integer('numeroedicao_requisicao');
            $table->integer('volume_requisicao');
            $table->foreignId('id_biblioteca')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_fornecedor')->nullable()->constrained('fornecedors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisicaos');
    }
};
