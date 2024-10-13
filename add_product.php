<?php
// add_product.php
require 'db2.php';
require 'productFactory.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    
    $dimension = '';
    if ($type === 'furniture') {
        $width = $_POST['width'];
        $height = $_POST['height'];
        $length = $_POST['length'];
        $dimension = $width . '*' . $height . '*' . $length;
    } else {
        $dimension = $_POST['dimension'];
    }

    $product = createProduct($sku, $name, $price, $type, $dimension);

    $sql = "INSERT INTO products (sku, name, price, type, dimension) VALUES (:sku, :name, :price, :type, :dimension)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'sku' => $product->getSku(),
        'name' => $product->getName(),
        'price' => $product->getPrice(),
        'type' => $type,
        'dimension' => $product->getDimension(),
    ]);

    echo "Product added successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./add.css">
    <title>Add Product</title>
</head>
<body>
    <div class="container">
        <h1  class="text-center text-primary my-4">Add New Product</h1>
        <div class="form-container">
            <form method="POST" action="add_product.php">
                <label for="sku">SKU:</label>
                <input type="text" id="sku" name="sku" class="form-control" required>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>

                <label for="price">Price:</label>
                <input type="number" step="0.01" id="price" class="form-control" name="price" required>
                
                <label for="type">Product Type:</label>
                <select id="type" name="type" class="form-control" onchange="updateDimensionInput()">
                    <option value="">Select a product type</option>
                    <option value="dvd">DVD-disc</option>
                    <option value="book">Book</option>
                    <option value="furniture">Furniture</option>
                </select>

                <div id="dimension-container" class="form-group" style="display:none;">
                    <label id="dimension-label" for="dimension"></label>
                    <input type="text" id="dimension" name="dimension"  class="form-control" />

                    <div id="furniture-dimensions" style="display:none;">
                        <label for="width">Width (cm):</label>
                        <input type="number" id="width" name="width"  class="form-control">

                        <label for="height">Height (cm):</label>
                        <input type="number" id="height" name="height"  class="form-control">

                        <label for="length">Length (cm):</label>
                        <input type="number" id="length" name="length"  class="form-control">
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Add Product</button>
            </form>
        </div>
    </div>
    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
