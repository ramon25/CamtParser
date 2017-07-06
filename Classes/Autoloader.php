<?php

namespace Ongoing\CamtParser\Classes;

spl_autoload_register(function($class) {
    $prefix = 'Ongoing\\CamptParser\\';

    if ( ! substr($class, 0, 19) === $prefix) {
        return;
    }

    $class = substr($class, strlen($prefix) -1);
    $location = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

    if (is_file($location)) {
        require_once($location);
    }
});