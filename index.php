<?php
//This is my controller

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);



//Require autoload file
require_once('vendor/autoload.php');

//Create an instance of the base class
$f3 = Base::instance();

//Define a default route
$f3 -> route('GET /', function() {
    //display the homepage
    $view = new Template();
    echo $view->render('views/info.html');
    }
);

$f3 -> route("GET /breakfast", function () {
    echo "home page";
    //display the breakfast page
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

$f3 -> route("GET /lunch", function () {
    //display the lunch page
    $view = new Template();
    echo $view->render('views/lunch.html');
});

$f3 -> route("GET|POST /order1", function () {
    //If the form has been submitted, add the data to session
    // and send the user to the next order form
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['food'] = $_POST['food'];
        $_SESSION['meal'] = $_POST['meal'];
        header('location: order2');
    }
    //display the order1 page
    $view = new Template();
    echo $view->render('views/orderForm1.html');
});

$f3 -> route("GET|POST /order2", function () {
    //If the form has been submitted, add the data to session
    // and send the user to the next order form
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        //Data validation will go here

        $_SESSION['conds'] = implode(", ", $_POST['conds']);
        header('location: summary');
    }

    //display the order2 page
    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

$f3 -> route("GET /summary", function () {
    //display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3->run();