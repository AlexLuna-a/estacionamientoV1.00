<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movimientoEspecial extends Model
{
    protected $fillable= [
    'codigo_user', 'placa_veh', 'codigo_esp', 'fecha_esp', 'accion_esp',
    'razon_esp'
    ];
    
    protected $table;
    
    public function __construct() {
           $this->table='movimientos_esp';
    }
}
