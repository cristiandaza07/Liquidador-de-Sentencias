<!doctype html>
<html lang="en">
    <head>
        <header>
                <nav class="navegacion">
                    <a href="<?php echo base_url('/liquidaciones') ?>">
                        <img src="<?php echo base_url();?>/assets/img/Logo blanco.png" class="logo navegacion__enlace" alt="imagen logo">
                    </a>
                    <h2 class="navegacion__titulo" href="index.html">Sistema de Liquidación de Sentencias</h2>
                    <ul class="menu-horizontal">
                        <li>
                            <a href="#"><?php echo session('usuario')?>
                            <img class="icono-usuario" src="<?php echo base_url();?>/assets/img/usuario.png" alt="Imagen Usuario">
                            </a>

                            <ul class="menu-vertical">
                                <li><h5><?php echo session('correo')?></h5></li>
                                <li><a href="<?php echo base_url('/admin/crearUsuario') ?>">Administrar</a></li>
                                <li><a href="<?php echo base_url('/salir') ?>">Cerrar Sesión</a></li>
                                
                            </ul>
                        </li>

                    </ul>
                </nav>
        </header>
    </head>
    <body>