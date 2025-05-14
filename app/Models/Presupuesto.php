<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    //
    protected $fillable=[
        'user_id',
        'categoria_id',
        'monto_asignado',
        'monto_gastado',
        'mes',
        'anio',
    ];
    //relaciones
    //relacion de muchoas a 1 con el modleo user poner en singular
    public function user(){
        return $this->belongsTo(User::class);
    }
    //relacion de muchos a q con el modleo categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
