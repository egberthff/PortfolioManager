<?php

namespace App\Models;

use CodeIgniter\Model;

class Education extends Model
{
    protected $table            = 'education';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id','eduDegree', 'eduStartDate', 'eduEndDate', 'eduSchool'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
