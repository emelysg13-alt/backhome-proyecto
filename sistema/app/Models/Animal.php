<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'animal';

    protected $primaryKey = 'id_animal';

    public $timestamps = false;

    public function domestico()
    {
        return $this->hasOne(
            AnimalDomestico::class,
            'animal_id'
        );
    }

    public function exotico()
    {
        return $this->hasOne(
            AnimalExotico::class,
            'animal_id'
        );
    }
}
