<?php
/**
 * Created by PhpStorm.
 * User: nekulin
 * Date: 08.04.15
 * Time: 8:00
 */
define('APP_DIR', __DIR__."/../app/");
define('CORE_DIR', __DIR__ . "/../");

function __autoload($classname) {
    $namespace = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
    $classPath = str_replace('\\', '/', $namespace) . '.php';
    if(is_readable(CORE_DIR . $classPath)) {
        require_once CORE_DIR . $classPath;
    }
}

