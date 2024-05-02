<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class CORS extends BaseConfig
{
    public $allowedOrigins = ['http://localhost:8080']; // Sesuaikan dengan URL lokal Anda
    public $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE'];
    public $allowedHeaders = [];
    public $exposedHeaders = [];
    public $maxAge = 0;
    public $originWildcard = false;
    public $cookies = false;
    public $addAllowedOrigin = true;
    public $allowCredentials = false;
    public $maxAgeAge = 300;
}
