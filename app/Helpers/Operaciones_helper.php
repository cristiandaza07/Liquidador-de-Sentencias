<?php

use CodeIgniter\CLI\Console;
use Kint\Zval\DateTimeValue;

use Dompdf\Dompdf;
use Dompdf\Option;
use Dompdf\Exception as DomException;
use Dompdf\Options;
use Config\Autoload;
use PhpParser\Node\Expr\FuncCall;

//------- HEADER --------//
/**
 * Se encarga de mostrar el respectivo header dependiendo del tipo de usuario
 *
 * @return string Retorna el nombre del header que se debe mostrar
 */
function mostrarHeader(){
    $header = "";
    if(session()->get('tipoUsuario') == 'Liquidador'){
        $header = "headerLiquidador";
    }else{
        $header = "headerAdmin";
    }
    
    return $header;
}


//------- FUNCIONES DE CALCULOS ------//

/**
 * Hace el calculo de cuantos dias de la primera semana hay que contar para el calculo del interes (Si hay más de una semana)
 *
 * @param [date] $fechaDesde
 * @return int 
 */
function calcularNumDiasPrimeraSemana($fechaDesde){
    $fechaLunesAnterior = obtenerLunesAnteior($fechaDesde);

    $fechaDesde = new DateTime($fechaDesde);
    $fechaLunesAnterior = new DateTime($fechaLunesAnterior);
    $diff = $fechaLunesAnterior -> diff($fechaDesde);
    $numDias = 7 - ($diff -> days);
    return $numDias;
}

/**
 * Hace el calculo de cuantos dias de la ultima semana hay que contar para el calculo del interes (Si hay más de una semana)
 *
 * @param [date] $usuarioFechaHasta
 * @param [date] $fechaHasta
 * @return int 
 */
function calcularNumDiasUltimaSemana($usuarioFechaHasta, $fechaHasta){
    $usuarioFechaHasta = new DateTime($usuarioFechaHasta);
    $fechaHasta = new DateTime($fechaHasta);

    $diff = $fechaHasta -> diff($usuarioFechaHasta);
    $numDias = 7 - ($diff -> days); 
    return $numDias;
}

/**
 * Hace el calculo de cuantos dias hay entre la fechaDesde y la fechaHasta (si las fechas están en una misma semana)
 *
 * @param [date] $usuarioFechaDesde
 * @param [date] $usuarioFechaHasta
 * @return int
 */
function calcularDiasUnicaSemana($usuarioFechaDesde, $usuarioFechaHasta){
    $usuarioFechaHasta = new DateTime($usuarioFechaHasta);
    $usuarioFechaDesde = new DateTime($usuarioFechaDesde);

    $diff = $usuarioFechaDesde -> diff($usuarioFechaHasta);
    $numDias = ($diff -> days);
    return $numDias +1;
}

/**
 * Funcion para hacer el calculo de cada interes de las filas que se muestran en la tabla de fechas
 *
 * @param [int] $valorInicial
 * @param [int] $dtfDia
 * @param [int] $numDias
 * @return int
 */
function calcularInteres($valorInicial, $dtfDia, $numDias){ 
    $interes = (intval($valorInicial) * $numDias) * $dtfDia;
    return $interes;
}

/**
 * Hace la suma de cuantos días hay en total
 *
 * @param [date] $fechaDesde
 * @param [date] $fechaHasta
 * @return date
 */
function sumarDias($fechaDesde, $fechaHasta) {
    $fechaInicio = new DateTime($fechaDesde);
    $fechaFin = new DateTime($fechaHasta);

    $totalDias = $fechaInicio -> diff($fechaFin);
    return $totalDias -> days +1;
}

/**
 * Hace el calculo de la columna 'DTF nominal' que se muestra en la tabla resultante de la liquidación DTF
 *
 * @param [double] $porcentajeInteres
 * @param [int] $periodosAnio
 * @return double
 */
function tasaNominal($porcentajeInteres, $periodosAnio) {
    //Conversión de porcentaje a decimal para hacer las operaciones
    $porcentajeInteres = $porcentajeInteres / 100;
    //Formula de tasa nominal
    $tasaNominalPorcentaje = pow((1 + ($porcentajeInteres / $periodosAnio)), $periodosAnio) - 1;
    //Conversión de deciaml a porcentaje para mostrarlo al usuario    
    $tasaNominalPorcentaje = ($tasaNominalPorcentaje) * 100;
    return $tasaNominalPorcentaje;
}

/**
 * Si la fechaHasta ingresada por el usuario en la liquidación DTF es una fecha futura entonces le agrega las semanas futuras a las que trae la consulta de la BD (las que trae la BD solo están hasta la fecha actual)  
 *
 * @param [date] $fechaHastaUsuario
 * @param [date] $ultimaFechaHastaQuery
 * @return array
 */
function calcularDtfFuturo($fechaHastaUsuario, $ultimaFechaHastaQuery){
    $fecha = $ultimaFechaHastaQuery;
    $proximosDtf = [];
    while ($fecha < $fechaHastaUsuario ) {
        $nuevoDtfProximo = [
            'porcentaje' => 0,
            'fechaDesde' => date('Y-m-d', strtotime($fecha . ' + ' . 1 . ' days')),
            'fechaHasta' => date('Y-m-d', strtotime($fecha . ' + ' . 7 . ' days'))
        ];
        
        $proximosDtf[] = $nuevoDtfProximo;
        $fecha = $nuevoDtfProximo['fechaHasta'];
    }

    return $proximosDtf;
}

//-------- FUNCIONES DE FECHAS ---------

