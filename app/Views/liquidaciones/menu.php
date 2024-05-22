<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>
        <div class="menu">
            <div class="contenedor__menu-informacion">
                <h1 class="menu__titulo"> TIPOS DE LIQUIDACIÓN</h1>
                <h3>
                    Ingrese al modulo que desees para calcular la liquidación.
                </h3>
                <hr>
            </div>  
            <div class="contenedor__menu-botones">
                <a class="btn-dtf" href="<?php echo base_url('/liquidaciones/dtf') ?>">DTF</a>
                <a class="btn-indexada" href="<?php echo base_url('/liquidaciones/indexada') ?>">INDEXACIÓN</a>
                
            </div>
        </div>

    </main>

<?php echo $this->endSection(); ?>
