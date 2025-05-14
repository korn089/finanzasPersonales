<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $fillable=[
        'nombre',
        'tipo',
    ];
    //relaciones
    //uno a muchos en el modelo movimiento
    public function movimientos(){
        return $this->hasMany(Movimiento::class);
    }
}
