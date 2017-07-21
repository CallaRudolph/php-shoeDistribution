<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Shoe.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'shoes' => Shoe::getAll()));
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/stores", function() use ($app) {
        $name = $_POST['name'];
        $store = new Store($name);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    return $app;
?>
