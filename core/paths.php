<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

if (!defined('ABSR')) {
    define('ABSR', $_SERVER["DOCUMENT_ROOT"]);
}

if (!defined('SRC')) {
    define('SRC', ROOT . DS . "src" . DS);
}

if (!defined('APP')) {
    define('APP', ROOT . DS . 'app' . DS);
}

if (!defined('CORE')) {
    define('CORE', ROOT . DS . "core" . DS);
}

if (!defined('CONFIG')) {
    define('CONFIG', ROOT . DS . "config" . DS);
}

if (!defined('CRON')) {
    define('CRON', ROOT . DS . 'cron' . DS);
}

if (!defined('CONTROLLERS')) {
    define('CONTROLLERS', SRC . 'controller' . DS);
}

if (!defined('ASSETS')) {
    define('ASSETS', SRC . 'assets' . DS);
}

if (!defined('VIEWS')) {
    define('VIEWS', SRC . 'view' . DS);
}

if (!defined('MODULES')) {
    define('MODULES', ROOT . DS . 'modules' . DS);
}

if (!defined('MODEL')) {
    define('MODEL', SRC . 'model' . DS);
}

if (!defined('LANGUAGES')) {
    define('LANGUAGES', SRC . 'languages' . DS);
}
