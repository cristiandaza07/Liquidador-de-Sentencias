<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>

    <?php echo $mensaje; ?>

        <nav class="navegacion__admin">
            <a href="<?php echo base_url('/admin/crearUsuario')?>" class="navegacion__admin-enlace">Crear Usuario</a>
            <a href="<?php echo base_url('/admin/crearDtf')?>" class="navegacion__admin-enlace seleccionado">Agregar DTF</a>
            <a href="<?php echo base_url('/admin/crearIpc')?>" class="navegacion__admin-enlace">Agregar IPC</a>
        </nav>

        <div class="contenido__panel">
        <h3>DATOS DEL NUEVO DTF</h3>

            <form id="formularioCrearDTf" class="formulario__admin__crear" action="<?php echo base_url('/admin/crearDtf/agregarDtf') ?>" method="post">
                <div class="grid__fechas__nuevo-Dtf">
                    <input id="fechaDesde" name="fechaDesde" type="date">
                    <p>a</p>
                    <input id="fechaHasta" name="fechaHasta" type="date">
                </div>
                <input id="porcentaje" name="porcentaje" type="text" placeholder="Porcentaje">

                <input id="btnGuardarAdmin" class="btn-crear" name="btnCrearDtf" type="submit" value="Guardar">

            </form>
        </div>
</main>

<script src="<?php echo base_url();?>/assets/js/nuevoDtfAdmin.js" defer></script>

<?php echo $this->endSection(); ?>
