<?php
// Starts the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ProductController.php';

// Access the session
if (!isset($_SESSION['user'])) {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

$title = 'ADMIN - Edit Product'; 
require __DIR__ . "/inc/header.php"; 

// Gets the product ID from the URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id == 0) {
    echo '<p>Invalid product ID.</p>';
    exit;
}

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    $dbController = new DatabaseController($dsn, $username, $password);
    $productController = new ProductController($dbController);

    // Fetches the product details
    $product = $productController->get_product_by_id($product_id);

    if (!$product) {
        echo '<p>Product not found.</p>';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Gets the updated details from the form
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_POST['image']; // Ideally, you should handle file uploads and store the image properly

        // Updates the product details
        $productController->update_product($product_id, $name, $description, $price, $image);

        // Redirects back to the view products page
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
        <h1>Edit Product</h1>
        <form method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>"><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"><?php echo htmlspecialchars($product['description']); ?></textarea><br><br>
            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>"><br><br>
            <label for="image">Image URL:</label><br>
            <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($product['image']); ?>"><br><br>
            <input type="submit" value="Save">
        </form>
    </div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
