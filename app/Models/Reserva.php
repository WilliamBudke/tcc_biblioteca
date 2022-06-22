<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reserva extends Model
{
    use HasFactory, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_leitor',
        'id_biblioteca',
        'id_livro',
        'status',
        'data_reserva',
    ];
    public function LivroReserva(){
        return $this->belongsTo(Livros::class,'id_livro');
    }
    public function UserReserva(){
        return $this->belongsTo(User::class,'id_leitor');
    }
}
