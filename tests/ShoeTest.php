<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Shoe.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ShoeTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Shoe::deleteAll();
            Store::deleteAll();
        }

        function testGetBrand()
        {
            $brand = "Blowfish";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);

            $result = $test_shoe->getBrand();

            $this->assertEquals($brand, $result);
        }

        function testSetBrand()
        {
            $brand = "Nike";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $new_brand = "Vans";

            $test_shoe->setBrand($new_brand);
            $result = $test_shoe->getBrand();

            $this->assertEquals($new_brand, $result);
        }

        function testGetPrice()
        {
            $brand = "Celebs";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);

            $result = $test_shoe->getPrice();

            $this->assertEquals($price, $result);
        }

        function testSetPrice()
        {
            $brand = "Merrill";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $new_price = 1;

            $test_shoe->setPrice($new_price);
            $result = $test_shoe->getPrice();

            $this->assertEquals($new_price, $result);
        }

        function testGetId()
        {
            $brand = "Saucony";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $result = $test_shoe->getId();

            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            $brand = "Adidas";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $executed = $test_shoe->save();

            $this->assertTrue($executed, "Shoe not successfully saved to database");
        }

        function testGetAll()
        {
            $brand = "Coral";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $brand2 = "Pumps";
            $price2 = 100;
            $test_shoe2 = new Shoe($brand2, $price2);
            $test_shoe2->save();

            $result = Shoe::getAll();

            $this->assertEquals([$test_shoe, $test_shoe2], $result);
        }

        function testDeleteAll()
        {
            $brand = "Choooo";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $brand2 = "Shoes yo";
            $price2 = 100;
            $test_shoe2 = new Shoe($brand2, $price2);
            $test_shoe2->save();

            Shoe::deleteAll();

            $result = Shoe::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            $brand = "New Balance";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $brand2 = "Newest Balance";
            $price2 = 100;
            $test_shoe2 = new Shoe($brand2, $price2);
            $test_shoe2->save();

            $result = Shoe::find($test_shoe->getId());

            $this->assertEquals($test_shoe, $result);
        }

        function testUpdate()
        {
            $brand = "Flats";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $new_brand = "Sandals";

            $test_shoe->update($new_brand);

            $this->assertEquals("Sandals", $test_shoe->getBrand());
        }

        function testUpdatePrice()
        {
            $brand = "High Heels";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $new_price = 100;

            $test_shoe->updatePrice($new_price);

            $this->assertEquals(100, $test_shoe->getPrice());
        }

        function testDelete()
        {
            $name = "Shoe Crew";
            $test_store = new Store($name);
            $test_store->save();

            $brand = "Swoosh";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $test_shoe->addStore($test_store);
            $test_shoe->delete();

            $this->assertEquals([], $test_shoe->getStores());
        }

        function testAddStore()
        {
            $name = "Shoes Crews";
            $test_store = new Store($name);
            $test_store->save();

            $brand = "Swooshes";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $test_shoe->addStore($test_store);

            $this->assertEquals($test_shoe->getStores(), [$test_store]);
        }

        function testGetStores()
        {
            $name = "Shoez Crewz";
            $test_store = new Store($name);
            $test_store->save();

            $name2 = "Shuz Cruz";
            $test_store2 = new Store($name2);
            $test_store2->save();

            $brand = "Jellies";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $test_shoe->addStore($test_store);
            $test_shoe->addStore($test_store2);

            $this->assertEquals($test_shoe->getStores(), [$test_store, $test_store2]);
        }

        function testMakeTitleCase()
        {
            $brand = "bikes and bikes";
            $price = 100;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $title_cased = "Bikes and Bikes";
            $result = $test_shoe->makeTitleCase($brand);

            $this->assertEquals($title_cased, $result);
        }

        function testCheckDuplicate()
        {
            $brand = "shoesy";
            $price = 100;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $new_brand = "shoesy";
            $result = $test_shoe->checkDuplicate($new_brand);

            $this->assertEquals("duplicate found", $result);
        }
    }
?>
