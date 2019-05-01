<?php
require_once 'config.php';
require_once 'backend/Model/AppConfig.php';
require_once 'frontend/Controller/ViewFrontController.php';
require_once 'frontend/Controller/SeoFrontController.php';
//require_once "frontend/Controller/SortController.php";

define('DS', DIRECTORY_SEPARATOR);

$_conf = new AppConfig();

// URL base. Si se encuentra en la raiz del document root dejar solo '/'
$_base = $_conf->getUrlBase()->valor;
define('URL_BASE', $_base);
define('MEDIA_COVERS', $_base.'media/covers/');

// Nombre de la app
$_brand = $_conf->getAppName()->valor;
define('BRAND', $_brand);

// Ultimos registros del catálogo empezando por el final
$last = (int)$_conf->getLastReg()->valor;
define('LAST_REG', $last);

// Registros que se listarán por página
$reg_page = (int)$_conf->getRegPerPage()->valor;
define('REG_PAGE', $reg_page);

ViewFrontController::frontTemplate();
