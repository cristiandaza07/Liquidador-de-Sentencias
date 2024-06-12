<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>

    <?php echo $mensaje; ?>

        <nav class="navegacion__admin">
            <a href="<?php echo base_url('/admin/crearUsuario')?>" class="navegacion__admin-enlace seleccionado">Crear Usuario</a>
            <a href="<?php echo base_url('/admin/crearDtf')?>" class="navegacion__admin-enlace">Agregar DTF</a>
            <a href="<?php echo base_url('/admin/crearIpc')?>" class="navegacion__admin-enlace">Agregar IPC</a>
        </nav>

        <div class="contenido__panel">
            <h3>DATOS DEL NUEVO USUARIO</h3>

            <form id="formularioCrearUsuario" class="formulario__admin__crear" action="<?php echo base_url('/admin/crearUsuario/agregarUsuario') ?>" method="post">
                <input id="nombreCompleto" name="nombreCompleto" type="text" placeholder="Nombre Completo">
                <input id="correo" name="correo" type="email" placeholder="Correo">
                <div class="grid__admin-usuario">
                    <input id="usuario" name="usuario" type="text" placeholder="Usuario" title="Debe tener minimo 6 caracteres">
                    <img  id="usuarioImg" src="<?php echo base_url();?>/assets/img/invalid.png" class="imagen__admin-usuario" alt="imagen check">
                </div>
                      
                <select name="dependencia" id="dependecia">
                    <option selected disabled>Seleccionar Dependencia</option>
                    <option value="SECRETARÍA DE HACIENDA">SECRETARÍA DE HACIENDA</option>
                    <option value="SECRETARÍA GENERAL">SECRETARÍA GENERAL</option>
                    <option value="SECRETARÍA DE INFRAESTRUCTURA FÍSICA">SECRETARÍA DE INFRAESTRUCTURA FÍSICA</option>        
                    <option value="SECRETARÍA DE EDUCACIÓN">SECRETARÍA DE EDUCACIÓN</option>
                    <option value="SECRETARÍA DE TALENTO HUMANO Y DESARROLLO ORGANIZACIONAL">SECRETARÍA DE TALENTO HUMANO Y DESARROLLO ORGANIZACIONAL</option>
                    <option value="SECRETARÍA DE SALUD">SECRETARÍA DE SALUD</option>
                </select>
                <select name="tipoUsuario" id="tipoUsuario">
                    <option selected disabled>Tipo de Usuario</option>
                    <option value="Liquidador">Liquidador</option>
                    <option value="Abogado">Abogado</option>
                    <option value="Administrador">Administrador</option>
                </select>
                <input id="contraseña" name="contrasena" type="password" placeholder="Contraseña">

                <input id="btnGuardarAdmin" class="btn-crear" name="btnCrearUsuario" type="submit" value="Guardar">
            </form>
        </div>
</div>

</main>

<script src="<?php echo base_url();?>/assets/js/nuevoUsuarioAdmin.js" defer></script>

<?php echo $this->endSection(); ?>
