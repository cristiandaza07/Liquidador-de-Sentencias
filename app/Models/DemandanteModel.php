<?php

namespace App\Models;

use CodeIgniter\Model;

class DemandanteModel extends Model{
    protected $table      = 'demandantes';
    protected $primaryKey = 'id_demandante';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //o tambien Object
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre', 'num_documento'];

    protected bool $allowEmptyInserts = false;

}