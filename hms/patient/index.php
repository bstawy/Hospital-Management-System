<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Patient's Dashboard</title>
  </head>
  <body>
    <?php
      include("../include/header.php");
      include("../include/connection.php");
      $pat = $_SESSION['patient'];
    ?>
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-2" style="margin-left: -20px;">
            <?php include("sidenav.php");?>
          </div>
          <div class="col-md-10">
            <h4 class="my-2">Patient's Dashboard</h4>
            <div class="row">
              <div class="col-md-3 bg-info mx-1" style="height: 130px;">
                <div class="row">
                  <div class="col">
                    <h5 class="my-4 text-white">My<br>Profile</h5>
                  </div>
                  <div class="col" style="text-align: right;">
                  <a href="profile.php"><i class="fa-solid fa-user-circle fa-2xl my-4 mx-2" style="color: white;"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 bg-warning mx-1" style="height: 130px;">
                <div class="row">
                  <div class="col">
                    <h5 class="my-4 text-white">My<br>Doctors</h5>
                  </div>
                  <div class="col" style="text-align: right;">
                  <a href="doctor.php"><i class="fa-solid fa-users fa-2xl my-4 mx-2" style="color: white;"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>