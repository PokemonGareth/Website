<?php 
// Start the session at the beginning of your script
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ProductController.php';

// Access the cookie
$cookieName = 'user_session';
if (isset($_COOKIE[$cookieName])) {
    $userSessionToken = $_COOKIE[$cookieName];
    // You can use this token to validate the session or retrieve user data from the database if needed
    echo "User session token from cookie: " . htmlspecialchars($userSessionToken);
}

// Access the session
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    // Access user information stored in session
} else {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

$title = 'Member Page'; 
require __DIR__ . "/inc/header.php"; 
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">

<a href="member.php"><button type="button">Back</button></a>

<h1>View Products</h1>

<?php
// Define your DSN, username, and password
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Instantiate the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiate the product controller
    $productController = new ProductController($dbController);

    // Fetch all products
    $products = $productController->get_all_products();

    // Display the products
    if (!empty($products)) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Image</th></tr>';
        foreach ($products as $product) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product['id']) . '</td>';
            echo '<td>' . htmlspecialchars($product['name']) . '</td>';
            echo '<td>' . htmlspecialchars($product['description']) . '</td>';
            echo '<td>' . htmlspecialchars($product['price']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($product['image']) . '" alt="Product Image" style="width:50px;height:50px;"></td>';
            echo '<td><a href="ConfirmdeleteProduct.php?id=' . htmlspecialchars($product['id']) . '"><button type="button">Delete</button></a></td>';
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
</div>
</section>
<?php require __DIR__ . "/inc/footer.php"; ?>
