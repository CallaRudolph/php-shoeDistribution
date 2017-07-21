<?php
class Shoe
{
    private $brand;
    private $price;
    private $id;

    function __construct($brand, $price, $id = null)
    {
        $this->brand = $brand;
        $this->price = $price;
        $this->id = $id;
    }

    function getBrand()
    {
        return $this->brand;
    }

    function setBrand($new_brand)
    {
        $this->brand = (string) $new_brand;
    }

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($new_price)
    {
        $this->price = intval($new_price);
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO shoes (brand, price) VALUES ('{$this->getBrand()}', {$this->getPrice()});");
        if ($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
    {
        $returned_shoes = $GLOBALS['DB']->query("SELECT * FROM shoes;");
        $shoes = array();
        foreach($returned_shoes as $shoe) {
            $brand = $shoe['brand'];
            $price = $shoe['price'];
            $id = $shoe['id'];
            $new_shoe = new Shoe($brand, $price, $id);
            array_push($shoes, $new_shoe);
        }
        return $shoes;
    }

    static function deleteAll()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM shoes;");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    static function find($search_id)
    {
        $found_shoe = null;
        $returned_shoes = $GLOBALS['DB']->prepare("SELECT * FROM shoes WHERE id = :id");
        $returned_shoes->bindParam(':id', $search_id, PDO::PARAM_STR);
        $returned_shoes->execute();
        foreach($returned_shoes as $shoe) {
            $brand = $shoe['brand'];
            $price = $shoe['price'];
            $id = $shoe['id'];
            if ($id == $search_id) {
                $found_shoe = new Shoe($brand, $price, $id);
            }
        }
        return $found_shoe;
    }

    function addStore($store)
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO shoes_stores (shoe_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    function getStores()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM shoes JOIN shoes_stores ON (shoes_stores.shoe_id = shoes.id) JOIN stores ON (stores.id = shoes_stores.store_id) WHERE shoes.id = {$this->getId()};");
        $stores = array();
        foreach($returned_stores as $store) {
            $name = $store['name'];
            $id = $store['id'];
            $new_store = new Store($name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
    }

    function makeTitleCase($brand)
    {
        $no_caps = strtolower($brand);
        $input_array_of_words = explode(" ", $no_caps);
        $output_titlecased = array();
        $string = ucwords($no_caps);
        $prep = array(' a ', ' an ', ' the ', ' for ', ' and ', ' nor ', ' but ', ' or ', ' yet ', ' so ', ' such ', ' as ', ' at ', ' around ', ' by ', ' after ', ' along ', ' for ', ' from ', ' of ', ' on ', ' to ', ' with ', ' without ', ' is ');
        foreach($prep as $lower_case) {
        $string = str_replace(ucwords($lower_case), strtolower($lower_case), $string);
        }
        return ucfirst($string);
        foreach ($input_array_of_words as $word) {
            array_push($output_titlecased, ucfirst($word));
        }
        return implode(" ", $output_titlecased);
    }
}
?>
