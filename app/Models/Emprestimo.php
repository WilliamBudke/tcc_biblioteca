<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Emprestimo extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'data_emprestimo',
        'prazo_emprestimo',
        'data_entrega',
        'multa_emprestimo',
        'id_usuario',
        'id_livro',
    ];
}
