<?php
// delete_products.php
require 'db2.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['delete_ids'])) {
    $delete_ids = implode(",", array_map('intval', $_POST['delete_ids']));
    $sql_delete = "DELETE FROM products WHERE id IN ($delete_ids)";
    $connection->exec($sql_delete);
    header("Location: product_list.php");
    exit();
}
?>
