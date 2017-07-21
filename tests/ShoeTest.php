<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Shoe.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ShoeTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Shoe::deleteAll();
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
            $brand = "Blowfish";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $new_brand = "Vans";

            $test_shoe->setBrand($new_brand);
            $result = $test_shoe->getBrand();

            $this->assertEquals($new_brand, $result);
        }

        function testGetPrice()
        {
            $brand = "Blowfish";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);

            $result = $test_shoe->getPrice();

            $this->assertEquals($price, $result);
        }

        function testSetPrice()
        {
            $brand = "Blowfish";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $new_price = 1;

            $test_shoe->setPrice($new_price);
            $result = $test_shoe->getPrice();

            $this->assertEquals($new_price, $result);
        }

        function testGetId()
        {
            $brand = "Blowfish";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $result = $test_shoe->getId();

            $this->assertTrue(is_numeric($result));
        }

        function testSave()
        {
            $brand = "Blowfish";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $executed = $test_shoe->save();

            $this->assertTrue($executed, "Shoe not successfully saved to database");
        }

        function testGetAll()
        {
            $brand = "Blowfish";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $brand2 = "Vans";
            $price2 = 100;
            $test_shoe2 = new Shoe($brand2, $price2);
            $test_shoe2->save();

            $result = Shoe::getAll();

            $this->assertEquals([$test_shoe, $test_shoe2], $result);
        }

        function testDeleteAll()
        {
            $brand = "Blowfish";
            $price = 50;
            $test_shoe = new Shoe($brand, $price);
            $test_shoe->save();

            $brand2 = "Vans";
            $price2 = 100;
            $test_shoe2 = new Shoe($brand2, $price2);
            $test_shoe2->save();

            Shoe::deleteAll();

            $result = Shoe::getAll();
            $this->assertEquals([], $result);
        }
    }
?>
