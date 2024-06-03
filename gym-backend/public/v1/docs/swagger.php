<?php

require __DIR__ . '/../../../vendor/autoload.php';

if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1'){
    define('BASE_URL', 'http://localhost/Kerim123/gym-backend/');
} else {
    define('BASE_URL', 'https://stingray-app-bhock.ondigitalocean.app/gym-backend/');
}

//define('BASE_URL', 'http://localhost/Kerim123/gym-backend/');

error_reporting(0);

$openapi = \OpenApi\Generator::scan(['../../../rest/routes', './']);
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
?>


