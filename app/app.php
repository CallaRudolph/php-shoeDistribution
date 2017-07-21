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
        $uc_store = $store->makeTitleCase($name);
        $store->setName($uc_store);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/delete_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
    });

    $app->get("store/{id}/edit", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store_edit.html.twig', array('store' => $store));
    });

    $app->patch("/store/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $store = Store::find($id);
        $uc_name = $store->makeTitleCase($name);
        $store->update($uc_name);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
    });

    $app->delete("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/add_shoes", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $shoe = Shoe::find($_POST['shoe_id']);
        $store->addShoe($shoe);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'stores' => Store::getAll(), 'shoes' => $store->getShoes(), 'all_shoes' => Shoe::getAll()));
    });

    //////////////////////////////////////

    $app->get("/shoes", function() use ($app) {
        return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll()));
    });

    $app->post("/shoes", function() use ($app) {
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $shoe = new Shoe($brand, $price);
        $uc_shoe = $shoe->makeTitleCase($brand);
        $shoe->setBrand($uc_shoe);
        $shoe->save();
        return $app['twig']->render('shoes.html.twig', array('shoes' => Shoe::getAll()));
    });

    $app->post("/delete_shoes", function() use ($app) {
        Shoe::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/shoe/{id}", function($id) use ($app) {
        $shoe = Shoe::find($id);
        return $app['twig']->render('shoe.html.twig', array('shoe' => $shoe, 'stores' => $shoe->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->post("/add_stores", function() use ($app) {
        $shoe = Shoe::find($_POST['shoe_id']);
        $store = Store::find($_POST['store_id']);
        $shoe->addStore($store);
        return $app['twig']->render('shoe.html.twig', array('shoe' => $shoe, 'shoes' => Shoe::getAll(), 'stores' => $shoe->getStores(), 'all_stores' => Store::getAll()));
    });

    return $app;
?>
