<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administrador';

    protected $primaryKey = 'id_admin';

    public $incrementing = true;

    protected $fillable = [
        'persona_id'
    ];

    public $timestamps = false;
}