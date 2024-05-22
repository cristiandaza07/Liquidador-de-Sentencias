<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DtfModel;
use App\Models\UsuarioModel;
use App\Models\IpcModel;
use Exception;


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

        //Inserción del nuevo registro a la BD
        $usuario = new UsuarioModel();
        $usuario->insert($dataUsuario);

        //Mostramos mensaje al usuario por medio de SweetAlert
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
        //Conexion a la base de datos
        $db = \Config\Database::connect();
        helper('Operaciones_helper');

        $fechaDesde = $_POST['fechaDesde'];
        $fechaHasta = $_POST['fechaHasta'];
        $porcentaje = substr($_POST['porcentaje'], 0, -1); //Eliminamos el simbolo '%' para ingresar correctamente el dato en la BD
        
        $dataDtf= [
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta,
            'porcentaje' => $porcentaje
        ];

        //Inserción del nuevo registro a la BD
        $usuario = new DtfModel();
        $usuario->insert($dataDtf);

        //Mostramos mensaje al usuario por medio de SweetAlert
        $mensaje = "<script>
                        Swal.fire({
                            title: 'DTF semanal registrado',
                            icon: 'success'
                        });
                    </script>";

        $data = [
            'titulo' => "Panel de Administración",
            'header' => mostrarHeader(),
            'mensaje' => $mensaje
        ];

        return view('admin/crearNuevoDtf', $data);
    }

    public function agregarIpc(){
        //Conexion a la base de datos
        $db = \Config\Database::connect();
        helper('Operaciones_helper');


        $mes = $_POST['mes'];
        $año = $_POST['año'];
        $indice = $_POST['indice'];
        
        $dataIpc= [
            'mes' => $mes,
            'año' => $año,
            'indice' => $indice
        ];

        //Inserción del nuevo registro a la BD
        $usuario = new IpcModel();
        $usuario->insert($dataIpc);

        //Mostramos mensaje al usuario por medio de SweetAlert
        $mensaje = "<script>
                        Swal.fire({
                            title: 'IPC mensual registrado',
                            icon: 'success'
                        });
                    </script>";

        $data = [
            'titulo' => "Panel de Administración",
            'header' => mostrarHeader(),
            'mensaje' => $mensaje
        ];

        return view('admin/crearNuevoIpc', $data);
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