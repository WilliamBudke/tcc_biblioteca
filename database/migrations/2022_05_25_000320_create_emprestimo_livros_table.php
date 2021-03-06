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
            $table->string('id_biblioteca');
            $table->date('data_emprestimo');
            $table->date('data_entrega');
            $table->float('multa_emprestimo')->nullable();
            $table->enum('status',['RE','LOC','DEV', 'RET']);//RE = RESERVADO; LOC=LOCADO; DEV= DEVOVLIDO
            $table->foreignId('id_livro')->nullable()->constrained('livros')->onDelete('cascade');
            $table->foreignId('id_emprestimo')->nullable()->constrained('emprestimos')->onDelete('cascade');
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
