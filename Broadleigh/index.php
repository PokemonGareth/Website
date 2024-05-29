<?php 
// Starts the session at the beginning of your script
session_start();

require_once 'inc/functions.php';

// Accesses the cookie
$cookieName = 'user_session';
if (isset($_COOKIE[$cookieName])) {
    $userSessionToken = $_COOKIE[$cookieName];
    // Token to validate the session or retrieve user data from the database if needed
    echo "User session token from cookie: " . htmlspecialchars($userSessionToken);
}

// Accesses the session
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    // Accesses user information stored in session
}

    $title = 'Home Page'; 
    require __DIR__ . "/inc/header.php"; 
?>

<section class="text-center">
    <div class="container py-5 h-75" style="background-color: #ffffff;">

<h1>Welcome to Broadleigh Gardens</h1>

<br>

    <h2>About Us</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus vitae congue mauris rhoncus aenean vel. Bibendum ut tristique et egestas quis ipsum suspendisse ultrices. Tincidunt tortor aliquam nulla facilisi. Eleifend donec pretium vulputate sapien nec sagittis aliquam malesuada. Eu volutpat odio facilisis mauris sit amet massa vitae tortor. Eu feugiat pretium nibh ipsum consequat nisl vel pretium. Odio facilisis mauris sit amet massa vitae tortor. Dignissim convallis aenean et tortor. Non diam phasellus vestibulum lorem sed risus ultricies tristique nulla. Praesent tristique magna sit amet purus gravida quis blandit turpis. Vel orci porta non pulvinar neque laoreet suspendisse. Scelerisque eu ultrices vitae auctor eu augue ut lectus arcu. Quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit. Facilisis mauris sit amet massa vitae tortor condimentum. Lorem ipsum dolor sit amet consectetur. Nisi est sit amet facilisis magna etiam tempor orci eu. Eros donec ac odio tempor orci dapibus ultrices in. Amet commodo nulla facilisi nullam vehicula ipsum a. Nisi vitae suscipit tellus mauris a diam maecenas sed.

Suscipit adipiscing bibendum est ultricies integer. Vel facilisis volutpat est velit egestas dui id ornare arcu. Interdum velit laoreet id donec ultrices tincidunt. Habitant morbi tristique senectus et netus et malesuada fames ac. Ut sem nulla pharetra diam sit amet nisl suscipit. Congue quisque egestas diam in. Hendrerit gravida rutrum quisque non tellus orci. A arcu cursus vitae congue mauris rhoncus aenean vel elit. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis. Neque gravida in fermentum et sollicitudin ac orci phasellus.</p>
    <br>
    <h2>Location</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Leo vel orci porta non pulvinar neque laoreet. Et netus et malesuada fames ac turpis. Diam vulputate ut pharetra sit amet aliquam id diam. Pharetra sit amet aliquam id diam maecenas ultricies mi eget. Aliquam malesuada bibendum arcu vitae elementum curabitur vitae nunc. Ac auctor augue mauris augue. Tortor id aliquet lectus proin nibh nisl condimentum id. Eu mi bibendum neque egestas. Ut faucibus pulvinar elementum integer enim neque. Eu scelerisque felis imperdiet proin fermentum leo vel orci. Sed blandit libero volutpat sed cras. Elementum sagittis vitae et leo. Integer eget aliquet nibh praesent tristique magna sit. Nam libero justo laoreet sit. Semper eget duis at tellus. Quis varius quam quisque id diam. Eu tincidunt tortor aliquam nulla.</p>
    <br>
    <h2>Top 4 Products</h2>
      <div class="row d-flex justify-content-center align-items-center h-100" style="background-color: #F4F3F3; padding: 20px; margin: 20px; border-radius: 20px;">
        <?php require __DIR__ . "/components/Top-products.php"; ?>
      </div>
    </div>
</section>  

<?php require __DIR__ . "/inc/footer.php"; ?>