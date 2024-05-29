<?php 
// Start the session
session_start();

require_once 'inc/functions.php';
require_once 'classes/DatabaseController.php';
require_once 'classes/ReviewController.php'; // Ensure this file contains the necessary code to establish a DB connection

// Access the cookie
$cookieName = 'user_session';
if (isset($_COOKIE[$cookieName])) {
    $userSessionToken = $_COOKIE[$cookieName];
    // Validate the session or retrieve user data from the database if needed
    echo "User session token from cookie: " . htmlspecialchars($userSessionToken);
}

// Access the session
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userId = $user['id']; // Assumes 'id' is the user's unique identifier
} else {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

// Signs into the database controller with the required arguments
$dbController = new DatabaseController($dsn, $username, $password);
// Instantiates the Review controller
$reviewController = new ReviewController($dbController);

// Call the function to retrieve the rows
$rows = $reviewController->get_Review_by_Userid($userId);

$title = 'Member Page'; 
require __DIR__ . "/inc/header.php"; 
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">

<a href="member.php"><button type="button">Back</button></a>

<h1>View Your Reviews</h1>

<a href="C-AddReview.php"><button type="button">Add Review</button></a>

<?php if (is_array($rows) && !empty($rows)){
        foreach ($rows as $row){
            echo '<table>';
            echo '<tr><th>Content</th><th>Stars</th></tr>';
            echo '<td>' . htmlspecialchars($row['Content']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Stars']) . '/5</td>';
            echo '<td><a href="EditReview.php?id=' . htmlspecialchars($row['Id']) . '"><button type="button">Edit</button></a></td>';
            echo '<td><a href="ConfirmdeleteReview.php?id=' . htmlspecialchars($row['Id']) . '"><button type="button">Delete</button></a></td>';
            echo '</tr>';
            echo '</table>';
        }
    } else {
            echo '<p>No Reviews found.</p>';
        }
?>

    </div>
</section>
<?php require __DIR__ . "/inc/footer.php"; ?>
