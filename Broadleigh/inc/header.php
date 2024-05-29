<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title> <?= $title ?? 'Welcome' ?> </title>
    <style>
      /* Center the table on the page */
      table {
        margin: 0 auto; /* Center the table horizontally */
        text-align: center; /* Center align text within table cells */
        border-collapse: collapse; /* Collapse borders into a single border */
      }
      
      /* Add borders to table, table rows, and table cells */
      table, th, td {
        border: 1px solid black;
      }

      /* Optionally add some padding for table cells */
      th, td {
        padding: 10px; /* Adjust as needed */
      }

      /* Specific styles for tables to exclude */
      .no-style {
        margin: 0; /* Reset margin */
        text-align: left; /* Reset text alignment */
        border: none; /* Remove borders */
      }

      .no-style th, .no-style td {
        border: none; /* Remove borders from cells */
      }

      button {
          background-color: #74785F; /* Change button background color */
          color: #fff;               /* Change button text color */
          padding: 10px 20px;        /* Adjust padding */
          border: none;              /* Remove border */
          border-radius: 5px;        /* Add rounded corners */
          cursor: pointer;           /* Change cursor to pointer */
          transition: background-color 0.3s ease; /* Smooth transition for hover effect */
      }

      button:hover {
          background-color: #5a6268; /* Darken background color on hover */
          color: #f8f9fa;            /* Lighten text color on hover */
      }
    </style>
  </head>
  
  <!--<body style="background-image: url('../images/background_Image/FLOWERBG.jpg'); background-repeat: repeat; background-size: 400px;">-->
  <body style="background-color: #A6FCC7;">

  <nav class="navbar navbar-expand-lg" style="background-color: #9BB895; color: #ffffff;">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php" style="color: #ffffff;">Broadleigh Gardens</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="./product.php" style="color: #ffffff;">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./member.php" style="color: #ffffff;">Members</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <?php
          if (isset($_SESSION['user'])) {
            // User is logged in
            echo '<a class="nav-link" href="./logout.php" style="color: #ffffff;"><i class="bi bi-box-arrow-right" style="font-size: 2rem; color: #ffffff;"></i> Logout</a>';
          } else {
            // User is not logged in
            echo '<a class="nav-link" href="./login.php" style="color: #ffffff;"><i class="bi bi-person-circle" style="font-size: 2rem; color: #ffffff;"></i> Login</a>';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="SiteBanner">
<img src="images/Important_Images/Garden.jpg" alt="Garden" style="width: 100%; height: auto;">
        </div>
