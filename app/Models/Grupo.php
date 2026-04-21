<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'abreviatura',
        'password',
        'tutor',
        'centro_id',
        'ciclo_id',
        'categoria_id'
    ];
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class);
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor');
    }
    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }
    public function edicion()
    {
        return $this->belongsToMany(Edicion::class, 'edicion_grupo')->first();
    }

}
