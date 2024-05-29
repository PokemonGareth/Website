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
} else {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

    $title = 'Account'; 
    require __DIR__ . "/inc/header.php"; 
?>

<section class="vh-100 text-center">
<a href="logout.php"><button type="button">Logout</button></a>
    <div class="container py-5 h-75">

<h1>Welcome <?= $_SESSION['user']['firstname'] ?? 'Member' ?>!</h1>


<?php // Checks if the user is logged in and has the admin role
if (isset($_SESSION['user']) && $_SESSION['user']['IsAdmin'] === '1') {
    // User is logged in and is an admin
    echo '<a href="A-ViewReviews.php"><button type="button">View Reviews</button></a>';
    echo '<a href="A-ViewUsers.php"><button type="button">View Users</button></a>';
    echo '<a href="A-ViewProducts.php"><button type="button">View Products</button></a>';
} else {
    // User is NOT logged in and is an admin
    echo '<a href="C-ViewReviews.php"><button type="button">View Reviews</button></a>';
    echo '<a href="C-EditUser.php"><button type="button">Edit Account</button></a>';
}
?>
</div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>