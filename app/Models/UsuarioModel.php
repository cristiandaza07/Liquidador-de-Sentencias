<?php

namespace App\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //o tambien Object
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre_completo', 'correo', 'usuario', 'contrasena', 'dependencia', 'tipo_usuario', 'fecha_creacion'];

    protected bool $allowEmptyInserts = false;

    public function obtenerUsuario($data){
        $Usuario = $this->db->table('usuarios');
        $Usuario->where($data);
        return $Usuario->get()->getResultArray();
    }
}
