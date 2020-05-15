<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    protected $fillable= [
    'id', 'placa_veh ', 'tipo_veh', 'color_veh', 'codigo_user'
    ];
    
    protected $table;
    
    public function __construct() {
           $this->table='vehiculo';
    }
}
