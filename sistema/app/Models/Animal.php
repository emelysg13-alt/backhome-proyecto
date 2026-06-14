<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'animal';

    protected $primaryKey = 'id_animal';

    public $timestamps = false;

    // Agregamos 'descripcion' aquí:
    protected $fillable = [
        'sexo',
        'color',
        'descripcion' 
    ];

    public function domestico()
    {
        return $this->belongsTo( // Nota: Cambié hasOne por belongsTo dado que la FK está en animal_domestico apuntando a animal
            AnimalDomestico::class,
            'animal_id'
        );
    }

    public function exotico()
    {
        return $this->belongsTo( // Nota: Lo mismo para exótico
            AnimalExotico::class,
            'animal_id'
        );
    }
}
