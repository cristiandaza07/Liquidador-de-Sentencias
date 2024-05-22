<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>

    <?php echo validation_list_errors(); ?>
    <?php echo helper('Operaciones_helper'); ?>
    

        <div id="contenido" class="contenido">
            <h1 class="titulo"><?php echo $titulo; ?></h1>

            <h3>
                    Ingrese las fechas que fueron expedidas en la orden del juez para que el sistema realice el cálculo del 
                    total que se debe pagar.
            </h3>
            <hr>
                <form id="formularioDtf" class="formulario__liq-dtf" action="<?php echo base_url('/liquidaciones/dtf/resultado') ?>" method="post">
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
                        <input  name="fechaHasta" id="fechaHasta" type="date" min="1984-01-16" value="<?php echo $fechaHasta;?>">  
                    </div>
                    <input class="btn__calcular" type="submit" value="Calcular">
                </form>

                <div id="contenedorTablas" class="contenedor__tablas" name="tablasContenido">
                    <div class="contenedor__tabla-totales">
                        <table id="tablaTotales" class="tabla-totales">
                            <thead>
                                <th>Total Días</th>
                                <th>Valor Inicial [k]</th>
                                <th>Total Intereses [i]</th>
                                <th>Valor Total [k + i]</th>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td><?php echo sumarDias($fechaDesde, $fechaHasta);?></td>
                                        <td>$<?php echo number_format($valorInicial, 0);?></td>
                                        <td>$<?php echo number_format($interesTotal,0);?></td>
                                        <td>$<?php echo number_format($valorInicial+$interesTotal,0);?></td>
                                    </tr>         
                            </tbody>
                        </table>
                    </div>

                    <div id="contenedorTablaFechas" class="contenedor__tabla-fechas">
                        <table id="tablaFechas" class="tabla-fechas">
                            <thead>
                                <th>Fecha Desde</th>
                                <th>Fecha Hasta</th>
                                <th>No. Días</th>
                                <th>DTF</th>
                                <th>DTF Nominal</th>
                                <th>DTF Día</th>
                                <th>Interes [i]</th>
                            </thead>
                            <tbody>
                                <?php foreach($dtfs as $dtf): ?>
                                    <tr>
                                        <td><?php echo $dtf['fechaDesde']; ?></td>
                                        <td><?php echo $dtf['fechaHasta']; ?></td>
                                        <td><?php echo $dtf['numDias']; ?></td>
                                        <td><?php echo $dtf['porcentaje']; ?>%</td>
                                        <td><?php echo tasaNominal($dtf['porcentaje'],360); ?>%</td>
                                        <td><?php echo number_format((tasaNominal($dtf['porcentaje'],360))/360, 4); ?>%</td>
                                        <td>$<?php echo  number_format((calcularInteres($valorInicial, number_format((tasaNominal($dtf['porcentaje'],360))/360, 4), $dtf['numDias']))/100,0); ?></td>
                                    </tr>           
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> 
                </div>

                <div id="1" class="contenedor__btn-descargar-tablas">                    
                    <form id="formularioGuardar" action="<?php echo base_url('/liquidaciones/dtf/resultado/guardar') ?>" method="post">
                        <input type="hidden" name="datosGenerales" value="
                            <tr>
                                <td style='border: 2px solid #e1e1e1c4;'><?php echo sumarDias($fechaDesde, $fechaHasta);?></td>
                                <td style='border: 2px solid #e1e1e1c4;'>$<?php echo number_format($valorInicial, 0);?></td>
                                <td style='border: 2px solid #e1e1e1c4;'>$<?php echo number_format($interesTotal,0);?></td>
                                <td style='border: 2px solid #e1e1e1c4;'>$<?php echo number_format($valorInicial+$interesTotal,0);?></td>
                            </tr>
                        ">    
                        <input type="hidden" name="dtfs" value="
                                <?php foreach($dtfs as $dtf): ?>
                                    <tr>
                                        <td style='border: 2px solid #e1e1e1c4;'><?php echo $dtf['fechaDesde']; ?></td>
                                        <td style='border: 2px solid #e1e1e1c4;'><?php echo $dtf['fechaHasta']; ?></td>
                                        <td style='border: 2px solid #e1e1e1c4;'><?php echo $dtf['numDias']; ?></td>
                                        <td style='border: 2px solid #e1e1e1c4;'><?php echo $dtf['porcentaje']; ?>%</td>
                                        <td style='border: 2px solid #e1e1e1c4;'><?php echo tasaNominal($dtf['porcentaje'],360); ?>%</td>
                                        <td style='border: 2px solid #e1e1e1c4;'><?php echo number_format((tasaNominal($dtf['porcentaje'],360))/360, 4); ?>%</td>
                                        <td style='border: 2px solid #e1e1e1c4;'>$<?php echo  number_format((calcularInteres($valorInicial, number_format((tasaNominal($dtf['porcentaje'],360))/360, 4), $dtf['numDias']))/100,0); ?></td>
                                    </tr>           
                                <?php endforeach; ?>
                        ">
                        <input type="hidden" name="valorFinal" value="<?php echo number_format($valorInicial+$interesTotal,0);?>">
                        <input type="hidden" name="fechaDesde" value="<?php echo $fechaDesde;?>">
                        <input type="hidden" name="fechaHasta" value="<?php echo $fechaHasta;?>">
                        <input type="hidden" name="nombreDemandante" value="<?php echo $nombreDemandante;?>">
                        <input type="hidden" name="numDocumento" value="<?php echo $numDocumento;?>">
                        <input id="btnGuardar" type="submit" class="btn-descargar pdf" value="GUARDAR Y GENERAR PDF">
                    </form>      
                </div>  
        </div>

</main>

<script src="<?php echo base_url();?>/assets/js/validacionesLiquidacionDtf.js"></script>
<script src="<?php echo base_url();?>/assets/js/validacionesGuardarLiquidacion.js"></script>

<?php echo $this->endSection(); ?>
