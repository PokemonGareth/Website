<?php
session_start();

// Unsets all session variables
$_SESSION = array();

// Also deletes the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroys the session
session_destroy();

// Clears the user session cookie
$cookieName = 'user_session';
setcookie($cookieName, '', time() - 3600, '/');

// Redirects to the login page
header("Location: login.php");
exit();
?>