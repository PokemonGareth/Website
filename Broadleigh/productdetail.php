<?php 
// Starts the session at the beginning of your script
session_start();

require_once 'inc/functions.php';

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

    $title = 'Product Details'; 
    require __DIR__ . "/inc/header.php"; 
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <?php require __DIR__ . "/components/product-details.php"; ?>
      </div>
    </div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>