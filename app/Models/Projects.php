<?php

namespace App\Models;

use CodeIgniter\Model;

class Projects extends Model
{
    protected $table            = 'projects';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'projectTitle', 'projectDescription', 'repo_url', 'demo_url'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

}
