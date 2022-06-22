<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Notificacao extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'mensagens_notificacoes',
        'id_emprestimo',
        'data'
    ];

    public static function  consultaId($where){
        $emp = self::where('id_emprestimo',$where)->first(['id']);
        return !empty($emp->id) ? $emp->id : null;
    }

}
