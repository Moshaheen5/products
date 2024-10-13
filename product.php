<?php
// Abstract class: Product.php
abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $dimension;

    public function __construct($sku, $name, $price, $dimension)
    {
        $this->setSku($sku);
        $this->setName($name);
        $this->setPrice($price);
        $this->setDimension($dimension);
    }

    abstract public function displayDimension(): string;

    // Setters and Getters
    public function setSku($sku) { $this->sku = $sku; }
    public function getSku() { return $this->sku; }

    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }

    public function setPrice($price) { $this->price = $price; }
    public function getPrice() { return $this->price; }

    public function setDimension($dimension) { $this->dimension = $dimension; }
    public function getDimension() { return $this->dimension; }
}
class DVD extends Product
{
    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price, $size);
        $this->type = 'dvd';
    }

    public function displayDimension(): string
    {
        return $this->getDimension() . ' MB';
    }
}

// Book class
class Book extends Product
{
    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price, $weight);
        $this->type = 'book';
    }

    public function displayDimension(): string
    {
        return $this->getDimension() . ' Kg';
    }
}

// Furniture class
class Furniture extends Product
{
    public function __construct($sku, $name, $price, $dimensions)
    {
        parent::__construct($sku, $name, $price, $dimensions);
        $this->type = 'furniture';
    }

    public function displayDimension(): string
    {
        list($width, $height, $length) = explode('*', $this->getDimension());
        return $width . 'cm X ' . $height . 'cm X ' . $length . 'cm';
    }
}
?>
