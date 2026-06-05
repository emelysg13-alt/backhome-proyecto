<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalExotico extends Model
{
    protected $table = 'animal_exotico';

    protected $primaryKey = 'id_animal_e';

    public $timestamps = false;
}