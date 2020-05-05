<?php
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the auto load file
require_once("vendor/autoload.php");

//instantiate the F3 Base class
$f3 = Base::instance();

//default route
$f3->route('GET /', function () {
    //echo "<h1>My Pets</h1>";

    $view = new Template();
    echo $view->render('views/pet-home.html');
});

//Order route
$f3->route('GET|POST /order', function ($f3) {
    echo "Order Page";
});

//run f3
$f3->run();
