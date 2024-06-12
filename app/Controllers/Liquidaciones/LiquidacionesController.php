<?php

namespace App\Controllers\Liquidaciones;
//include('scripts.js');

use App\Models\ProductosModel;
use App\Controllers\BaseController;
use App\Models\DemandanteModel;
use App\Models\LiquidacionModel;
use CodeIgniter\CLI\Console;
use DomainException;
use PhpParser\Node\Expr\FuncCall;

class LiquidacionesController extends BaseController{
    
    protected $helpers = ['form'];

    //Muestra el menu de las liquidaciones
    public function menuLiquidador(){   
        helper('Operaciones_helper');     
        $data = [
            'titulo' => 'Menú',
            'header' => mostrarHeader()
        ];
        return view('liquidaciones/menu', $data);

    }

    //Muestra el modulo de liquidacion DTF
    public function liquidacionDtf(){
        helper('Operaciones_helper');

        $data = [
            'titulo' => 'LIQUIDACIÓN DTF',
            'header' => mostrarHeader()
        ];
        return view('liquidaciones/liq_dtf', $data);
    }

    //Muestra el modulo de liquidacion indexada
    public function liquidacionIndexada(){
        helper('Operaciones_helper');

        $data = [
            'titulo' => 'LIQUIDACIÓN INDEXADA',
            'header' => mostrarHeader()
        ];
        return view('liquidaciones/liq_indexada', $data);
    }

    /**
     * Muestra el resultado del calculo de la liquidación de tipo indexada
     *
     * @return void 
     */
    public function resultadoIndexada(){
        //Conexion a la base de datos
        $db = \Config\Database::connect();

        helper('Operaciones_helper');

        //Se guarda las fechas ingresadas por el usuario
        $valorInicial = preg_replace('/[^0-9]/', '', $_POST['valorInicial']);
        $valorInicialFormateado = $_POST['valorInicial'];
        $fechaHasta = $_POST['fechaHasta'];
        $fechaDesde = $_POST['fechaDesde'];

        //Query para traer el IPC inicial
        $selectQuery = "SELECT * FROM ipc WHERE año = '".obtenerAño($fechaDesde). "' AND mes = '".obtenerMes($fechaDesde)."'";
        $query = $db->query($selectQuery);
        $ipcInicial = $query->getResultArray();

        //Query para traer el IPC final        
        $selectQuery = "SELECT * FROM ipc WHERE año = '".obtenerAño($fechaHasta). "' AND mes = '".obtenerMes($fechaHasta)."'";
        $query = $db->query($selectQuery);
        $ipcFinal = $query->getResultArray();

        $ipcDivision = $ipcFinal[0]['indice'] / $ipcInicial[0]['indice'];
        $valorTotal = intval($valorInicial) * $ipcDivision; 


        //Pasamos los datos a un arreglo que se le va entregar a la vista para ser mostrar los resultados de la consulta
        $data = [
            'titulo' => 'LIQUIDACIÓN INDEXADA',
            'header' => mostrarHeader(),
            'fechaDesde' => $_POST['fechaDesde'],
            'fechaHasta' => $_POST['fechaHasta'],
            'valorInicial' => preg_replace('/[^0-9]/', '', $_POST['valorInicial']),
            'valorInicialFormateado' => $valorInicialFormateado,
            'nombreDemandante' => $_POST['nombreDemandante'],
            'numDocumento' => $_POST['numDocumento'],
            'ipcInicial' => $ipcInicial[0]['indice'],
            'ipcFinal' => $ipcFinal[0]['indice'],
            'ipcDivision' => $ipcDivision,
            'valorTotal' => $valorTotal,
        ];
        return view('liquidaciones/liq_indexada_resultado', $data);
    }

