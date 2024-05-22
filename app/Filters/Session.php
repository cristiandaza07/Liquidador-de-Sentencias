<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Session implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Obtener el tipo de usuario actual
        $tipoUsuario = session()->get('tipoUsuario');

        // Verificar si el tipo de usuario es 'liquidador'
        if ($tipoUsuario !== 'Liquidador' && $tipoUsuario !== 'Administrador') {
            // Denegar acceso y redirigir a la página de inicio
            return redirect()->to('/');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}