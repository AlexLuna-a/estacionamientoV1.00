<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class espacioEspecial extends Model
{
    protected $fillable= [
    'id', 'descripcion', 'capacidad_max_esp', 'ocupacion_actual_esp', 
    'codigo_est', 'nivel_tipo'
    ];
    
    protected $table;
    
    public function __construct() {
           $this->table='espacio_esp';
    }
}
