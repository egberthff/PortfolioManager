<?php

namespace App\Models;

use CodeIgniter\Model;

class Contact extends Model
{
    protected $table            = 'contacts';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id','contactName', 'contactPhone', 'contactEmail', 'contactLinkedIn', 'contactGitHub', 'contactTwitter'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
 
}
