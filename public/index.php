<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Sessions
 */
session_start(); 

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);

$router->add('signup',['controller' => 'Signup','action' => 'index']);
$router->add('signup/create',['controller' => 'Signup','action' => 'create']);

$router->add('login', ['controller' => 'Login', 'action' => 'index']);
$router->add('login/create',['controller' => 'Login' , 'action' => 'create']);
$router->add('logout',['controller' => 'Login','action' => 'destory']);

$router->add('sales',['controller' => 'Sale','action' => 'index']);
$router->add('report',['controller' => 'Sale','action' => 'show']);
$router->add('saledetails',['controller' => 'Sale','action' => 'showVoucher']);

$router->add('date',['controller' => 'Sale', 'action' => 'showByDate']);
$router->add('create',['controller' => 'Sale','action' => 'create']);
$router->add('createprint',['controller' => 'Sale','action' => 'createprint']);

$router->add('adminstration',['controller' => 'Adminstrator','action' => 'index']);
$router->add('adminstration/systemrolecreate',['controller'=>'Adminstrator','action'=>'createSystemRole']);
$router->add('adminstration/useraccountcreate',['controller'=>'Adminstrator','action'=>'create']);

$router->add('greenfeesetup/create',['controller' => 'GreenFeesSetup','action' => 'createGreenFees']);
$router->add('greenfeesetup/update',['controller' => 'GreenFeesSetup','action' => 'updateGreenFees']);
$router->add('greenfeesetup/delete',['controller' => 'GreenFeesSetup','action' => 'deleteGreenFees']);



$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
