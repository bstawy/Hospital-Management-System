<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Doctor's Dashboard</title>
  </head>
  <body>
    <?php
      include("../include/header.php");
      include("../include/connection.php");
      $doc = $_SESSION['doctor'];
    ?>
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-2" style="margin-left: -20px;">
            <?php include("sidenav.php");?>
          </div>
          <div class="col-md-10">
            <h4 class="my-2">Doctor's Dashboard</h4>
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
                    <?php
                      $doc = $_SESSION['doctor'];
                      $res = mysqli_query($connect,"SELECT id FROM doctor WHERE username='$doc'");
                      while ($row = mysqli_fetch_assoc($res)) {
                        $doc_id = $row['id'];
                      }
                      $pat = mysqli_query($connect,"SELECT COUNT(patient_id) FROM doc_treats_pat WHERE doctor_id='$doc_id'");
                      $row = mysqli_fetch_assoc($pat);
                      $pat_num = $row['COUNT(patient_id)'];
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
              <div class="col-md-3 bg-success mx-1" style="height: 130px;">
                <div class="row">
                  <div class="col">
                    <h5 class="my-2 text-white" style="font-size: 30px;">0</h5>
                  </div>
                  <div class="col" style="text-align: right;">
                  <a href="#"><i class="fa-solid fa-calendar fa-2xl my-3" style="color: white;"></i></a>
                  </div>
                </div>
                <div class="row">
                  <h5 class="text-white">Total</h5>
                  <h5 class="text-white">Appointments</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>