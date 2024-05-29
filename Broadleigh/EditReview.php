<?php
// Starts the session
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/Broadleigh/inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ReviewController.php';

// Accesses the session
if (!isset($_SESSION['user'])) {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

$title = 'ADMIN - Edit Review'; 
require __DIR__ . "/inc/header.php"; 

// Gets the Review ID from the URL
$Review_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($Review_id == 0) {
    echo '<p>Invalid Review ID.</p>';
    exit;
}

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    $dbController = new DatabaseController($dsn, $username, $password);
    $ReviewController = new ReviewController($dbController);

    // Fetches the Review details
    $Review = $ReviewController->get_review_by_id($Review_id);

    if (!$Review) {
        echo '<p>Review not found.</p>';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Gets the updated details from the form
        $Userid = $_POST['Userid'];
        $Content = $_POST['Content'];
        $Stars = $_POST['Stars'];

        // Updates the Review details
        $ReviewController->update_Review($Review_id, $Userid, $Content, $Stars);

        // Redirect back to the view reviews page
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
        <h1>Edit Review</h1>
        <form method="post">
            <label for="Userid">User ID:</label><br>
            <input type="text" id="Userid" name="Userid" value="<?php echo htmlspecialchars($Review['Userid']); ?>"><br><br>
            <label for="Content">Content:</label><br>
            <textarea id="Content" name="Content"><?php echo htmlspecialchars($Review['Content']); ?></textarea><br><br>
            <label for="Stars">Stars 1-5:</label><br>
            <input type="text" id="Stars" name="Stars" value="<?php echo htmlspecialchars($Review['Stars']); ?>"><br><br>
            <input type="submit" value="Save">
        </form>
    </div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
