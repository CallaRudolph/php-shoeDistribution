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
}
?>
