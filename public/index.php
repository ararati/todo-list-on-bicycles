<?php
require_once '../autoload.php';

$app = require_once '../bootstrap/app.php';

$httpKernel = $app->make(\App\Http\Middleware\Middleware::class);

$request  = \App\Core\Http\Request::capture();

$httpKernel->handle($request);