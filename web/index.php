<?php

use Gephart\Framework\Kernel;
use Gephart\Http\RequestFactory;

include_once __DIR__ . "/../vendor/autoload.php";

$request = (new RequestFactory())->createFromGlobals();

$kernel = new Kernel($request);

$kernel->registerServices([
    \Admin\EventListener\MenuListener::class,
    \Admin\EventListener\UserListener::class
]);

$response = $kernel->run();

echo $kernel->render($response);