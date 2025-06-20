<?php

namespace App\Models;

use CodeIgniter\Model;

class Experience extends Model
{
    protected $table            = 'experiences';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id','expJobTitle', 'expCompany', 'expLocation', 'expStartDate', 'expEndDate', 'expDescription'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $dateFormat    = 'datetime';
}
