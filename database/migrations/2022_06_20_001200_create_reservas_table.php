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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('id_biblioteca');
            $table->date('data_reserva');
            $table->enum('status',['RE','LOC','RET']);//RE = RESERVADO; LOC=LOCADO; RET = PARA RETIRAR
            $table->foreignId('id_livro')->nullable()->constrained('livros')->onDelete('cascade');
            $table->foreignId('id_leitor')->nullable()->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('reservas');
    }
};
