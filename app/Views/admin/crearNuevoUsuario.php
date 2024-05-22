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
                    <option value="DESPACHO DEL GOBERNADOR">DESPACHO DEL GOBERNADOR</option>
                    <option value="SECRETARÍA DE INFRAESTRUCTURA FÍSICA">SECRETARÍA DE INFRAESTRUCTURA FÍSICA</option>
                    <option value="SECRETARÍA DE AMBIENTE Y SOSTENIBILIDAD">SECRETARÍA DE AMBIENTE Y SOSTENIBILIDAD</option>
                    <option value="GERENCIA DE SERVICIOS PÚBLICOS">GERENCIA DE SERVICIOS PÚBLICOS</option>
                    <option value="SERES-SECRETARÍA REGIONAL Y SECTORIAL DE SEGURIDAD HUMANA">SERES-SECRETARÍA REGIONAL Y SECTORIAL DE SEGURIDAD HUMANA</option>
                    <option value="SECRETARÍA DE ASUNTOS INSTITUCIONALES PAZ Y NO VIOLENCIA">SECRETARÍA DE ASUNTOS INSTITUCIONALES PAZ Y NO VIOLENCIA</option>
                    <option value="SECRETARÍA DE SEGURIDAD Y JUSTICIA">SECRETARÍA DE SEGURIDAD Y JUSTICIA</option>
                    <option value="SECRETARÍA DE PARTICIPACIÓN Y CULTURA CIUDADANA">SECRETARÍA DE PARTICIPACIÓN Y CULTURA CIUDADANA</option>
                    <option value="DEPARTAMENTO ADMINISTRATIVO DE GESTIÓN DEL RIESGO DE DESASTRES DAGRAN">DEPARTAMENTO ADMINISTRATIVO DE GESTIÓN DEL RIESGO DE DESASTRES DAGRAN</option>
                    <option value="SEGURIDAD VIAL">SEGURIDAD VIAL</option>
                    <option value="GERENCIA DE MUNICIPIOS">GERENCIA DE MUNICIPIOS</option>
                    <option value="SECRETARÍA SECCIONAL DE SALUD Y PROTECCIÓN SOCIAL DE ANTIOQUIA">SECRETARÍA SECCIONAL DE SALUD Y PROTECCIÓN SOCIAL DE ANTIOQUIA</option>
                    <option value="SECRETARIA DE LAS MUJERES">SECRETARIA DE LAS MUJERES</option>
                    <option value="SECRETARÍA DE INCLUSIÓN SOCIAL Y FAMILIA">SECRETARÍA DE INCLUSIÓN SOCIAL Y FAMILIA</option>
                    <option value="SERES-SECRETARÍA REGIONAL Y SECTORIAL DE EDUCACIÓN, CULTURA Y DEPORTE">SERES-SECRETARÍA REGIONAL Y SECTORIAL DE EDUCACIÓN, CULTURA Y DEPORTE</option>
                    <option value="SECRETARÍA DE EDUCACIÓN">SECRETARÍA DE EDUCACIÓN</option>
                    <option value="SERES-SECRETARÍA REGIONAL Y SECTORIAL DE DESARROLLO ECONÓMICO, INNOVACIÓN Y NUEVAS ECONOMÍAS">SERES-SECRETARÍA REGIONAL Y SECTORIAL DE DESARROLLO ECONÓMICO, INNOVACIÓN Y NUEVAS ECONOMÍAS</option>
                    <option value="SECRETARÍA DE PRODUCTIVIDAD">SECRETARÍA DE PRODUCTIVIDAD</option>
                    <option value="SECRETARÍA DE MINAS">SECRETARÍA DE MINAS</option>
                    <option value="SECRETARÍA DE AGRICULTURA Y DESARROLLO RURAL">SECRETARÍA DE AGRICULTURA Y DESARROLLO RURAL</option>
                    <option value="SECRETARÍA DE TURISMO">SECRETARÍA DE TURISMO</option>
                    <option value="SECRETARÍA DE TALENTO HUMANO Y DESARROLLO ORGANIZACIONAL">SECRETARÍA DE TALENTO HUMANO Y DESARROLLO ORGANIZACIONAL</option>
                    <option value="SECRETARÍA DE TECNOLOGÍAS DE INFORMACIÓN Y LAS COMUNICACIONES">SECRETARÍA DE TECNOLOGÍAS DE INFORMACIÓN Y LAS COMUNICACIONES</option>
                    <option value="SECRETARÍA DE SUMINISTROS Y SERVICIOS">SECRETARÍA DE SUMINISTROS Y SERVICIOS</option>
                    <option value="DEPARTAMENTO ADMINISTRATIVO DE PLANEACIÓN">DEPARTAMENTO ADMINISTRATIVO DE PLANEACIÓN</option>
                    <option value="GERENCIA DE AUDITORÍA INTERNA">GERENCIA DE AUDITORÍA INTERNA</option>
                
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
