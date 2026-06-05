<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialEstadoSeguimiento extends Model
{
    protected $table =
        'historial_estado_seguimiento';

    protected $primaryKey =
        'id_historial';

    public $timestamps = false;
}
