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
}
?>
