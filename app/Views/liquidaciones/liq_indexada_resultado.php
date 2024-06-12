<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>

    <?php echo validation_list_errors(); ?>
    <?php echo helper('Operaciones_helper'); ?>
    <?php $fechasFormateadas= formatearFechas($fechaDesde, $fechaHasta); ?>

        <div id="contenido" class="contenido">
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
                            <input name="nombreDemandante" id="nombreDemandante" type="text" placeholder="Nombre Completo" value="<?php echo $nombreDemandante;?>">
                            <input name="numDocumento" id="numDocumento" type="number" placeholder="Numero de Documento" value="<?php echo $numDocumento;?>">                            
                        </div>  
                        <hr>
                    </div>
                
                    <div class="formularioDtf__datos-liquidacion">
                        <label id="labelValorInicial" for="valorInicial">Valor Inicial</label>
                        <label id="labelFechaDesde" for="fechaDesde">Fecha Desde</label>
                        <label id="labelFechaHasta" for="fechaHasta">Fecha Hasta</label>
                        <input name="valorInicial" id="valorInicial" type="text" placeholder="$0" min="0" value="<?php echo $valorInicialFormateado;?>">
                        <input  name="fechaDesde" id="fechaDesde" type="date" min="1984-01-16" max="<?php echo obtenerFechaActual();?>" value="<?php echo $fechaDesde;?>">
                        <input  name="fechaHasta" id="fechaHasta" type="date" min="1984-01-16" max="<?php echo obtenerFechaActual();?>"  value="<?php echo $fechaHasta;?>">  
                    </div>
                    <input class="btn__calcular" type="submit" value="Calcular">
                </form>

                <div id="contenedorTablas" class="contenedor__tablas bordes margin-bottom" name="tablasContenido">
                    <div class="contenedor__tabla-totales">
                        <table id="tablaTotales" class="tabla-totales ">
                            <thead>
                                <th>Valor</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Indice Inicial (i.i)</th>
                                <th>Indice Final (i.f)</th>
                                <th>i.f/i.i</th>
                                <th>Valor Total</th>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>$<?php echo $valorInicial; ?></td>
                                        <td><?php echo $fechasFormateadas['fechaDesdeFormateada']; ?></td>
                                        <td><?php echo $fechasFormateadas['fechaHastaFormateada']; ?></td>
                                        <td><?php echo $ipcInicial; ?></td>
                                        <td><?php echo $ipcFinal; ?></td>
                                        <td><?php echo number_format($ipcDivision, 4); ?></td>
                                        <td>$<?php echo number_format($valorTotal, 0); ?></td>
                                    </tr>         
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="1" class="contenedor__btn-descargar-tablas">                    
                    <form id="formularioGuardar" action="<?php echo base_url('/liquidaciones/indexada/resultado/guardar') ?>" method="post">
                        <input type="hidden" name="valorInicial" value="<?php echo $valorInicial;?>">
                        <input type="hidden" name="fechaDesde" value="<?php echo $fechasFormateadas['fechaDesdeFormateada'];?>">
                        <input type="hidden" name="fechaHasta" value="<?php echo $fechasFormateadas['fechaHastaFormateada'];?>">
                        <input type="hidden" name="nombreDemandante" value="<?php echo $nombreDemandante;?>">
                        <input type="hidden" name="numDocumento" value="<?php echo $numDocumento;?>">
                        <input type="hidden" name="ipcInicial" value="<?php echo $ipcInicial;?>">
                        <input type="hidden" name="ipcFinal" value="<?php echo $ipcFinal;?>">
                        <input type="hidden" name="ipcDivision" value="<?php echo number_format($ipcDivision, 4);?>">
                        <input type="hidden" name="valorTotal" value="<?php echo number_format($valorTotal, 0);?>">
                        <input id="btnGuardar" type="submit" class="btn-descargar pdf" value="GUARDAR Y GENERAR PDF">
                    </form>      
                </div>              
        </div>

 </main>

<script src="<?php echo base_url();?>/assets/js/validacionesLiquidacionIndexada.js"></script>
<script src="<?php echo base_url();?>/assets/js/validacionesGuardarLiquidacion.js"></script>

<?php echo $this->endSection(); ?>
