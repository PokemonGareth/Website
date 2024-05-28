<?php
// Starts the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ProductController.php';

if (!isset($_GET['id'])) {
    redirect('member', ["error" => "No product ID provided"]);
}

$productID = $_GET['id'];

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Signs into the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiates the product controller
    $productController = new ProductController($dbController);

    // Fetches the product by ID
    $product = $productController->get_product_by_id($productID);

    if (!$product) {
        redirect('member', ["error" => "Product not found"]);
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$title = 'Confirm Delete'; 
require __DIR__ . "/inc/header.php"; 
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">

<a href="member.php"><button type="button">Back</button></a>

<h1>Confirm Deletion</h1>

<p>Are you sure you want to delete this product?</p>

<table>
    <tr><th>ID</th><td><?php echo htmlspecialchars($product['id']); ?></td></tr>
    <tr><th>Name</th><td><?php echo htmlspecialchars($product['name']); ?></td></tr>
    <tr><th>Description</th><td><?php echo htmlspecialchars($product['description']); ?></td></tr>
    <tr><th>Price</th><td><?php echo htmlspecialchars($product['price']); ?></td></tr>
    <tr><th>Image</th><td><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" style="width:50px;height:50px;"></td></tr>
</table>

<form method="post" action="DeleteProduct.php">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
    <button type="submit">Delete</button>
</form>
<a href="A-ViewProducts.php"><button type="button">Cancel</button></a>

</div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
