<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tipoUsuario extends Model
{
    protected $fillable= [
        'id', 'nombre_tipo', 'descripcion_tipo', 'nivel_tipo'
    ];
    
    protected $table;
    
    public function __construct() {
           $this->table='tipo_usuario';
    }
    
    
    public function getDisponibles( $limit = null){
    $table = $this->getTable(); 
    
    if(!$limit){
        $limit = 4;
    }
        $tipos = DB::table($table)->where('nivel_tipo','<=',$limit)->orderBy('nivel_tipo','desc')->get();
        return $tipos;
    }
    
    public function getAcces( $limit){
    $table = $this->getTable();
        $tipos = DB::table($table)->where('nivel_tipo','>=',$limit)->orderBy('nivel_tipo','asc')->get();
        return $tipos;
    }
    
    
    
    


    
}
