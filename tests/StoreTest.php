<?php

    /**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Store.php";
   require_once "src/Shoe.php";

   $server = 'mysql:host=localhost:8889;dbname=shoes_test';
   $username = 'root';
   $password = 'root';
   $DB = new PDO($server, $username, $password);

   class StoreTest extends PHPUnit_Framework_TestCase
   {
       protected function tearDown()
       {
           Store::deleteAll();
           Shoe::deleteAll();
       }

       function testGetName()
       {
           $name = "Shooooes";
           $test_store = new Store($name);

           $result = $test_store->getName();

           $this->assertEquals($name, $result);
       }

       function testSetName()
       {
           $name = "Shoess";
           $test_store = new Store($name);
           $new_name = "Sandwich Chews";

           $test_store->setName($new_name);
           $result = $test_store->getName();

           $this->assertEquals($new_name, $result);
       }

       function testGetId()
       {
           $name = "Blues Shoes";
           $test_store = new Store($name);
           $test_store->save();

           $result = $test_store->getId();

           $this->assertTrue(is_numeric($result));
       }

       function testSave()
       {
           $name = "Zoos Shoes";
           $test_store = new Store($name);
           $test_store->save();

           $executed = $test_store->save();

           $this->assertTrue($executed, "Store not successfully saved to database");
       }

       function testGetAll()
       {
           $name = "Her Shoes";
           $test_store = new Store($name);
           $test_store->save();

           $name2 = "His Shoes";
           $test_store2 = new Store($name2);
           $test_store2->save();

           $result = Store::getAll();

           $this->assertEquals([$test_store, $test_store2], $result);
       }

       function testDeleteAll()
       {
           $name = "Their Shoes";
           $test_store = new Store($name);
           $test_store->save();

           $name2 = "My Shoes";
           $test_store2 = new Store($name2);
           $test_store2->save();

           Store::deleteAll();

           $result = Store::getAll();
           $this->assertEquals([], $result);
       }

       function testFind()
       {
           $name = "Shoes Used";
           $test_store = new Store($name);
           $test_store->save();

           $name2 = "Shoes New";
           $test_store2 = new Store($name2);
           $test_store2->save();

           $result = Store::find($test_store->getId());

           $this->assertEquals($test_store, $result);
       }

       function testUpdate()
       {
           $name = "Shoes Old";
           $test_store = new Store($name);
           $test_store->save();

           $new_name = "Shoes Fresh";

           $test_store->update($new_name);

           $this->assertEquals("Shoes Fresh", $test_store->getName());
       }

       function testDelete()
       {
           $brand = "Fish shoes";
           $price = 50;
           $test_shoe = new Shoe($brand, $price);
           $test_shoe->save();

           $name = "Shoes Now";
           $test_store = new Store($name);
           $test_store->save();

           $test_store->addShoe($test_shoe);
           $test_store->delete();

           $this->assertEquals([], $test_store->getShoes());
       }

       function testAddShoe()
       {

           $brand = "Shoe Fish";
           $price = 50;
           $test_shoe = new Shoe($brand, $price);
           $test_shoe->save();

           $name = "Shoes Then";
           $test_store = new Store($name);
           $test_store->save();

           $test_store->addShoe($test_shoe);

           $this->assertEquals($test_store->getShoes(), [$test_shoe]);
       }

       function testGetShoes()
       {
           $brand = "Whatever Shoes";
           $price = 50;
           $test_shoe = new Shoe($brand, $price);
           $test_shoe->save();

           $brand2 = "Shoeshops";
           $price2 = 100;
           $test_shoe2 = new Shoe($brand2, $price2);
           $test_shoe2->save();

           $name = "Mall";
           $test_store = new Store($name);
           $test_store->save();

           $test_store->addShoe($test_shoe);
           $test_store->addShoe($test_shoe2);

           $this->assertEquals($test_store->getShoes(), [$test_shoe, $test_shoe2]);
       }

       function testMakeTitleCase()
       {
           $name = "shoes galore";
           $test_store = new Store($name);
           $test_store->save();

           $title_cased = "Shoes Galore";
           $result = $test_store->makeTitleCase($name);

           $this->assertEquals($title_cased, $result);
       }
   }

 ?>
