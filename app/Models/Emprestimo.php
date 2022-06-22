<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Emprestimo extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_usuario',
        'id_biblioteca',
        'status',
        'data_emprestimo',
        'data_entrega',
        'multa_emprestimo',
        'status'
    ];
    public function user(){
        return $this->belongsTo(User::class,'id_usuario');
    }
    public function emprestimo_livro(){
        return $this->hasMany(emprestimo_livro::class,'id_emprestimo');
    }
    public function Notificacao(){
        return $this->hasMany(Notificacao::class,'id_emprestimo');
    }
    public static function  consultaId($where){
        $pedido = self::where($where)->first(['id']);
        return !empty($pedido->id) ? $pedido->id : null;
    }
}
