<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalDomestico extends Model
{
    protected $table = 'animal_domestico';

    protected $primaryKey = 'id_animal_d';

    public $timestamps = false;
}