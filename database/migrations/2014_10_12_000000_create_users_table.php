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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cnpj')->nullable()->unique();
            $table->string('cpf')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('endereco')->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('bairro')->nullable();
            $table->string('zip')->nullable();
            $table->boolean('usuario')->nullable();
            $table->boolean('admin')->nullable();
            $table->integer('bibilioteca_usuario')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
