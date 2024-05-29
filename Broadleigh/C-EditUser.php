<?php
// Starts the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/MemberController.php';

// Accesses the session
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userId = $user['id']; // Assumes 'id' is the user's unique identifier
} else {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

$title = 'Edit User'; 
require __DIR__ . "/inc/header.php"; 


$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    $dbController = new DatabaseController($dsn, $username, $password);
    $UserController = new MemberController($dbController);

    // Fetches the User details
    $User = $UserController->get_member_by_id($userId);

    if (!$User) {
        echo '<p>User not found.</p>';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Gets the updated details from the form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $IsAdmin = $_POST['IsAdmin'];

        // Updates the User details
        $UserController->update_member($userId, $firstname, $lastname, $email, $IsAdmin);

        // Redirect back to the view users page
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
        <h1>Edit User</h1>
        <form method="post">
            <label for="firstname">Firstname:</label><br>
            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($User['firstname']); ?>"><br><br>
            <label for="lastname">Lastname:</label><br>
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($User['lastname']); ?>"><br><br>
            <label for="email">Email:</label><br>
            <textarea id="email" name="email"><?php echo htmlspecialchars($User['email']); ?></textarea><br><br>
            <input type="text" id="IsAdmin" name="IsAdmin" value="0" hidden>
            <input type="submit" value="Save">
        </form>
    </div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
