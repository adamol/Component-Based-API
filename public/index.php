<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = \App\Framework\DependencyInjection\Container::getInstance();

$request = Request::createFromGlobals();
$response = $app['kernel']->handle($request);

$response->send();

