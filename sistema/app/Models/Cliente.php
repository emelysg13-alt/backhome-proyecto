<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    public $incrementing = true;

    protected $fillable = [
        'persona_id'
    ];

    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}

