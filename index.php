<?php

//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');
require_once("model/data-layer.php");

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Default Route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/pet-home.html');
});

//Order 1 Route
$f3->route('GET /order', function($f3) {

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Validate the data
        if (empty($_POST['pet'])){

        } else{

        }
    }

    $colors = getColors();
    $f3->set('colors', $colors);

    $view = new Template();
    echo $view->render('views/pet-order.html');
});

//Order 2 Route
$f3->route('POST /order2', function($f3) {

    // Storing POST array data from order 1
    $_SESSION['pet'] = $_POST['pet'];
    $_SESSION['color'] = $_POST['color'];

    $sizes = getSizes();
    $f3->set('sizes', $sizes);

    $accessories = getAccessories();
    $f3->set('accessories', $accessories);

    $view = new Template();
    echo $view->render('views/pet-order2.html');
});

//Summary Route
$f3->route('POST /summary', function() {

    // Storing POST array data from order 2
    $_SESSION['petName'] = $_POST['petName'];
    $_SESSION['size'] = $_POST['size'];
    $accessories = $_POST['accessory'];

//    var_dump($_POST['accessory']);

//    foreach ($accessories as $accessory) {
//        echo " " . $accessory;
//    }



   $_SESSION['accessory'] = $accessories;

    $view = new Template();
    echo $view->render('views/order-summary.html');
});

//Order 3 Route
$f3->route('GET /order3', function() {

    $view = new Template();
    echo $view->render('views/pet-order3.html');
});

//Run fat free
$f3->run();