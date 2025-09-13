<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Flash\Messages;
use Slim\Views\PhpRenderer;
use Src\Controllers\HomeController;

require __DIR__ . '/vendor/autoload.php';

session_start();

$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();

$container->set(PhpRenderer::class, function () use ($container) {
    return new PhpRenderer(
        __DIR__ . '/templates',
        [
            'flash' => $container->get('flash'),
        ]
    );
});

$container->set('flash', function () {
    return new Messages();
});

ORM::configure('mysql:host=database;dbname=docker;charset=utf8mb4');
ORM::configure('username', 'root');
ORM::configure('password', 'tiger');

$app->get('/', [HomeController::class, 'index']);
$app->get('/event/{id}', [HomeController::class, 'show']);
$app->get('/event/{id}/book', [HomeController::class, 'create']);
$app->post('/event/{id}/book', [HomeController::class, 'store']);

$app->run();

