<?php
use Cake\Routing\Router;

Router::plugin(
    'Carenta',
    ['path' => '/carenta'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
