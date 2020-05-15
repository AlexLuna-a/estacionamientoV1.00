<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class estacionamiento extends Model
{
    protected $fillable= [
        'id', 'nombre_est', 'ubicacion_est', 'capacidad_max_est', 'ocupacion_actual_est',
    'nivel_est'
    ];
    protected $table;
    
    public function __construct() {
           $this->table='estacionamiento';
    }
    
public function getDisponibles($nivel = null){
    if(!$nivel){
        $nivel = 3;
    }
        $estacionamientos= DB::table($this->table)->where('nivel_est','<=',$nivel)->get();
        return $estacionamientos;
    }
    public function getReg($id){
        $estacionamiento= DB::table($this->table)->where('id','=',$id)->first();
        return $estacionamiento;
    }
    public function actualizar(){
        $e = DB::table($this->table)->where('id', '=', $this->id)
                                     ->update(array(
                                         'nombre_est' => $this->nombre_est,
                                         'ubicacion_est' => $this->ubicacion_est,
                                         'capacidad_max_est' => $this->capacidad_max_est, 
                                         'ocupacion_actual_est' => $this->ocupacion_actual_est,
                                         'nivel_est' => $this->nivel_est
                                     ));
    }
    
    public function nomDuplicados($nombre){
        $estacionamientos= DB::table($this->table)->where('nombre_est','=',$nombre)->first();
        if($estacionamientos){
            return $estacionamientos->id;
        }
        return null;
        
        
    }
    
    
    public function ubiDuplicados($ubi){
        $estacionamientos= DB::table($this->table)->where('ubicacion_est','=',$ubi)->first();
        if($estacionamientos){
            return $estacionamientos->id;
        }
        
        return null;
    }
}
    
    

