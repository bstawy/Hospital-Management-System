<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Dashboard</title>
  </head>
  <body>
    <?php
      include("../include/header.php");
      include("../include/connection.php");
    ?>
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-2" style="margin-left: -20px;">
            <?php include("sidenav.php");?>
          </div>
          <div class="col-md-10">
            <h4 class="my-2">Admin Dashboard</h4>
            <div class="row">
              <div class="col-md-3 bg-success mx-1" style="height: 130px;">
                <div class="row">
                  <div class="col">
                    <?php
                      $ad = mysqli_query($connect,"SELECT * FROM admin");
                      $ad_num = mysqli_num_rows($ad);
                    ?>
                    <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $ad_num; ?></h5>
                  </div>
                  <div class="col" style="text-align: right;">
                  <a href="admin.php"><i class="fa-solid fa-users-gear fa-2xl my-3" style="color: white;"></i></a>
                  </div>
                </div>
                <div class="row">
                  <h5 class="text-white">Total</h5>
                  <h5 class="text-white">Admins</h5>
                </div>
              </div>
              <div class="col-md-3 bg-info mx-1" style="height: 130px;">
                <div class="row">
                  <div class="col">
                    <?php
                      $doc = mysqli_query($connect,"SELECT * FROM doctor");
                      $doc_num = mysqli_num_rows($doc);
                    ?>
                    <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $doc_num; ?></h5>
                  </div>
                  <div class="col" style="text-align: right;">
                  <a href="doctor.php"><i class="fa-solid fa-user-doctor fa-2xl my-3" style="color: white;"></i></a>
                  </div>
                </div>
                <div class="row">
                  <h5 class="text-white">Total</h5>
                  <h5 class="text-white">Doctors</h5>
                </div>
              </div>
              <div class="col-md-3 bg-warning mx-1" style="height: 130px;">
                <div class="row">
                  <div class="col">
                    <?php
                      $pat = mysqli_query($connect,"SELECT * FROM patient");
                      $pat_num = mysqli_num_rows($pat);
                    ?>
                    <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $pat_num; ?></h5>
                  </div>
                  <div class="col" style="text-align: right;">
                  <a href="patient.php"><i class="fa-solid fa-bed-pulse fa-2xl my-3" style="color: white;"></i></a>
                  </div>
                </div>
                <div class="row">
                  <h5 class="text-white">Total</h5>
                  <h5 class="text-white">Patients</h5>
                </div>
              </div>
              <div class="col-md-3 bg-danger mx-1 my-2" style="height: 130px;">
              <div class="row">
                  <div class="col">
                  <?php
                      $nur = mysqli_query($connect,"SELECT * FROM nurse");
                      $nur_num = mysqli_num_rows($nur);
                    ?>
                    <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $nur_num; ?></h5>
                  </div>
                  <div class="col" style="text-align: right;">
                  <a href="#"><i class="fa-solid fa-user-nurse fa-2xl my-3" style="color: white;"></i></a>
                  </div>
                </div>
                <div class="row">
                  <h5 class="text-white">Total</h5>
                  <h5 class="text-white">Nurses</h5>
                </div>
              </div>
              <div class="col-md-3 bg-warning mx-1 my-2" style="height: 130px;">
              <div class="row">
                  <div class="col">
                    <?php
                      $ward = mysqli_query($connect,"SELECT * FROM ward_boy");
                      $ward_num = mysqli_num_rows($ward);
                    ?>
                    <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $ward_num; ?></h5>
                  </div>
                  <div class="col" style="text-align: right;">
                  <a href="#"><i class="fa-solid fa-person fa-2xl my-3" style="color: white;"></i></a>
                  </div>
                </div>
                <div class="row">
                  <h5 class="text-white">Total</h5>
                  <h5 class="text-white">Ward Boys</h5>
                </div>
              </div>
              <div class="col-md-3 bg-success mx-1 my-2" style="height: 130px;">
              <div class="row">
                  <div class="col">
                    <?php
                      $dep = mysqli_query($connect,"SELECT * FROM department");
                      $dep_num = mysqli_num_rows($dep);
                    ?>
                    <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $dep_num; ?></h5>
                  </div>
                  <div class="col" style="text-align: right;">
                  <a href="department.php"><i class="fa-solid fa-signs-post fa-2xl my-3" style="color: white;"></i></a>
                  </div>
                </div>
                <div class="row">
                  <h5 class="text-white">Total</h5>
                  <h5 class="text-white">Departments</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>