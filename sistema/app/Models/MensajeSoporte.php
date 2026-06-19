<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajeSoporte extends Model
{
    protected $table = 'mensajes_de_soporte';
    protected $primaryKey = 'id_mensaje';

    public $timestamps = false; 

    protected $fillable = [
        'cliente_id',
        'mensaje_cliente',
        'fecha_mensaje'
    ];
}