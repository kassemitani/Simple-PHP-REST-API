<?php

require 'vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true
    ]
];


$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$container = $app->getContainer();
$container['pdo'] = function ($c) {
    $dsn = 'mysql:host=localhost;dbname=dbName;charset=utf8'; // replace Localhost with your mysql host ip and replace dbName with your database name
    $usr = 'dbUSERNAME'; //replace dbUSERNAME with your database username
    $pwd = 'dbPASSWORD'; //replace dbUSERNAME with your database password
    $pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);
    return $pdo;
};

//$app = new Slim\App();

$routeFiles = (array) glob('routes/*.php');
foreach($routeFiles as $routeFile) {
    require_once $routeFile;
}

$app->run();

?>
