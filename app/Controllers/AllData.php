<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Helpers\DataAggregator;

class AllData extends BaseController
{
    public function index()
    {
        $result = DataAggregator::getAllData();

        return $this->response->setJSON($result);
    }
}