    /**
     * Muestra el resultado del calculo de la liquidación de tipo DTF
     *
     * @return void
     */
    public function resultadoDtf(){
        //Conexion a la base de datos
        $db = \Config\Database::connect();

        helper('Operaciones_helper');

        //Se guarda las fechas ingresadas por el usuario
        $valorInicial = preg_replace('/[^0-9]/', '', $_POST['valorInicial']);
        $valorInicialFormateado = $_POST['valorInicial'];
        $fechaHasta = $_POST['fechaHasta'];
        $fechaDesde = $_POST['fechaDesde'];

        if(diaSemana($fechaDesde) != 1){
           $fechaDesde = obtenerLunesAnteior($fechaDesde);
        }

        //Query para mostrar los valores desde 'fechaDesde' hasta 'fechaHasta'
        $selectQuery = "SELECT * FROM dtf WHERE fechaDesde BETWEEN '$fechaDesde' AND '$fechaHasta' ORDER BY fechaDesde ASC";
        $query = $db->query($selectQuery);
        $dtfs = $query->getResultArray();

        //Si hay que calcular el porcentaje de interes para una fecha futura se realiza lo siguiente
        $ultimoDtf = end($dtfs)['porcentaje'];
        if($fechaHasta > end($dtfs)['fechaHasta']){
            $dtfs = array_merge_recursive($dtfs, calcularDtfFuturo($fechaHasta,end($dtfs)['fechaHasta']));
        }

        $interesTotal=0;
        foreach($dtfs as $dtf => &$valorDtf):
            //Si el porcentaje de DTF es 0 (debido a que es una fecha que no ha pasado) entonces le asignamos el porcentaje del registro más reciente de DTF.
            if($valorDtf['porcentaje'] === 0){
                $valorDtf['porcentaje'] = $ultimoDtf;
            }

            //Calculamos el numero de dias de cada semana
            if(count($dtfs) == 1){
                $valorDtf['numDias'] = calcularDiasUnicaSemana($_POST['fechaDesde'], $_POST['fechaHasta']);
            }else{
                if($dtf === 0){
                    $valorDtf['numDias'] = calcularNumDiasPrimeraSemana($_POST['fechaDesde']);;
                }else if($valorDtf === end($dtfs)){
                    $valorDtf['numDias'] = calcularNumDiasUltimaSemana($_POST['fechaHasta'], $valorDtf['fechaHasta']);
                }else{
                    $valorDtf['numDias'] = 7; 
                } 
            }

            //Guardo el arreglo con el nuevo formato de las fechas (Dia-Mes-Año) en  una variable
            $fechasFormateadas= formatearFechas($valorDtf['fechaDesde'], $valorDtf['fechaHasta']);

            //Guardo las fechas formateadas en el arreglo que se le va entregar a la vista
            $valorDtf['fechaDesde'] = $fechasFormateadas['fechaDesdeFormateada'];
            $valorDtf['fechaHasta'] = $fechasFormateadas['fechaHastaFormateada'];

            //Hago las operaciones para calcular el interes total
            $interesTotal += ((calcularInteres($valorInicial, number_format((tasaNominal($valorDtf['porcentaje'],360))/360, 4), 7))/100);
        endforeach;

        //Pasamos los datos a un arreglo que se le va entregar a la vista para ser mostrar los resultados de la consulta
        $data = [
            'titulo' => 'Liquidacion DTF',
            'header' => mostrarHeader(),
            'dtfs' => $dtfs,
            'fechaDesde' => $_POST['fechaDesde'],
            'fechaHasta' => $_POST['fechaHasta'],
            'valorInicial' => preg_replace('/[^0-9]/', '', $_POST['valorInicial']),
            'valorInicialFormateado' => $valorInicialFormateado,
            'nombreDemandante' => $_POST['nombreDemandante'],
            'numDocumento' => $_POST['numDocumento'],
            'interesTotal' => $interesTotal
        ];
        return view('liquidaciones/liq_dtf_resultado', $data);
    }

    /**
     * Guarda la liquidación en la base de datos y ejecuta la función de exportar PDF
     *
     * @return void
     */
    public function guardarLiquidacionDtf(){
        //Conexion a la base de datos
        $db = \Config\Database::connect();

        helper('Operaciones_helper');

        //Se guarda las fechas ingresadas por el usuario
        $valorFinal = $_POST['valorFinal'];
        $fechaHasta = $_POST['fechaHasta'];
        $fechaDesde = $_POST['fechaDesde'];

        $nombreDemandante = $_POST['nombreDemandante'];
        $numDocumento = $_POST['numDocumento'];

        $dtfs = $_POST['dtfs'];
        $datosGenerales = $_POST['datosGenerales'];

        $idDemandante = "";
        $query = $db->query("SELECT * FROM demandantes WHERE num_documento = $numDocumento");
        $demandante = $query->getResultArray();
        if(count($demandante) == 0){
           //Guardar registro del demandante
            $dataDemandante = [
                'nombre' => $nombreDemandante,
                'num_documento' => $numDocumento,
            ];
            $demandante = new DemandanteModel();
            $demandante->insert($dataDemandante); 
            $idDemandante = $demandante->getInsertID();
        }else{
            $idDemandante = $demandante[0]['id_demandante'];
        }

        //Guardar registro de la liquidación
        $selectQuery = "SELECT * FROM dtf WHERE fechaDesde BETWEEN '$fechaDesde' AND '$fechaHasta' ORDER BY fechaDesde ASC";
        $dataLiquidacion = [
            'tipo_liquidacion' => 'dtf',
            'query' => $selectQuery,
            'id_usuario' => intval(session()->get('idUsuario')),
            'id_demandante' => $idDemandante
        ];
        $liquidacion = new LiquidacionModel();
        $liquidacion->insert($dataLiquidacion);

        //Generamos el PDF de tipo DTF
        crearPdf('DTF');
    }

    /**
     * Guarda los datos de la liquidación de tipo indexada y del demandante
     *
     * @return void
     */
    public function guardarLiquidacionIndexada(){
        //Conexion a la base de datos
        $db = \Config\Database::connect();

        helper('Operaciones_helper');

        //Se guarda las fechas ingresadas por el usuario
        $fechaHasta = $_POST['fechaHasta'];
        $fechaDesde = $_POST['fechaDesde'];

        $nombreDemandante = $_POST['nombreDemandante'];
        $numDocumento = $_POST['numDocumento'];

        $idDemandante = "";
        $query = $db->query("SELECT * FROM demandantes WHERE num_documento = $numDocumento");
        $demandante = $query->getResultArray();
        if(count($demandante) == 0){
           //Guardar registro del demandante
            $dataDemandante = [
                'nombre' => $nombreDemandante,
                'num_documento' => $numDocumento,
            ];
            $demandante = new DemandanteModel();
            $demandante->insert($dataDemandante); 
            $idDemandante = $demandante->getInsertID();
        }else{
            $idDemandante = $demandante[0]['id_demandante'];
        }

        //Guardar registro de la liquidación
        $selectQuery = "SELECT * FROM dtf WHERE fechaDesde BETWEEN '$fechaDesde' AND '$fechaHasta' ORDER BY fechaDesde ASC";
        $dataLiquidacion = [
            'tipo_liquidacion' => 'indexación',
            'query' => $selectQuery,
            'id_usuario' => intval(session()->get('idUsuario')),
            'id_demandante' => $idDemandante
        ];
        $liquidacion = new LiquidacionModel();
        $liquidacion->insert($dataLiquidacion);

        //Generamos el PDF de tipo DTF
        crearPdf('Indexada');
    }

}
