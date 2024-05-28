<?php 
// Starts the session
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

    $title = 'Member Page'; 
    require __DIR__ . "/inc/header.php"; 
?>

<a href="member.php"><button type="button">Back</button></a>

<h1>View Customer Reviews</h1>

<?php require __DIR__ . "/inc/footer.php"; ?>