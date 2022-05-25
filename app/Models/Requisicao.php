<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Requisicao extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'autor_requisicao',
        'livro_requisicao',
        'editora_requisicao',
        'quantidade_requisicao',
        'numeroedicao_requisicao',
        'volume_requisicao',
        'id_fornecedor',
    ];
}
