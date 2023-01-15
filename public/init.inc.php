<?php
if (!file_exists(__DIR__.'/../vendor/autoload.php')) {
    die('You must install libraries with composer install');
}

require_once __DIR__.'/../vendor/autoload.php';

//-- Configuration ----------------------
define('PATH_TEMPLATE', realpath(__DIR__ . '/../template'));
define('RELATIVE_URL_EXPORT_PDF', '/data');
define('PATH_EXPORT_PDF', __DIR__.RELATIVE_URL_EXPORT_PDF);
//---------------------------------------

error_reporting(E_ERROR | E_WARNING | E_PARSE); // ne pas afficher les déprécations de Html2Pdf
