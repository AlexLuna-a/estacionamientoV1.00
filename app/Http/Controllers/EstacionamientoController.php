<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\estacionamiento;
use App\tipoUsuario;

class estacionamientoController extends Controller {

    private $estacionamiento;

    function __construct() {
        $this->estacionamiento = new estacionamiento();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $aux = new estacionamiento();
        $estacionamientos = $aux->getDisponibles(session('nivel'));
        return view('Estacionamiento.index')->with(['estacionamientos' => $estacionamientos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $tipos= new tipoUsuario();
        $t = $tipos->getDisponibles(session('nivel'));
        return view('Estacionamiento.form')->with([
            'accion' => 'Crear registro',
            'tipos' => $t]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $id=$request->input('id');
        $nombre=$request->input('nombre');
        $ubicacion=$request->input('ubicacion'); 
        $auxID=$this->estacionamiento->nomDuplicados($nombre);
        if(isset($auxID) && $auxID != $id){
            $error=true;
        }
        $auxID=$this->estacionamiento->ubiDuplicados($ubicacion);
        if(isset($auxID) && $auxID != $id){
            $error=true;
        }
        if($error){
            
            session()->flash('mensajeError', 'El nombre o la ubicacion ya han sido registrados');
            return redirect()->action('estacionamientoController@create');
        }
        
        $this->estacionamiento->id=$id;
        $this->estacionamiento->nombre_est=$nombre;
        $nivel=$request->input('nivel');
        $this->estacionamiento->nivel_est=$nivel;
        $this->estacionamiento->ubicacion_est=$ubicacion;
        $maxima=$request->input('maxima');
        $this->estacionamiento->capacidad_max_est=$maxima;
        $actual=$request->input('actual');
        $this->estacionamiento->ocupacion_actual_est=$actual;
        
        
        
        
        
        
        $this->estacionamiento->actualizar();
        $mensajeCompleto='Se ha actualizado el registro';
        session()->flash('mensajeCompleto', $mensajeCompleto);
        return redirect()->action('estacionamientoController@edit',[ 'id' => $id]);
        //
    }
    
    public function save(Request $request){
        $nombre=$request->input('nombre');
        $ubicacion=$request->input('ubicacion'); 
        $auxID=$this->estacionamiento->nomDuplicados($nombre);
        if(isset($auxID)){
            $error=true;
        }
        $auxID=$this->estacionamiento->ubiDuplicados($ubicacion);
        if(isset($auxID)){
            $error=true;
        }
        if($error){
            
            session()->flash('mensajeError', 'El nombre o la ubicacion ya han sido registrados');
            return redirect()->action('estacionamientoController@create');
        }
        $this->estacionamiento->nombre_est=$nombre;
        $nivel=$request->input('nivel');
        $this->estacionamiento->nivel_est=$nivel;
        $this->estacionamiento->ubicacion_est=$ubicacion;
        $maxima=$request->input('maxima');
        $this->estacionamiento->capacidad_max_est=$maxima;
        $actual=$request->input('actual');
        $this->estacionamiento->ocupacion_actual_est=$actual;
        $this->estacionamiento->save();
        $mensajeCompleto='Se ha creado el registro';
        session()->flash('mensajeCompleto', $mensajeCompleto);
        return redirect()->action('estacionamientoController@create');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $acces=null;
        $estacionamiento = $this->estacionamiento->getReg($id);
        if (session('nivel') >= 9) {
            $auxT = new tipoUsuario();
            $acces = $auxT->getAcces($estacionamiento->nivel_est);
        }
        return view('Estacionamiento.detalle')->with(['est' => $estacionamiento,
                'acces' => $acces]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $est = new estacionamiento();
        $e =$est->getReg($id);
        $tipos= new tipoUsuario();
        $t = $tipos->getDisponibles(session('nivel'));
        return view('Estacionamiento.form')->with(['e' => $e,
            'accion' => 'actualizar registro',
            'tipos' => $t]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
