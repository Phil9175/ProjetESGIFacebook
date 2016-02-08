<?php
session_start();
date_default_timezone_set("Europe/Paris");
include("core/class/constantes.core.class.php");

require_once 'controller/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';
require_once 'controller/PHPExcel.php';

spl_autoload_register( function($class_name) {
    if (file_exists("controller/class/" . $class_name . ".controller.class.php"))
	{
		include_once("controller/class/" . $class_name . ".controller.class.php");
	}
	 if (file_exists("view/class/" . $class_name . ".view.class.php"))
	{
		include_once("view/class/" . $class_name . ".view.class.php");
	}
	 if (file_exists("core/class/" . $class_name . ".core.class.php"))
	{
		include_once("core/class/" . $class_name . ".core.class.php");
	}
	 if (file_exists("modele/class/" . $class_name . ".modele.class.php"))
	{
		include_once("modele/class/" . $class_name . ".modele.class.php");
	}
});

$url = explode("/", trim($_SERVER['REQUEST_URI'], "/"));
$object = ($url[0] == "/" || $url[0] == "")?"index":$url[0];
unset($url[0]);
$action = (!isset($url[1]))?"defaultPage":$url[1];
unset($url[1]);
$args = array_merge($url, $_POST);

if (class_exists($object)){
	$obj = new $object;
	if (is_callable([$obj, $action]) && fonctions::is_controller($object)){
		$obj->$action($args);
		}else{
		unset($obj);
		$obj = new notFound;
	}
}else{
	$obj = new notFound;
}
?>