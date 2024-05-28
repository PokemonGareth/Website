<?php
// Start the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/ReviewController.php';

if (!isset($_POST['id'])) {
    redirect('member.php', ["error" => "No Review ID provided"]);
}

$ReviewID = $_POST['id'];

// Define your DSN, username, and password
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Instantiate the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiate the Review controller
    $ReviewController = new ReviewController($dbController);

    // Delete the Review by ID
    $ReviewController->delete_Review($ReviewID);

    redirect('A-ViewReviews', ["success" => "Review deleted successfully"]);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
