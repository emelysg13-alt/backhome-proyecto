<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenSeguimiento extends Model
{
    protected $table = 'imagenes_seguimiento';

    protected $primaryKey = 'id_imagen';

    public $timestamps = false;

    protected $fillable = [
        'seguimiento_id',
        'ruta_imagen'
    ];
}
