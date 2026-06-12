<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    protected $table = 'lugares';

    protected $primaryKey = 'id_lugar';

    public $timestamps = false;

    protected $fillable = [
        'direccion',
        'localidad_id'
    ];

    public function localidad()
    {
        return $this->belongsTo(
            Localidad::class,
            'localidad_id'
        );
    }
}
