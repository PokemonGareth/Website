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

// Call the function to retrieve the row
$row = $reviewController->get_Review_by_Userid($userId);

// Check if row is not empty before accessing its elements
if (!empty($row)) {
    // Store the values received from the function into a list
    $review = array(
        'userId' => $row['Userid'],
        'content' => $row['content'],
        'stars' => $row['Stars']
    );
}

$title = 'Member Page'; 
require __DIR__ . "/inc/header.php"; 
?>

<a href="member.php"><button type="button">Back</button></a>

<h1>View Your Reviews</h1>

<?php if (!empty($review)): ?>
    <ul>
        <li>
            <h2><?php echo htmlspecialchars($review['userId']); ?></h2>
            <p><?php echo htmlspecialchars($review['content']); ?></p>
            <p><strong>Stars:</strong> <?php echo htmlspecialchars($review['stars']); ?>/5</p>
            <td><a href="EditReview.php?id=<?php echo htmlspecialchars($review['userId']); ?>"><button type="button">Edit</button></a></td>
            <td><a href="ConfirmdeleteReview.php?id=<?php echo htmlspecialchars($review['userId']); ?>"><button type="button">Delete</button></a></td>
        </li>
    </ul>
<?php else: ?>
    <p>No reviews found for this user.</p>
<?php endif; ?>

<?php require __DIR__ . "/inc/footer.php"; ?>
