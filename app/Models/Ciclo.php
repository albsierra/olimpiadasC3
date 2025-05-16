<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'grado_id',
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id', 'id');
    }
}
