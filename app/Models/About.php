<?php

namespace App\Models;

use CodeIgniter\Model;

class About extends Model
{
    protected $table            = 'abouts';
    protected $primaryKey       = 'id';
  protected $allowedFields = ['aboutText'];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
   

}
