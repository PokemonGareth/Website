<?php
require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ProductController.php';

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    $dbController = new DatabaseController($dsn, $username, $password);
    $productController = new ProductController($dbController);

    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
    $products = $productController->search_products($searchQuery);

    if (!empty($products)) {
        echo '<table>';
        echo '<tr><th>Name</th><th>Description</th><th>Price</th><th>Image</th></tr>';
        foreach ($products as $product) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product['name']) . '</td>';
            echo '<td>' . htmlspecialchars($product['description']) . '</td>';
            echo '<td>' . htmlspecialchars($product['price']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($product['image']) . '" alt="Product Image" style="width:50px;height:50px;"></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No products found.</p>';
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
