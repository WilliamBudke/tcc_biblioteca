<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Fornecedor extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nome_fornecedor',
        'cnpj_fornecedor',
        'email_fornecedor',
    ];
}
