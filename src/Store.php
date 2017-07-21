<?php
class Store
{
    private $name;
    private $id;

    function __construct($name, $id = null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
        if ($executed) {
            $this->id = $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
        $stores = array();
        foreach($returned_stores as $store) {
            $name = $store['name'];
            $id = $store['id'];
            $new_store = new Store($name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
    }

    static function deleteAll()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM stores;");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    static function find($search_id)
    {
        $found_store = null;
        $returned_stores = $GLOBALS['DB']->prepare("SELECT * FROM stores WHERE id = :id");
        $returned_stores->bindParam(':id', $search_id, PDO::PARAM_STR);
        $returned_stores->execute();
        foreach($returned_stores as $store) {
            $name = $store['name'];
            $id = $store['id'];
            if ($id == $search_id) {
                $found_store = new Store($name, $id);
            }
        }
        return $found_store;
    }

    function update($new_name)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
        if ($executed) {
            $this->setName($new_name);
            return true;
        } else {
            return false;
        }
    }

    function delete()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        if (!$executed) {
            return false;
        }
        $GLOBALS['DB']->exec("DELETE FROM shoes_stores WHERE store_id = {$this->getId()};");
        if (!$executed) {
            return false;
        } else {
            return true;
        }
    }

    function addShoe($shoe)
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO shoes_stores (shoe_id, store_id) VALUES ({$shoe->getId()}, {$this->getId()});");
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    function getShoes()
    {
        $returned_shoes = $GLOBALS['DB']->query("SELECT shoes.* FROM stores JOIN shoes_stores ON (shoes_stores.store_id = stores.id) JOIN shoes ON (shoes.id = shoes_stores.shoe_id) WHERE stores.id = {$this->getId()};");
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

    function makeTitleCase($name)
    {
        $no_caps = strtolower($name);
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
