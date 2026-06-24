<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consejo extends Model
{
    protected $table = 'consejos';

    protected $fillable = [
        'titulo',
        'descripcion'
    ];
}