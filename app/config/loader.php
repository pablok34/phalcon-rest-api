<?php

$loader = new \Phalcon\Loader();

$namespaces = [
    'PhoneBookAPI\Controllers' => $config->application->controllersDir,
    'PhoneBookAPI\Models' => $config->application->modelsDir,
    'PhoneBookAPI\Validators' => $config->application->validatorsDir,
];

$loader->registerNamespaces($namespaces)->register();

/*
$di->set('dispatcher', function () {
    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $dispatcher->setDefaultNamespace('PhoneBookAPI\Controllers');
    return $dispatcher;
});
 */
$di->set('dispatcher', function () {
    $eventsManager = new \Phalcon\Events\Manager();
    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $dispatcher->setDefaultNamespace('PhoneBookAPI\Controllers');

    $eventsManager->attach(
        'dispatch:beforeException',
        function ($event, $dispatcher, $exception) {
            //Handle 404 exceptions
            if ($exception instanceof \Phalcon\Mvc\Dispatcher\Exception) {
                $dispatcher->forward(array(
                    'controller' => 'index',
                    'action' => 'route404'
                ));
                return false;
            }
            //Handle other exceptions
            $dispatcher->forward(array(
                'controller' => 'index',
                'action' => 'route500'
            ));

            return false;
        }
    );
   // $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
});



/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->validatorsDir,
        $config->application->libraryDir
    ]
)->register();

//Load external Libraries
require $config->application->libraryDir . 'autoload.php';
