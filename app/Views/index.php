<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liquidaciones</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/recursos/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style.css">
    </head>
    <body>
    <head>
        <header>
                <nav class="navegacion">
                    <a href="<?php echo base_url('/liquidaciones') ?>">
                        <img src="<?php echo base_url();?>/assets/img/Logo blanco.png" class="logo navegacion__enlace" alt="imagen logo">
                    </a>
                    <h2 class="navegacion__titulo" href="index.html">Sistema de Liquidación de Sentencias</h2>
                </nav>
            </header>
        </head>
        <main>

                    <div class="contenedor__formulario">
                        <!--LOGIN-->
                        <form id="formularioLogin" action="<?php echo base_url('/login') ?>" method="post" class="formulario__login">
                            <h2>Iniciar Sesión</h2>
                            <input name="usuario" id="usuario" type="text" placeholder="Usuario">
                            <input name="contraseña" id="contraseña" type="password" placeholder="Contraseña">
                            <button class="btn__entrar" id="btnEntrar">Entrar</button>
                        </form>
                    </div>
        </main>

        <script src="<?php echo base_url();?>assets/recursos/sweetalert2.all.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/validacionesLogin.js"></script>

    </body>
</html>