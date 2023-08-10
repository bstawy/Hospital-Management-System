<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.js" integrity="sha256-dWvV84T6BhzO4vG6gWhsWVKVoa4lVmLnpBOZh/CAHU4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></script>
    <script src="https://kit.fontawesome.com/9319e3ca6a.js" crossorigin="anonymous"></script>
    <style>
      .navbar-nav{  /* align nav-items to left */
        margin-left: auto;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
      <h5 class="text-white" style="margin-left: 2%;"><a href="index.php" class="nav-link text-white">Hospital Management System</a></h5>
      <div class="mr-auto"></div>
      <ul class="navbar-nav ml-auto">
        <?php
          if(isset($_SESSION['admin'])) {
            $user = $_SESSION['admin'];
            echo '
              <li class="nav-item"><a href="index.php" class="nav-link text-white">'.$user.'</a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link text-white">logout</a></li>';
          } else if(isset($_SESSION['doctor'])){
            $user = $_SESSION['doctor'];
            echo '
              <li class="nav-item"><a href="index.php" class="nav-link text-white">'.$user.'</a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link text-white">logout</a></li>';
          }else if(isset($_SESSION['patient'])){
            $user = $_SESSION['patient'];
            echo '
              <li class="nav-item"><a href="index.php" class="nav-link text-white">'.$user.'</a></li>
              <li class="nav-item"><a href="logout.php" class="nav-link text-white">logout</a></li>';
          } else {
            echo '
              <li class="nav-item"><a href="adminlogin.php" class="nav-link text-white">Admin</a></li>
              <li class="nav-item"><a href="doctorlogin.php" class="nav-link text-white">Doctor</a></li>
              <li class="nav-item"><a href="patientlogin.php" class="nav-link text-white">Patient</a></li>';
          }
        ?>
      </ul>
    </nav>
  </body>
  </html>