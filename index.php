<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;

$app = new Slim();

$app->config('debug', true);

require_once("site.php");

require_once("admin.php");

require_once("admin-users.php");

require_once("admin-login.php");

require_once("admin-products.php");

require_once("admin-laboratories.php");

require_once("admin-therapeutic_classes.php");

require_once("admin-active_principles.php");

require_once("admin-cart.php");

require_once("functions.php");

require_once("admin-provider.php");

require_once("admin-lots.php");

require_once("admin-puchases.php");



$app->run();

 ?>