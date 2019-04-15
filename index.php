<?php
/**
 * Created by PhpStorm.
 * User: jrakk
 * Date: 4/8/2019
 * Time: 2:16 PM
 */

    // Turn on error reporting
    ini_set('display_error', 1);
    error_reporting(E_ALL);

    //require autoload file
    require_once ('vendor/autoload.php');

    // create an instance of the base class
    $f3 = Base::instance();

    // Turn on Fat-free error reporting
    $f3->set('DEBUG', 3);

    // define a default route
    $f3->route('GET /', function()
    {
        //echo '<h1>Food!</h1>';
        $view = new Template();
        echo $view->render('views/home.html');
    });

    // Define a breakfast route

    $f3->route('GET /breakfast', function()
    {
        //echo "<h1>Breakfast Page</h1>";
        // display breakfast view
        $view = new Template();
        echo $view->render('views/breakfast.html');
    });

    $f3->route('GET /lunch', function()
    {
        // display a lunch views
        $view = new Template();
        echo $view->render('views/lunch.html');
    });

    $f3->route('GET /breakfast/continental', function()
    {
        // display a bfast views
        $view = new Template();
        echo $view->render('views/bfast-cont.html');
    });

    $f3->route('GET /lunch/brunch/buffet', function()
    {
        // display a brunch views
        $view = new Template();
        echo $view->render('views/buffet.html');
    });

    // Define a route with a parameter
    $f3->route('GET /@item', function($f3, $params)
    {
        $item = $params['item'];
        $foodsWeServe = array('spaghetti', 'enchiladas',
            'pad thai', 'lumpia');

        if (!in_array($item, $foodsWeServe))
        {
            echo "We don't serve $item";
        }

        switch ($item)
        {
            case 'spaghetti':
                echo "<h3>I like $item with meatballs.</h3>";
                break;
            case 'pizza':
                echo "<h3>Pepperoni or veggie?</h3>";
                break;
            case 'tacos':
                echo "<h3>We don't have $item.</h3>";
                break;
            case 'bagel':
                $f3->reroute("/breakfast/continental");
            default:
                $f3->error(404);
        }

    });

    $f3->route('GET /@first/@last', function($f3, $params)
    {
        $first = ucfirst($params['first']);
        $last = ucfirst($params['last']);

        echo "<h1>Hello $first $last</h1>";
    });

    $f3->route('GET /order', function()
    {
        // display a brunch views
        $view = new Template();
        echo $view->render('views/form1.html');
    });

    // Run Fat-Free
    $f3->run();
