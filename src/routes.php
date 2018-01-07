<?php

use Symfony\Component\Routing;

$app = App\Framework\DependencyInjection\Container::getInstance();

$routes = new Routing\RouteCollection();

$routes->add('concerts.show', new Routing\Route('/concerts/{id}', [
    'concertRepository' => $app['repositories.concert'],
    '_controller' => 'App\Controllers\ConcertsController::show',
]));

return $routes;