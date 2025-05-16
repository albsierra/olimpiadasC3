<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
    ];

    public function ciclos()
    {
        return $this->hasMany(Ciclo::class, 'grado_id', 'id');
    }
}
