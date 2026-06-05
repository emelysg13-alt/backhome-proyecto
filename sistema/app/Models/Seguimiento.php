<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Animal;
use App\Models\Lugar;
use App\Models\ImagenSeguimiento;
use App\Models\HistorialEstadoSeguimiento;

class Seguimiento extends Model
{
    protected $table = 'seguimiento';

    protected $primaryKey = 'id_seguimiento';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado_reporte',
        'animal_id',
        'lugar_id',
        'cliente_id'
    ];

    public function animal()
    {
        return $this->belongsTo(
            Animal::class,
            'animal_id'
        );
    }

    public function lugar()
    {
        return $this->belongsTo(
            Lugar::class,
            'lugar_id'
        );
    }

   public function imagenPrincipal()
{
    return $this->hasOne(
        ImagenSeguimiento::class,
        'seguimiento_id',
        'id_seguimiento'
    )->where('imagen_principal', true);
}

    public function historial()
    {
        return $this->hasMany(
            HistorialEstadoSeguimiento::class,
            'seguimiento_id'
        );
    }
}