<?php

    /**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Store.php";

   $server = 'mysql:host=localhost:8889;dbname=shoes_test';
   $username = 'root';
   $password = 'root';
   $DB = new PDO($server, $username, $password);

   class StoreTest extends PHPUnit_Framework_TestCase
   {
       protected function tearDown()
       {
           Store::deleteAll();
       }

       function testGetName()
       {
           $name = "Shoes Galore";
           $test_store = new Store($name);

           $result = $test_store->getName();

           $this->assertEquals($name, $result);
       }

       function testSetName()
       {
           $name = "Shoes Galore";
           $test_store = new Store($name);
           $new_name = "Shoes Abode";

           $test_store->setName($new_name);
           $result = $test_store->getName();

           $this->assertEquals($new_name, $result);
       }

       function testGetId()
       {
           $name = "Shoes Galore";
           $test_store = new Store($name);
           $test_store->save();

           $result = $test_store->getId();

           $this->assertTrue(is_numeric($result));
       }

       function testSave()
       {
           $name = "Shoes Galore";
           $test_store = new Store($name);
           $test_store->save();

           $executed = $test_store->save();

           $this->assertTrue($executed, "Store not successfully saved to database");
       }

       function testGetAll()
       {
           $name = "Shoes Galore";
           $test_store = new Store($name);
           $test_store->save();

           $name2 = "Shoes Abode";
           $test_store2 = new Store($name2);
           $test_store2->save();

           $result = Store::getAll();

           $this->assertEquals([$test_store, $test_store2], $result);
       }

       function testDeleteAll()
       {
           $name = "Shoes Galore";
           $test_store = new Store($name);
           $test_store->save();

           $name2 = "Shoes Abode";
           $test_store2 = new Store($name2);
           $test_store2->save();

           Store::deleteAll();

           $result = Store::getAll();
           $this->assertEquals([], $result);
       }

       function testFind()
       {
           $name = "Shoes Galore";
           $test_store = new Store($name);
           $test_store->save();

           $name2 = "Shoes Abode";
           $test_store2 = new Store($name2);
           $test_store2->save();

           $result = Store::find($test_store->getId());

           $this->assertEquals($test_store, $result);
       }
   }

 ?>
