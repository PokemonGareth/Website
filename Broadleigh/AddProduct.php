<?php
// Start the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ProductController.php';

// Access the session
if (!isset($_SESSION['user'])) {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

$title = 'Add Product'; 
require __DIR__ . "/inc/header.php"; 

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    $dbController = new DatabaseController($dsn, $username, $password);
    $productController = new ProductController($dbController);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the details from the form
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_POST['image']; // Ideally, you should handle file uploads and store the image properly

        // Add the product to the database
$productDetails = [
    'name' => $name,
    'description' => $description,
    'price' => $price,
    'image' => $image
];
$productController->create_product($productDetails);


        // Redirect back to the product listing page
        header('Location: A-ViewProducts.php');
        exit;
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">
        <a href="A-ViewProducts.php"><button type="button">Back</button></a>
        <h1>Add Product</h1>
        <form method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required></textarea><br><br>
            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price" required><br><br>
            <label for="image">Image URL:</label><br>
            <input type="text" id="image" name="image" required><br><br>
            <input type="submit" value="Add Product">
        </form>
    </div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
