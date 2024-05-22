<?php

namespace App\Controllers\Admin;

use App\Models\UsuarioModelModel;
use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\CLI\Console;
use Exception;
use PharIo\Manifest\Library;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends BaseController{

    //Muestra la sección para crear nuevo usuario
    public function menuAdmin(){
        helper('Operaciones_helper');
        $data = [
            'titulo' => "Panel de Administración",
            'header' => mostrarHeader(),
            'mensaje' => ""
        ];
        
        return view('admin/crearNuevoUsuario', $data);
    }

    //Muestra la sección para crear nuevo DTF
    public function crearNuevoDtf(){
        helper('Operaciones_helper');
        $data = [
            'titulo' => "Panel de Administración",
            'header' => mostrarHeader(),
            'mensaje' => ""
        ];
        
        return view('admin/crearNuevoDtf', $data);
    }

    //Muestra la sección para crear nuevo IPC
    public function crearNuevoIpc(){
        helper('Operaciones_helper');
        $data = [
            'titulo' => "Panel de Administración",
            'header' => mostrarHeader(),
            'mensaje' => ""
        ];
        
        return view('admin/crearNuevoIpc', $data);
    }

    public function agregarUsuario(){
        //Conexion a la base de datos
        $db = \Config\Database::connect();
        helper('Operaciones_helper');

        $nombreCompleto = $_POST['nombreCompleto'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $dependencia = $_POST['dependencia'];
        $tipoUsuario = $_POST['tipoUsuario'];
        $password= password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

        $query = $db->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
        $Usuario = $query->getResultArray();
        if(count($Usuario) > 0){
            $mensaje = "<script>
                            Swal.fire({
                                title: 'El usuario ya existe',
                                icon: 'error'
                            });
                        </script>";
           return redirect()->back();
        }
        
        $dataUsuario= [
            'nombre_completo' => $nombreCompleto,
            'correo' => $correo,
            'usuario' => $usuario,
            'dependencia' => $dependencia,
            'tipo_usuario' => $tipoUsuario,
            'contrasena' => $password
        ];

        $usuario = new UsuarioModel();
        $usuario->insert($dataUsuario);

        $mensaje = "<script>
                        Swal.fire({
                            title: 'Usuario creado',
                            icon: 'success'
                        });
                    </script>";

        $data = [
            'titulo' => "Panel de Administración",
            'header' => mostrarHeader(),
            'mensaje' => $mensaje
        ];

        return view('admin/crearNuevoUsuario', $data);
    }

    public function agregarDtf(){
        
    }

    //Verifica si el usuario ingresado al intertar crear un nuevo usuario ya existe
    public function usuarioExiste(){
        try{
            //Conexion a la base de datos
            $db = \Config\Database::connect();

            $usuario = $_POST['usuario'];
                   
            //Verificamos en la BD si el usuario ingresado ya existe
            $query = $db->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
            $usuario = $query->getResultArray();

            $usuarioExiste = false;

            if(count($usuario) > 0){
                $usuarioExiste = true;
            }else{
                $usuarioExiste = false;
            }
            
            return $this->response->setJSON(['usuarioExiste' => $usuarioExiste]);

        }catch (Exception $e) {
            echo json_encode('Error: '. $e->getMessage());
        }
    }
}