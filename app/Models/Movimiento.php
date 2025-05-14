<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    //deinimos los campos
    protected $filllable=[
        'user_id',
        'categoria_id',
        'tipo',
        'monto',
        'descripcion',
        'foto',
        'fecha',
    ];
    //reñlaciones
    //relacion de muchoas a 1 con el modleo user poner en singular
    public function user(){
        return $this->belongsTo(User::class);
    }
    //relacion de muchos a q con el modleo categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
