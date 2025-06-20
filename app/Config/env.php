<?php

namespace Config;
use CodeIgniter\Config\BaseConfig;
use Dotenv\Dotenv;

class Env
{
    public function load()
    {
        $dotenv = Dotenv::createImmutable(APPPATH . 'Config');
        $dotenv->load();
        return $_ENV;
    }
}