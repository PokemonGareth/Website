<?php 
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ProductController.php';

// Accesses the cookie
$cookieName = 'user_session';
if (isset($_COOKIE[$cookieName])) {
    $userSessionToken = $_COOKIE[$cookieName];
    // Token to validate the session or retrieve user data from the database if needed
    echo "User session token from cookie: " . htmlspecialchars($userSessionToken);
}

// Accesses the session
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    // Accesses user information stored in session
}

$title = 'Search Products Page'; 
require __DIR__ . "/inc/header.php"; 
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">

<a href="product.php"><button type="button">Back</button></a>

<h1>Search Products</h1>

<input type="text" id="searchInput" placeholder="Search for products..." style="margin-bottom: 20px; padding: 10px; width: 80%;">
<button type="button" onclick="searchProducts()" style="padding: 10px 20px;">Search</button>

<div id="productTable">
<?php
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    $dbController = new DatabaseController($dsn, $username, $password);
    $productController = new ProductController($dbController);

    $products = $productController->get_all_products();

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
</div>
</div>
</section>
<?php require __DIR__ . "/inc/footer.php"; ?>
<script>
function searchProducts() {
    var input = document.getElementById('searchInput').value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'search_products.php?search=' + encodeURIComponent(input), true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('productTable').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
</script>
