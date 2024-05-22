<?php

namespace App\Models;

use CodeIgniter\Model;

class IpcModel extends Model{
    protected $table      = 'ipc';
    protected $primaryKey = 'id_ipc';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //o tambien Object
    protected $useSoftDeletes = true;

    protected $allowedFields = ['año', 'mes', 'indice'];

    protected bool $allowEmptyInserts = false;
}