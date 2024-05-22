<?php

namespace App\Models;

use CodeIgniter\Model;

class LiquidacionModel extends Model{
    protected $table      = 'liquidaciones';
    protected $primaryKey = 'id_liquidacion';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //o tambien Object
    protected $useSoftDeletes = true;

    protected $allowedFields = ['tipo_liquidacion', 'query', 'id_usuario', 'fecha_liquidacion', 'id_demandante'];

    protected bool $allowEmptyInserts = false;

}