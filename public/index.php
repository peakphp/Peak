<?php

/*
|--------------------------------------------------------------------------
| Application launcher
|--------------------------------------------------------------------------
*/
include './../vendor/autoload.php';

use Peak\Bedrock\Application;
use Peak\Di\Container;
use Peak\Common\ExceptionLogger;

// Look in __DIR__ for the first files found in this order: 
// .prod or .staging or .testing
// If no file found, [dev] will be used.
$env = detectEnvFile(__DIR__);

// create a container
$container = new Container;

try {
    // create the app
    $app = new Application($container, [
        'env'  => $env,
        'conf' => [
            CONFIG_PATH.'/app.php',
            CONFIG_PATH.'/app.'.$env.'.php',
            CONFIG_PATH.'/database.'.$env.'.php'
        ],
        'path' => [
            'public' => __DIR__,
            'app'    => __DIR__.'/../app',
        ]
    ]);

    // do all the process
    $app->run()->render();

} catch(\Exception $e) {

    // if kernel is present, try to render error controller.
    // otherwise, if environment is "dev" we throw exception message
    if ($container->hasAlias('AppKernel')) {
        try {
            $kernel = Application::kernel();
            $kernel->front->errorDispatch($e);
            $kernel->render();
        } catch(\Exception $ee) {
            if (isDev()) {
                printHtmlExceptionTrace($e);
            }
        }
    } elseif (isDev()) {
        printHtmlExceptionTrace($e);
    }

    // log exception
    new ExceptionLogger($e, LOG_PATH.'/errors.log');
}