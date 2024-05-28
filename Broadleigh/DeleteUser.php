<?php
// Starts the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/MemberController.php';

if (!isset($_POST['id'])) {
    redirect('member.php', ["error" => "No User ID provided"]);
}

$UserID = $_POST['id'];

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Signs into the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiates the User controller
    $MemberController = new MemberController($dbController);

    // Deletes the User by ID
    $MemberController->delete_member($UserID);

    redirect('A-ViewUsers', ["success" => "User deleted successfully"]);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
