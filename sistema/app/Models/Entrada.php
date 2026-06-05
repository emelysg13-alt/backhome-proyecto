<?php

namespace App\Models;

use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrada extends Model
{

use HasFactory;

//protected $table = 'entradas';
//protected $primaryKey = 'id';
    protected $fillable = [
        'titulo',
        'tag',
        'contenido',
        'user_id',
    ];

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
