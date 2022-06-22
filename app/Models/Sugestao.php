<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugestao extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'sugestao',
        'id_user'
    ];

    public function User(){
        return $this->belongsTo(User::class,'id_user');
    }
}
