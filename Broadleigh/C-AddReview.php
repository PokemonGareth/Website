<?php
// Starts the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ReviewController.php';

// Access the session
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userId = $user['id']; // Assumes 'id' is the user's unique identifier
} else {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

$title = 'Add Review'; 
require __DIR__ . "/inc/header.php"; 

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    $dbController = new DatabaseController($dsn, $username, $password);
    $reviewController = new ReviewController($dbController);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Gets the details from the form
        $Userid = $_POST['Userid'];
        $Content = $_POST['Content'];
        $Stars = $_POST['Stars'];

        // Adds the Review to the database
        $ReviewDetails = [
            'Userid' => $Userid,
            'Content' => $Content,
            'Stars' => $Stars
        ];
        $reviewController->create_Review($ReviewDetails);

        // Redirects back to the view reviews page
        header('Location: member.php');
        exit;
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">
        <a href="member.php"><button type="button">Back</button></a>
        <h1>Add Review</h1>
        <form method="post">
            <input type="hidden" id="Userid" name="Userid" value="<?php echo htmlspecialchars($userId); ?>" required>
            <label for="Content">Content:</label><br>
            <textarea id="Content" name="Content" required></textarea><br><br>
            <label for="Stars">Stars:</label><br>
            <input type="text" id="Stars" name="Stars" required><br><br>
            <input type="submit" value="Add Review">
        </form>
    </div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
