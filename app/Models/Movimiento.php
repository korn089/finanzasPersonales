<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    //deinimos los campos
    protected $fillable=[
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
    //evento para actualizar el monto gastado cuando se crea un movimiento
    protected static function booted(){
        static::created(function($movimiento){
            if($movimiento->tipo ==='gasto'){
                //buscar el presupuesto correspondiente
                $presupuesto= Presupuesto::where('user_id',$movimiento->user_id)
                ->where('categoria_id', $movimiento->categoria_id)
                ->where('mes', now()->format('F'))//usar el mes actual
                ->where('anio', now()->year)
                ->first();
                //si existe el presupuesto actualice el monto gastado
                if($presupuesto){
                    $presupuesto->monto_gastado += $movimiento->monto;
                    $presupuesto->save();
                }
            }
        });
    } 
}
