<?php

//require the autoload file
require_once('vendor/autoload.php');

//create an instance of the Base class
$f3 = Base::instance();

//set debug level
$f3->set('DEBUG', 3);

//define a default route
$f3->route('GET /', function() {
    $view = new View;
    echo $view->render
    ('/pages/home.html');
});

//run fat free
$f3->run();