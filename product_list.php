<?php
// list_products.php
require 'db2.php';
require 'productFactory.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['delete_ids'])) {
    $delete_ids = implode(",", array_map('intval', $_POST['delete_ids']));
    $sql_delete = "DELETE FROM products WHERE id IN ($delete_ids)";
    $connection->exec($sql_delete);
    header("Location: product_list.php");
    exit();
}
$sql = "SELECT * FROM products";
$stmt = $connection->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Products List</title>
    <link rel="stylesheet" href="./main.css">
</head>
<body>
    <h1 class="text-primary text-center m-4">Products List</h1>
    <div class="container ">
        
        <form method="POST" action="">
            <button class=" btn btn-danger ms-auto" type="submit">Delete Selected</button>
            <div class="cards row ">
            <?php foreach ($products as $productData): 
            $product = createProduct(
                $productData['sku'],
                $productData['name'],
                $productData['price'],
                $productData['type'],
                $productData['dimension']
            );
            ?>

            
                <div class="product-card col-md-3">

                    <input id="check" type="checkbox" name="delete_ids[]" value="<?php echo $productData['id']; ?>"> 
                    <h3><?php echo htmlspecialchars($product->getName()); ?></h3>
                    <p><strong>SKU:</strong> <?php echo htmlspecialchars($product->getSku()); ?></p>
                    <p><strong>Price:</strong> <?php echo htmlspecialchars($product->getPrice()); ?>$</p>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($productData['type']); ?></p>
                    <p><strong>Dimension:</strong> <?php echo $product->displayDimension(); ?></p>
                </div>
            
            <?php endforeach; ?>
        </div>
    </form>
    <a href="add_product.php" class="btn btn-primary my-2">Add New Product</a>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
