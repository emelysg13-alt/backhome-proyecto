<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documento';

    protected $primaryKey = 'id_t_doc';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;
}