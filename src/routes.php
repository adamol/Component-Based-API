<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('concerts.show', new Routing\Route('/concerts/{id}', [
    'concertRepository' => $app['repositories.concert'],
    '_controller' => 'App\Controllers\ConcertsController::show',
]));

return $routes;