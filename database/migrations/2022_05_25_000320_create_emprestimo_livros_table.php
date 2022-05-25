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
        Schema::create('emprestimo_livros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_livro');
            $table->foreign('id_livro')->references('id')->on('livros')->onDelete('cascade');
            $table->unsignedBigInteger('id_emprestimo');
            $table->foreign('id_emprestimo')->references('id')->on('emprestimos')->onDelete('cascade');
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
        Schema::dropIfExists('emprestimo_livros');
    }
};
