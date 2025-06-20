<?php

namespace App\Models;

use CodeIgniter\Model;

class Certifications extends Model
{
    protected $table            = 'certifications';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'certTitle', 'certDate'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
}
