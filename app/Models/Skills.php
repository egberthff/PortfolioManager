<?php

namespace App\Models;

use CodeIgniter\Model;

class Skills extends Model
{
    protected $table            = 'skills';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','skillName'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
