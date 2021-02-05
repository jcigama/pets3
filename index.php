<?php

//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//Default Route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/pet-home.html');
});

//Order 1 Route
$f3->route('GET /order', function() {

    $view = new Template();
    echo $view->render('views/pet-order.html');
});

//Order 2 Route
$f3->route('POST /order2', function() {

    //Verify 'pet' exists in the post array, if so save it to session
    if(isset($_POST['pet'])) {
        $_SESSION['pet'] = $_POST['pet'];
    }

    //Verify 'colors' exists in the post array, if so save it to session
    if(isset($_POST['colors'])) {
        $colors = $_POST['colors'];
        $colorSelected = null;
        foreach ($colors as $colorsArray) {
//            echo "$colorsArray";
            $_SESSION['colors'] = $colorsArray;
        }
    }

    $view = new Template();
    echo $view->render('views/pet-order2.html');
});

//Summary Route
$f3->route('POST /summary', function() {

    //Verify 'petName' exists in the post array, if so save it to session
    if(isset($_POST['petName']))
    {
        $_SESSION['petName'] = $_POST['petName'];
    }

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