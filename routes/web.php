<?php

use App\Core\Routing\RouteFacade as Route;

Route::get('', 'TaskController:index');
Route::get('task/edit/\d+', 'TaskController:edit');
Route::post('task/edit', 'TaskController:update');
Route::post('task', 'TaskController:store');

Route::get('auth', 'AuthController:index');
Route::post('auth', 'AuthController:auth');
Route::post('logout', 'AuthController:logout');