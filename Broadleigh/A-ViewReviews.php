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

    $title = 'Review Page'; 
    require __DIR__ . "/inc/header.php"; 
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">
        
<a href="member.php"><button type="button">Back</button></a>

<h1>View Reviews</h1>

<a href="AddReview.php"><button type="button">Add Review</button></a>


<?php
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Signs into the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiates the Review controller
    $ReviewController = new ReviewController($dbController);

    // Fetches all Reviews
    $Reviews = $ReviewController->get_all_Reviews();

    // Displays the Reviews in rows
    if (!empty($Reviews)) {
        echo '<table>';
        echo '<tr><th>ID</th><th>User Id</th><th>Content</th><th>Stars</th></tr>';
        foreach ($Reviews as $Review) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($Review['Id']) . '</td>';
            echo '<td>' . htmlspecialchars($Review['Userid']) . '</td>';
            echo '<td>' . htmlspecialchars($Review['Content']) . '</td>';
            echo '<td>' . htmlspecialchars($Review['Stars']) . '</td>';
            echo '<td><a href="EditReview.php?id=' . htmlspecialchars($Review['Id']) . '"><button type="button">Edit</button></a></td>';
            echo '<td><a href="ConfirmdeleteReview.php?id=' . htmlspecialchars($Review['Id']) . '"><button type="button">Delete</button></a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No Reviews found.</p>';
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
</div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>