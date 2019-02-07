<?php

$router = $di->getRouter();



$router->addGet('/api/{controller}', [
    'namespace' => 'PhoneBookAPI\Controllers',
    'controller' => 'controller',
    'action' => 'find'
]);

$router->addGet('/api/{controller}/{id}', [
    'namespace' => 'PhoneBookAPI\Controllers',
    'controller' => 'controller',
    'action' => 'findOne'
]);

$router->addPost('/api/{controller}', [
    'namespace' => 'PhoneBookAPI\Controllers',
    'controller' => 'controller',
    'action' => 'create'
]);


$router->addPut('/api/{controller}/{id}', [
    'namespace' => 'PhoneBookAPI\Controllers',
    'controller' => 'controller',
    'action' => 'update'
]);

$router->addDelete('/api/{controller}/{id}', [
    'namespace' => 'PhoneBookAPI\Controllers',
    'controller' => 'controller',
    'action' => 'delete'
]);

$router->handle();
