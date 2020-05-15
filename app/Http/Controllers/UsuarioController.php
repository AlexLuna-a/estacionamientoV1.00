<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\tipoUsuario;

class UsuarioController extends Controller {

    private $usuario;

    function __construct() {
        $this->usuario = new Usuario();
    }

    public function setUsuario() {
        if (session()->exists('usuario')) {
            $this->usuario->id = session('usuario')->id;
            $this->usuario->password_user = session('usuario')->password_user;
            $this->usuario->apellido_p_user = session('usuario')->apellido_p_user ;
            $this->usuario->apellido_m_user = session('usuario')->apellido_m_user;
            $this->usuario->nombre_user = session('usuario')->nombre_user;
            $this->usuario->clave_tipo = session('usuario')->clave_tipo;
            $this->usuario->fecha_ingreso_user = session('usuario')->fecha_ingreso_user;
            $this->usuario->vigencia_user = session('usuario')->vigencia_user ;
        }
    }
    public function setUsuariotemp($usuario) {
            $this->usuario->id = $usuario->id;
            $this->usuario->password_user = $usuario->password_user;
            $this->usuario->apellido_p_user = $usuario->apellido_p_user ;
            $this->usuario->apellido_m_user = $usuario->apellido_m_user;
            $this->usuario->nombre_user = $usuario->nombre_user;
            $this->usuario->clave_tipo = $usuario->clave_tipo;
            $this->usuario->fecha_ingreso_user = $usuario->fecha_ingreso_user;
            $this->usuario->vigencia_user = $usuario->vigencia_user ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loggin() {
        return view('Usuario.loggin');
    }

    public function loggout() {
        session()->flush();
        return redirect()->action('usuarioController@index');
    }
        
    public function loggin_in(Request $request) {

        $codigo = $request->input('codigo_user');
        $pass = $request->input('password_user');
        $usuario = $this->usuario->findUsuario($codigo);

        if ($usuario) {

            if ($codigo == $usuario->id &&
                    $pass == $usuario->password_user) {
                session()->put(['usuario' => $usuario]);
                $this->setUsuario();
                session()->put(['nivel' => $this->usuario->tipo->nivel_tipo]);
                return redirect()->action('usuarioController@index');
            } else {

                $mensaje = 'el usuario y/o la contraseña no coinciden, intentalo de nuevo';
            }
        } else {

            $mensaje = 'no se reconoce el usuario';
        }

        if ($mensaje) {

            session()->flash('mensaje', $mensaje);
            return redirect()->action('usuarioController@loggin');
        }
    }

    public function reg() {
        $tipHelp = new tipoUsuario();
        $tipos = $tipHelp->getDisponibles();
        return view('Usuario.formCU', ['tipos' => $tipos]);
    }

    public function reg_in(Request $request) {
        $codigo = $request->input('codigo_user');
        if (session()->exists('usuario')) {
            if ($codigo != session('usuario')->id) {
                $usuario = $this->usuario->findUsuario($codigo);
                if (is_object($usuario)){
                    session()->flash('mensajeError', 'Error! El codigo le pertenece a otro usuario');
                    return redirect()->action('usuarioController@edit');
                }
            }
        }

        $pass = $request->input('password');
        $apellidoP = $request->input('apellidoP');
        $apellidoM = $request->input('apellidoM');
        $nombre = $request->input('nombre');
        $tipo = $request->input('tipo');

        $this->usuario->id = $codigo;
        $this->usuario->password_user = $pass;
        $this->usuario->apellido_p_user = $apellidoP;
        $this->usuario->apellido_m_user = $apellidoM;
        $this->usuario->nombre_user = $nombre;
        $this->usuario->clave_tipo = $tipo;


        if (session()->exists('usuario')) {
            session()->flush();
            $this->usuario->update();
            

            $usuario = $this->usuario->findUsuario($codigo);
            session()->put(['usuario' => $usuario]);

            session()->flash('mensajeCompleto', 'Se han guardado los cambios');
            return redirect()->action('usuarioController@edit');
        } else {


            $fecha = date("y-m-d");
            $this->usuario->fecha_ingreso_user = $fecha;
            $helpDate = strtotime('last day of December', time());
            $fecha = date("y-m-d", $helpDate);
            $this->usuario->vigencia_user = $fecha;

            $this->usuario->save();

            $usuario = $this->usuario->findUsuario($codigo);
            $request->session()->put(['usuario' => $usuario]);

            return redirect()->action('usuarioController@index');
        }
    }

    public function index() {
        if (session()->exists('usuario')) {
            
            return view('Usuario.index');
            
        } else {
            return redirect()->action('usuarioController@loggin');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        $tipHelp = new tipoUsuario();
        $tipos = $tipHelp->getDisponibles(session('nivel'));
        $usuario = session('usuario');
        return view('usuario.formCU', [
            'accion' => 'Actualiza tu informacion',
            'tipos' => $tipos,
            'usuario' => $usuario
        ]);
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
