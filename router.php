<?php
    require_once 'libs/router.php';
    require_once 'config.php';
    require_once 'app/controllers/disco.api.controller.php';

    $router = new Router();

    $router->addRoute('discos', 'GET', 'DiscosApiController', 'getDiscos');
    $router->addRoute('discos/:ID', 'GET', 'DiscosApiController', 'getDisco');
    $router->addRoute('discos/:ID', 'DELETE', 'DiscosApiController', 'deleteDisco');
    $router->addRoute('discos', 'POST', 'DiscosApiController', 'createDisco');
    $router->addRoute('discos/:ID', 'PUT', 'DiscosApiController', 'update');
    $router->addRoute('discos-ofertas', 'GET', 'DiscosApiController','getOfertas');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);