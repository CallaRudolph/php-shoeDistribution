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
}
?>
