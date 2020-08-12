<?php

spl_autoload_extensions(".php");
spl_autoload_register();

spl_autoload_register(function (string $class) {
    $class = explode('\\',  $class);
    $class = implode(DIRECTORY_SEPARATOR, $class);
    $class .= '.php';

    require_once $class;
});