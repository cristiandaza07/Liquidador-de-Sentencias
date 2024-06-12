<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Genera un usuario de prueba con los parametros estabvlecidos
     *
     * @return void
     */
    public function run()
    {
        $password= password_hash("123", PASSWORD_DEFAULT);

        $data = [
            'usuario' => 'prueba2',
            'correo' => 'usuarioprueba2@gmail.com',
            'nombre_completo' => 'Camilo Correa',
            'dependencia' => 'Secretaria Vial',
            'tipo_usuario' => 'Administrador',
            'contrasena' => $password
        ];

        //Usuario Query
        $this->db->table('usuarios')->insert($data);
    }
}