/**
 * Indica el mes actual
 *
 * @param [date] $fecha
 * @return string
 */
function obtenerMes($fecha){
    $mes = date('m', strtotime($fecha));

    switch ($mes){
        case 1:
            return 'Enero';
            break;
        case 2:
            return 'Febrero';
            break;
        case 3:
            return 'Marzo';
            break;
        case 4:
            return 'Abril';
            break;
        case 5:
            return 'Mayo';
            break;
        case 6:
            return 'Junio';
            break;
        case 7:
            return 'Julio';
            break;
        case 8:
            return 'Agosto';
            break;
        case 9:
            return 'Septiembre';
            break;
        case 10:
            return 'Octubre';
            break;
        case 11:
            return 'Noviembre';
            break;
        case 12:
            return 'Diciembre';
            break;
        default:
            return 'Error';
    }

}

/**
 * Indica el año actual
 * 
 * @param [date] $fecha
 * @return date
 */
function obtenerAño($fecha){
    $año = date('Y', strtotime($fecha));

    return $año;
}

/**
 * Devuelve la fecha actual en formato AÑO-MES-DIA
 *
 * @return date
 */
function obtenerFechaActual(){
    //Obtener fecha de hoy
    $fechaActual = new DateTime();

    // Formatear la fecha como cadena de texto
    $fechaFormateada = $fechaActual->format('Y-m-d');
    //Console.log();
    return $fechaFormateada;
}

/**
 * Covierte la fecha de formato Mes-Dia-Año a formato Dia-Mes-Año
 *
 * @param [date] $fechaDesde
 * @param [date] $fechaHasta
 * @return array
 */
function formatearFechas($fechaDesde, $fechaHasta){
    $fechaDesde = new DateTime($fechaDesde);
    $fechaHasta = new DateTime($fechaHasta);

    $fechaDesdeFormateada = $fechaDesde->format('d-m-Y');
    $fechaHastaFormateada = $fechaHasta->format('d-m-Y');

    return ["fechaDesdeFormateada" => str_replace('-', '/', $fechaDesdeFormateada), "fechaHastaFormateada" => str_replace('-', '/', $fechaHastaFormateada)];
}

/**
 * retorna el dia de la semana de 0 a 6 (0 es domingo y lunes es 6)
 *
 * @param [date] $fecha
 * @return int
 */
function diaSemana ($fecha){
    $diaSemana = date('w', strtotime($fecha));
    return $diaSemana;
}

/**
 * Funcion que entrega el lunes que pasó (Si la fecha es diferente a lunes)
 *
 * @param [date] $fechaDesde
 * @return int
 */
function obtenerLunesAnteior($fechaDesde){
    $diaSemana = diaSemana($fechaDesde);

    $diferenciaDias = $diaSemana - 1;
    if ($diferenciaDias < 0) {
        $diferenciaDias += 7;
    }
    $fechaLunesAnterior = date('Y-m-d', strtotime($fechaDesde . ' - ' . $diferenciaDias . ' days'));
    return $fechaLunesAnterior;
}

//----- GENERAR PDF ----- //

/**
 * Genera el PDF por medio de la libreria DOMPDF
 *
 * @param [string] $tipoLiquidacion
 * @return void
 */
function crearPdf($tipoLiquidacion){
    try{
        //Condicional para elegir que datos mostrar en el PDF
        if($tipoLiquidacion == 'DTF'){
            $data = [
                'datosFechas' => $_POST['dtfs'],
                'datosGenerales' => $_POST['datosGenerales'],
                'nombreDemandante' => $_POST['nombreDemandante'],
                'numDocumento' => $_POST['numDocumento'],
                'valorFinal' => $_POST['valorFinal'],
                'titulo' => 'PDF'
            ];
        }else if($tipoLiquidacion == 'Indexada'){
            $data = [
                'valorInicial' => $_POST['valorInicial'],
                'fechaDesde' => $_POST['fechaDesde'],
                'fechaHasta' => $_POST['fechaHasta'],
                'nombreDemandante' => $_POST['nombreDemandante'],
                'numDocumento' => $_POST['numDocumento'],
                'ipcInicial' => $_POST['ipcInicial'],
                'ipcFinal' => $_POST['ipcFinal'],
                'ipcDivision' => $_POST['ipcDivision'],
                'valorTotal' => $_POST['valorTotal'],
                'titulo' => 'PDF'
            ];
        }

        //Guardamos la vista de la liquidación correspondiente
        $contenido = view('pdf/plantillaPdf'.$tipoLiquidacion, $data);

        //Asignamos nombre para el PDF
        $nombrePdf = "Liquidacion ".$tipoLiquidacion." ".$data['numDocumento'];

        // Opciones para prevenir errores con carga de imágenes
        $options = new Options();
        $options->set('isRemoteEnabled', true);
    
        // Instancia de la clase
        $dompdf = new Dompdf($options);
    
        // Cargar el contenido HTML
        $dompdf->loadHtml($contenido);
    
        // Formato y tamaño del PDF
        $dompdf->setPaper('A4', 'portrait');
    
        // Renderizar HTML como PDF
        $dompdf->render();

        // Parametros para generar pie de pagina con numero de la página
        $x          = 470;
        $y          = 800;
        $text       = "Página {PAGE_NUM} de {PAGE_COUNT}";     
        $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');   
        $size       = 10;    
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $dompdf->getCanvas()->page_text(
        $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );
    
        // Salida para descargar
        $dompdf->stream($nombrePdf, ['Attachment' => true]);

    }catch(Exception $e){
        echo $e->getMessage();
    }catch(DomException $e){
        echo $e->getMessage();

    }
}

?>