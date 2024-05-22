<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liquidaciones</title>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

        <!--<script>
            window.addEventListener('load', function() {
                const mensajeJson = <?php echo $mensaje; ?>;
                const mensaje = JSON.parse(mensajeJson);

                if(mensaje){
                    Swal.fire({
                        icon: "warning",
                        title: "Usuario o contraseña incorrecta",
                        padding: '30px',
                        width: '350px',
                        heightAuto: true
                    });
                }
            });
        </script>-->

        <script src="<?php echo base_url();?>/assets/js/validacionesLogin.js"></script>

    </body>
</html>