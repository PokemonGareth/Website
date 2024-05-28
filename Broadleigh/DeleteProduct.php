<?php
// Start the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ProductController.php';

if (!isset($_POST['id'])) {
    redirect('member.php', ["error" => "No product ID provided"]);
}

$productID = $_POST['id'];

// Define your DSN, username, and password
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Instantiate the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiate the product controller
    $productController = new ProductController($dbController);

    // Delete the product by ID
    $productController->delete_product($productID);

    redirect('A-ViewProducts', ["success" => "Product deleted successfully"]);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
