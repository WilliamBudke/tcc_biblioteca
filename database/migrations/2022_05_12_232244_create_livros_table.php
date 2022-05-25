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
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->integer('edicao');
            $table->integer('volume');
            $table->string('isbn')->unique();
            $table->string('autor');
            $table->string('genero');
            $table->string('editora');
            $table->string('quantidade');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('id_biblioteca');
            $table->foreign('id_biblioteca')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('livros');
    }
};