<?php
// Start the session
session_start();

require_once 'inc/functions.php';
require_once __DIR__ . '/classes/DatabaseController.php';
require_once __DIR__ . '/classes/MemberController.php';

// Access the session
if (!isset($_SESSION['user'])) {
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

$title = 'Edit User'; 
require __DIR__ . "/inc/header.php"; 

// Get the User ID from the URL
$User_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($User_id == 0) {
    echo '<p>Invalid User ID.</p>';
    exit;
}

$dsn = 'mysql:host=localhost;dbname=shop';
$username = 'root';
$password = '';

try {
    $dbController = new DatabaseController($dsn, $username, $password);
    $UserController = new MemberController($dbController);

    // Fetch the User details
    $User = $UserController->get_member_by_id($User_id);

    if (!$User) {
        echo '<p>User not found.</p>';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the updated details from the form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $IsAdmin = $_POST['IsAdmin'];

        // Update the User details
        $UserController->update_member($User_id, $firstname, $lastname, $email, $IsAdmin);

        // Redirect back to the User listing page
        header('Location: A-ViewUsers.php');
        exit;
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">
        <a href="A-ViewUsers.php"><button type="button">Back</button></a>
        <h1>Edit User</h1>
        <form method="post">
            <label for="firstname">Firstname:</label><br>
            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($User['firstname']); ?>"><br><br>
            <label for="lastname">Lastname:</label><br>
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($User['lastname']); ?>"><br><br>
            <label for="email">Email:</label><br>
            <textarea id="email" name="email"><?php echo htmlspecialchars($User['email']); ?></textarea><br><br>
            <label for="IsAdmin">IsAdmin (1/0):</label><br>
            <input type="text" id="IsAdmin" name="IsAdmin" value="<?php echo htmlspecialchars($User['IsAdmin']); ?>"><br><br>
            <input type="submit" value="Save">
        </form>
    </div>
</section>

<?php require __DIR__ . "/inc/footer.php"; ?>
