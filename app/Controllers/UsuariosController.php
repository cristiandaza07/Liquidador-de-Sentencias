<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\CLI\Console;
use PhpParser\Node\Expr\FuncCall;

class UsuariosController extends BaseController{
    public function index(){
        $mensaje = session('mensaje');
        return view('index',["mensaje" => $mensaje]);
    }

    public function login(){
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        $Usuario = new UsuarioModel();

        $dataUsuario = $Usuario->obtenerUsuario(['usuario' => $usuario]);

        if(count($dataUsuario) > 0 && password_verify($contraseña, $dataUsuario[0]['contrasena'])){
            $data = [
                'idUsuario' => $dataUsuario[0]['id_usuario'],
                "usuario" => $dataUsuario[0]['usuario'],
                "nombreCompleto" => $dataUsuario[0]['nombre_completo'],
                "correo" => $dataUsuario[0]['correo'],
                "dependencia" => $dataUsuario[0]['dependencia'],
                "tipoUsuario" => $dataUsuario[0]['tipo_usuario']
            ];

            $session = session();
            $session->set($data);

            return redirect()->to(base_url('/liquidaciones')); 
            
        }else{
            $data = [
                'mensaje' => json_encode(true)
            ];

            return view('index', $data);
        }

    }

    //Verifica si los datos ingresados por el usuario existen en la BD
    public function verificarUsuario(){
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        $Usuario = new UsuarioModel();

        $dataUsuario = $Usuario->obtenerUsuario(['usuario' => $usuario]);

        if(count($dataUsuario) > 0 && password_verify($contraseña, $dataUsuario[0]['contrasena'])){
            return $this->response->setJSON(['usuarioCorrecto' => true]);   
        }else{
            return $this->response->setJSON(['usuarioCorrecto' => false]);  
        }
    }

    public function cerrarSesion(){
        $session = session();
        $session->destroy();

        return redirect()->to(base_url('/'));

    }

}