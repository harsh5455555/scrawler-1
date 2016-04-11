<?php

/**
 * This starts the scrawler Engine.
 * All files are included and autoloaded here.
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 */

//Detect if installation is on a subdirectory
$root = $_SERVER['DOCUMENT_ROOT'];
$path = dirname(__FILE__);
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    define("SEPARATOR", "\\");
} else {
    define("SEPARATOR", "/");
}
if ($root != $path) {
    $root = explode('/', $root);
    $path = explode(SEPARATOR, $path);
    $subdir = array_diff($path, $root);
    array_pop($subdir);
    array_filter($subdir);
    $subdir = implode("/", $subdir);
    define('SUBDIR', $subdir);
}

//we depend on Symfony ClassLoader for loading our classes
require_once(__DIR__ . '/Vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php');

use Symfony\Component\ClassLoader\UniversalClassLoader;

global $scrawler_loader;
$scrawler_loader = new UniversalClassLoader();

function &loader() {
    global $scrawler_loader;
    return $scrawler_loader;
}

//Loading our classes using PSR-4 Standards
$scrawler_loader->registerNamespace('Scrawler', __DIR__ . '/');
$scrawler_loader->registerNamespace('App', __DIR__ . '/../');
$scrawler_loader->register();

$Scrawler = new \Scrawler\Controller();
$router = new \Scrawler\Router();
