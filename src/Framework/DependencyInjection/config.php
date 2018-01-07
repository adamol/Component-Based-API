<?php

use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;

$app = new \Pimple\Container();

$app['routes']  = function($c) {
    return require __DIR__.'/../../routes.php';
};

$app['context'] = function($c) {
    return new Routing\RequestContext();
};
$app['matcher'] = function($c) {
    return new Routing\Matcher\UrlMatcher($c['routes'], $c['context']);
};

$app['controller_resolver'] = function($c) {
    return new HttpKernel\Controller\ControllerResolver();
};
$app['argument_resolver'] = function($c) {
    return new HttpKernel\Controller\ArgumentResolver();
};
$app['kernel'] = function($c) {
    return new App\Framework\Framework(
        $c['matcher'],
        $c['controller_resolver'],
        $c['argument_resolver']
    );
};

$app['db'] = function($c) {
    return new PDO(getenv('DB_DSN'), getenv('DB_USER'), getenv('DB_PASS'));
};

$app['repositories.concert'] = function($c) {
    return new App\Repositories\ConcertRepository($c['db']);
};

return $app;
