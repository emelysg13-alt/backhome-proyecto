<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'contenido',
        'entrada_id',
        'user_id',
    ];

    public function entrada()
    {
        $this->belongsTo(Entrada::class, 'entrada_id');
    }

    public function usuario()
    {
     $this->belongsTo(User::class, 'user_id');
    }
}
