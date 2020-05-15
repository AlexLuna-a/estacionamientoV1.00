<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model {

    protected $fillable= [
        'id', 'apellido_p_user', 'apellido_m_user', 'nombre_user', 'vigencia_user', 'clave_tipo'
    ];
    protected $hidden =['password_user'];
    protected $table;
    function __construct() {
        $this->table = 'usuario';
    }

    public function findUsuario($codigo) {
        $tabla = $this->getTable();

        $usuario = DB::table($tabla)->where('id', '=', $codigo)->first();

        return $usuario;
    }

   
    public function tipo(){
        return $this->belongsTo('\App\tipoUsuario','clave_tipo');
        
    }
    
    

}
