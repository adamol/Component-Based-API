<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = require __DIR__.'/../src/Framework/bootstrap.php';

$request = Request::createFromGlobals();
$response = $app['kernel']->handle($request);

$response->send();

