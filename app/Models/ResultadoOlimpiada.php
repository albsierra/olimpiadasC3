<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoOlimpiada extends Model
{
    protected $connection = 'olimpiadas';
    protected $table      = 'resultados_olimpiadas_cache';
    public    $timestamps = false;
}
