<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Livros extends Model
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'titulo',
        'edicao',
        'volume',
        'isbn',
        'autor',
        'genero',
        'editora',
        'id_biblioteca',
        'quantidade',
        'image',
    ];
}
