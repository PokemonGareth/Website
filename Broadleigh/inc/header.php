<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title> <?= $title ?? 'Welcome' ?> </title>
  </head>
  
  <body class="bg-primary">

  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">Broadleigh Gardens</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="./product.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./member.php">Members</a>
        </li>
        <li class="nav-item">
          <?php
          if (isset($_SESSION['user'])) {
            // User is logged in
            echo '<a class="nav-link" href="./logout.php"><i class="bi bi-box-arrow-right" style="font-size: 2rem"></i> Logout</a>';
          } else {
            // User is not logged in
            echo '<a class="nav-link" href="./login.php"><i class="bi bi-person-circle" style="font-size: 2rem"></i> Login</a>';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
