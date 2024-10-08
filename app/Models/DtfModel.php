<?php

namespace App\Models;

use CodeIgniter\Model;

class DtfModel extends Model{
    protected $table      = 'dtf';
    protected $primaryKey = 'idDtf';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //o tambien Object
    protected $useSoftDeletes = true;

    protected $allowedFields = ['fechaDesde', 'fechaHasta', 'porcentaje'];

    protected bool $allowEmptyInserts = false;
}