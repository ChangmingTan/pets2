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
    echo "<h1>My Pets</h1>";

    $view = new Template();
    echo $view->render('views/pet-home.html');
});

//Order route
$f3->route('GET|POST /order', function ($f3) {

    //If the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        //["food"]=>"tacos" ["meal"]=>"lunch"

        //Validate the data
        $meals = array("breakfast", "lunch", "dinner");
        if (empty($_POST['food']) || !in_array($_POST['meal'], $meals)) {
            echo "<p>Please enter a food and select a meal</p>";
        } //Data is valid
        else {
            //Store the data in the session array
            $_SESSION['food'] = $_POST['food'];
            $_SESSION['meal'] = $_POST['meal'];

            //Redirect to summary page
            $f3->reroute('summary');
            session_destroy();
        }
    }

    $view = new Template();
    echo $view->render('views/orderForm.html');

});

//run f3
$f3->run();
