<?php
// Start the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/MemberController.php';

if (!isset($_GET['id'])) {
    redirect('member.php', ["error" => "No User ID provided"]);
}

$memberID = $_GET['id'];

// Define your DSN, username, and password
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Instantiate the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiate the Member controller
    $memberController = new MemberController($dbController);

    // Fetch the User by ID
    $User = $memberController->get_member_by_id($memberID);

    if (!$User) {
        redirect('member.php', ["error" => "member not found"]);
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

<p>Are you sure you want to delete this User?</p>

<table>
    <tr><th>ID</th><td><?php echo htmlspecialchars($User['id']); ?></td></tr>
    <tr><th>Firstname</th><td><?php echo htmlspecialchars($User['firstname']); ?></td></tr>
    <tr><th>Lastname</th><td><?php echo htmlspecialchars($User['lastname']); ?></td></tr>
    <tr><th>Email</th><td><?php echo htmlspecialchars($User['email']); ?></td></tr>
    <tr><th>Created Date</th><td><?php echo htmlspecialchars($User['createdOn']); ?></td></tr>
    <tr><th>Last Modified</th><td><?php echo htmlspecialchars($User['modifiedOn']); ?></td></tr>
    <tr><th>Admin?</th><td><?php echo htmlspecialchars($User['IsAdmin']); ?></td></tr>
</table>

<form method="post" action="DeleteUser.php">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($User['id']); ?>">
    <button type="submit">Delete</button>
</form>
<a href="A-ViewUsers.php"><button type="button">Cancel</button></a>

</div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
