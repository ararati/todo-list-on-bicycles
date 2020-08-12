<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$app = new \App\Core\Application();

\App\Core\Http\Session::start();

\App\Core\Database\Database::setConfig(require_once '../config/database.php');

$app->instance(\App\Http\Middleware\Middleware::class, new \App\Http\Middleware\Middleware($app));

$app->setRouter(\App\Core\Routing\Router::class);

$app->router()->setContainer($app);

\App\Core\Routing\RouteFacade::initialize($app->router());

require_once '../routes/web.php';

require_once '../app/helpers/helpers.php';

isAuth();

return $app;