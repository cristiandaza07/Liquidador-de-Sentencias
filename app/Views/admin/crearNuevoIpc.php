<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>

        <?php echo $mensaje; ?>

        <nav class="navegacion__admin">
            <a href="<?php echo base_url('/admin/crearUsuario')?>" class="navegacion__admin-enlace">Crear Usuario</a>
            <a href="<?php echo base_url('/admin/crearDtf')?>" class="navegacion__admin-enlace">Agregar DTF</a>
            <a href="<?php echo base_url('/admin/crearIpc')?>" class="navegacion__admin-enlace seleccionado">Agregar IPC</a>
        </nav>

        <div class="contenido__panel">
        <h3>DATOS DEL NUEVO IPC</h3>

            <form id="formularioCrearIpc" class="formulario__admin__crear" action="<?php echo base_url('/admin/usuarioExiste2') ?>" method="post">
                <select name="mes" id="mes">
                    <option selected disabled>Seleccionar Mes</option>
                    <option class="i" value="Enero">Enero</option>
                    <option value="Febrero">Febrero</option>
                    <option value="Marzo">Marzo</option>
                    <option value="Abril">Abril</option>
                    <option value="Mayo">Mayo</option>
                    <option value="Junio">Junio</option>
                    <option value="Julio">Julio</option>
                    <option value="Agosto">Agosto</option>
                    <option value="Septiembre">Septiembre</option>
                    <option value="Octubre">Octubre</option>
                    <option value="Noviembre">Noviembre</option>
                    <option value="Diciembre">Diciembre</option>
                </select>
                <input id="indice" name="indice" type="text" placeholder="Indice">

                <input id="btnGuardarAdmin" class="btn-crear" name="btnCrearIpc" type="submit" value="Guardar">

            </form>
        </div>

</main>

<script src="<?php echo base_url();?>/assets/js/nuevoIpcAdmin.js" defer></script>

<?php echo $this->endSection(); ?>