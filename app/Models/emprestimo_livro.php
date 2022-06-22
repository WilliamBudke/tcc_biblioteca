<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class emprestimo_livro extends Model
{
    use HasFactory;

    protected $primaryKey = 'emprestimo_id';

    protected $fillable = [
        'data_emprestimo',
        'id_biblioteca',
        'data_entrega',
        'multa_emprestimo',
        'id_livro',
        'id_emprestimo',
    ];

    public function Emprestimo(){
        return $this->belongsTo(Livros::class,'id_livro');
    }
}
