<?php
session_start();
session_unset(); 

require_once './inc/functions.php';

$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$email = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = InputProcessor::processEmail($_POST['email']);
    $password = InputProcessor::processPassword($_POST['password']);

    $valid = $email['valid'] && $password['valid'];

    if ($valid) {
        $member = $controllers->members()->login_member($email['value'], $password['value']);

        if (!$member) {
            $message = "User details are incorrect.";
        } else {
            // Set a cookie for the user
            $cookieName = 'user_session';
            $cookieValue = $member['session_token']; // Assuming you have a session token
            $cookieExpire = time() + (86400 * 30); // Cookie expires in 30 days
            setcookie($cookieName, $cookieValue, [
              'expires' => $cookieExpire,
              'path' => '/',
              'domain' => '', // Set your domain
              'secure' => true, // Ensure the cookie is sent over HTTPS
              'httponly' => true, // Prevent JavaScript access
              'samesite' => 'Lax' // Adjust according to your CSRF protection strategy
          ]);

            $_SESSION['user'] = $member; 
            redirect('member');
        }
    } else {
        $message = "Please fix the above errors.";
    }
}

// On other pages, you can check for the cookie like this:
if (isset($_COOKIE['user_session'])) {
    $sessionToken = $_COOKIE['user_session'];
    // Validate the session token against the database
    $user = $controllers->members()->validate_session($sessionToken);
    if ($user) {
        $_SESSION['user'] = $user;
    } else {
        // Invalid session token, handle accordingly
    }
}
?>

<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
  
              <h3 class="mb-2">Sign in</h3>
              <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required value="<?= htmlspecialchars($email['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $email['error'] ?? '' ?></span>
                </div>
  
              <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required value="<?= htmlspecialchars($password['value'] ?? '') ?>"/>
                  <span class="text-danger"><?= $password['error'] ?? '' ?></span>
                </div>
  
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Login</button>
              <a class="btn btn-secondary btn-lg w-100" type="submit" href="./register.php" >Not got an account?</a>
              
              <?php if ($message): ?>
                <div class="alert alert-danger mt-4" role="alert">
                  <?= $message ?? '' ?>
                </div>
              <?php endif ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>