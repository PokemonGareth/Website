<?php 
// Start the session at the beginning of your script
session_start();

require_once 'inc/functions.php';

// Access the cookie
$cookieName = 'user_session';
if (isset($_COOKIE[$cookieName])) {
    $userSessionToken = $_COOKIE[$cookieName];
    // You can use this token to validate the session or retrieve user data from the database if needed
    echo "User session token from cookie: " . htmlspecialchars($userSessionToken);
}

// Access the session
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    // Access user information stored in session
} else {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

    $title = 'Member Page'; 
    require __DIR__ . "/inc/header.php"; 
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">
        
<a href="member.php"><button type="button">Back</button></a>

<h1>View Users</h1>

<?php
// Define your DSN, username, and password
$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    // Instantiate the database controller with the required arguments
    $dbController = new DatabaseController($dsn, $username, $password);
    // Instantiate the member controller
    $memberController = new MemberController($dbController);

    // Fetch all members
    $members = $memberController->get_all_members();

    // Display the members
    if (!empty($members)) {
        echo '<table>';
        echo '<tr><th>ID</th><th>firstname</th><th>lastname</th><th>email</th><th>createdOn</th><th>modifiedOn</th><th>IsAdmin(1/0)</th></tr>';
        foreach ($members as $member) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($member['id']) . '</td>';
            echo '<td>' . htmlspecialchars($member['firstname']) . '</td>';
            echo '<td>' . htmlspecialchars($member['lastname']) . '</td>';
            echo '<td>' . htmlspecialchars($member['email']) . '</td>';
            echo '<td>' . htmlspecialchars($member['createdOn']) . '</td>';
            echo '<td>' . htmlspecialchars($member['modifiedOn']) . '</td>';
            echo '<td>' . htmlspecialchars($member['IsAdmin']) . '</td>';
            echo '<td><a href="ConfirmdeleteUser.php?id=' . htmlspecialchars($member['id']) . '"><button type="button">Delete</button></a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No Users found.</p>';
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
</div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>