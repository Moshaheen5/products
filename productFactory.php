<?php
// ProductFactory.php
require 'Product.php';


function createProduct($sku, $name, $price, $type, $dimension)
{
    switch ($type) {
        case 'dvd':
            return new DVD($sku, $name, $price, $dimension);
        case 'book':
            return new Book($sku, $name, $price, $dimension);
        case 'furniture':
            return new Furniture($sku, $name, $price, $dimension);
        default:
            throw new Exception("Invalid product type");
    }
}
?>
