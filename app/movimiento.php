<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class movimiento extends Model
{
   protected $fillable= [
        'codigo_user', 'codigo_est', 'fecha_mov', 'accion_mov',
    ];
    
    protected $table;
    
    public function __construct() {
           $this->table='movimientos';
    }
    public function getPorUser($user){
        $mov= DB::table($this->table)->where('codigo_user','=',$user)
                ->orderBy('fecha_mov','desc')
                ->get();
        return $mov;
    }
    public function getPorEst($est){
        $mov= DB::table($this->table)->where('codigo_est','=',$est)
                ->orderBy('fecha_mov','desc')
                ->get();
        return $mov;
    }
    public function getPorUserEst($user,$est){
        $mov= DB::table($this->table)->where('codigo_user','=',$user)
                ->where('codigo_est','=', $est)
                ->orderBy('fecha_mov','desc')
                ->get();
        return $mov;
    }
    public function getLastMov($user,$est){
        $mov= DB::table($this->table)->where('codigo_user','=',$user)
                ->where('codigo_est','=', $est)
                ->orderBy('fecha_mov','desc')
                ->first();
        return $mov;
    }
    
    
    
    
    
    
    
    
    
}
