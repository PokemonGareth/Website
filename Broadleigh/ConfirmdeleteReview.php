<?php
// Starts the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ReviewController.php';

if (!isset($_GET['id'])) {
    redirect('member', ["error" => "No Review ID provided"]);
}

$ReviewID = $_GET['id'];

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Signs into the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiates the Review controller
    $ReviewController = new ReviewController($dbController);

    // Fetches the Review by ID
    $Review = $ReviewController->get_Review_by_id($ReviewID);

    if (!$Review) {
        redirect('member', ["error" => "Review not found"]);
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$title = 'Confirm Delete'; 
require __DIR__ . "/inc/header.php"; 
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">

<a href="member.php"><button type="button">Back</button></a>

<h1>Confirm Deletion</h1>

<p>Are you sure you want to delete this Review?</p>

<table>
    <tr><th>ID</th><td><?php echo htmlspecialchars($Review['Id']); ?></td></tr>
    <tr><th>User ID</th><td><?php echo htmlspecialchars($Review['Userid']); ?></td></tr>
    <tr><th>Content</th><td><?php echo htmlspecialchars($Review['Content']); ?></td></tr>
    <tr><th>Stars</th><td><?php echo htmlspecialchars($Review['Stars']); ?></td></tr>
</table>

<form method="post" action="DeleteReview.php">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($Review['Id']); ?>">
    <button type="submit">Delete</button>
</form>
<a href="A-ViewReviews.php"><button type="button">Cancel</button></a>

</div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
