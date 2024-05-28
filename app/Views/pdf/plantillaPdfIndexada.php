<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <style>
        :root{
            --negro: #1D1D1B;
            --amarillo: #E08709;
            --verde: #009640;
            --verdeSuave: #C5EBAA;
            --verdeIntermedio: #A5DD9B;
            --verdeHover: #96ce8c;
            --blanco: #FFFFFF;
            --gris: #e1e1e1c4;
            --grisHover: #c4c3c3c4;
            --grisOscuro: #333333;

            --separacion: 5rem;

            --fuentePrincipal: 'Rubik', normal;
        }

        .encabezado{
            display: block; width: 100%;
            background-color: #e1e1e1c4;
            border-radius: 5px;
        }

        h1{
            font-family: 'Rubik', normal; font-weight: 400; text-align: center; font-size: 18px; text-decoration: underline;
        }

        

        p{
            font-family: 'Rubik', normal;
        }

        .encabezado__fecha{
            font-family: 'Rubik', normal; font-weight: 400; text-align: center; text-decoration: none; font-size: 12px; margin-top: -1px; margin-bottom: 10px; color: #333333;
        }

        img{
           width: 10rem;
           margin: 10px 270px 0 270px;
        }

        .tabla{
            text-align: center; font-family: 'Rubik', normal; font-size: 13px; width: 100%;
        }

        .tabla th{
            background-color: #e1e1e1c4;
        }
    </style>
  </head>
  <body>


    <div class="encabezado">
        <img src="<?php echo base_url();?>/assets/img/logo.png" alt="logo"> 
        <h1 class="encabezado__fecha"><?php echo date('d-m-Y'); ?></h1> 
    </div>

    <div>
        <h1>DATOS DE LA LIQUIDACIÓN</h1>

        <p>En el presente documento se informa que el demandante <?php echo $nombreDemandante;?> con CC. <?php echo $numDocumento;?> se le debe depositar un valor de $<?php echo $valorTotal;?> COP</p>
    </div>
                    <div id="contenedorTablaFechas">
                        <table id="tablaTotales" class="tabla">
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
                                    <td><?php echo $fechaDesde ?></td>
                                    <td><?php echo $fechaHasta ?></td>
                                    <td><?php echo $ipcInicial; ?></td>
                                    <td><?php echo $ipcFinal; ?></td>
                                    <td><?php echo $ipcDivision; ?></td>
                                    <td>$<?php echo $valorTotal; ?></td>
                                </tr>         
                            </tbody>
                        </table>
                    </div>

    </body>
</html>


