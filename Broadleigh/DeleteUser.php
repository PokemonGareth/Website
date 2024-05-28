<?php
// Start the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/MemberController.php';

if (!isset($_POST['id'])) {
    redirect('member.php', ["error" => "No User ID provided"]);
}

$UserID = $_POST['id'];

// Define your DSN, username, and password
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Instantiate the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiate the User controller
    $MemberController = new MemberController($dbController);

    // Delete the User by ID
    $MemberController->delete_member($UserID);

    redirect('A-ViewUsers', ["success" => "User deleted successfully"]);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
