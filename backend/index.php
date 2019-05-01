<?php
require_once '../config.php';
require_once 'app/Session.php';
require_once 'Controller/ViewController.php';
require_once 'Controller/MessagesController.php';
require_once 'Controller/SeoController.php';
require_once "Controller/SortController.php";
require_once 'Model/AppConfig.php';

define('DS', DIRECTORY_SEPARATOR);

$_conf = new AppConfig();

// URL base y URL para el panel de administración
$_base = $_conf->getUrlBase()->valor;
$_admin = $_conf->getAdminUrl()->valor;
define('URL_BASE', $_base);
define('ADMIN_URL', $_admin);
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

Session::start();
ViewController::backTemplate();
