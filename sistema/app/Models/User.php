<?php

namespace App\Models;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'personas';

    protected $primaryKey = 'id_persona';

    protected $fillable = [

        't_documento_id',
        'n_documento',

        'primer_nombre',
        'segundo_nombre',

        'primer_apellido',
        'segundo_apellido',

        'numero_tel',

        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'persona_id', 'id_persona');
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'persona_id', 'id_persona');
    }
}