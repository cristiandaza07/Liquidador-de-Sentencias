<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>
    <?php echo helper('Operaciones_helper'); ?>

    <?php echo validation_list_errors(); ?>

        <div class="contenido">
            <h1 class="titulo"><?php echo $titulo; ?></h1>
            
            <h3>
                Ingrese las fechas que fueron expedidas en la orden del juez para que el sistema realice el cálculo del 
                total que se debe pagar.
            </h3>
            <hr>
            <form id="formularioIndexada" class="formulario__liq-dtf" action="<?php echo base_url('/liquidaciones/indexada/resultado') ?>" method="post">
                    <div class="formularioDtf__datos-demandante">
                        <h2>DATOS DEL DEMANDANTE</h2>
                        <div class="formularioDtf__datos-demandante__grid">
                            <input class="input" name="nombreDemandante" id="nombreDemandante" type="text" placeholder="Nombre Completo">
                            <input class="input" name="numDocumento" id="numDocumento" type="number" placeholder="Numero de Documento">                            
                        </div>  
                        <hr>
                    </div>
                
                    <div class="formularioDtf__datos-liquidacion">
                        <label class="input" id="labelValorInicial" for="valorInicial">Valor Inicial</label>
                        <label class="input" id="labelFechaDesde" for="fechaDesde">Fecha Desde</label>
                        <label class="input" id="labelFechaHasta" for="fechaHasta">Fecha Hasta</label>
                        <input class="input" name="valorInicial" id="valorInicial" type="text" placeholder="$0" min="0">
                        <input class="input" name="fechaDesde" id="fechaDesde" type="date" min="1984-01-16" max="<?php echo obtenerFechaActual();?>">
                        <input class="input" name="fechaHasta" id="fechaHasta" type="date" min="1984-01-16">  
                    </div>
                    <input class="btn__calcular" type="submit" value="Calcular">
            </form>

        </div>
</main>

<script src="<?php echo base_url();?>/assets/js/validacionesLiquidacionIndexada.js"></script>

<?php echo $this->endSection(); ?>