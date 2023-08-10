<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Doctors</title>
</head>
<body>
  <?php
  include("../include/header.php");
  ?>
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-2" style="margin-left: -20px;">
          <?php
          include("sidenav.php");
          include("../include/connection.php");
          ?>
        </div>
        <div class="col-md-10">
          <div class="col-md-12">
            <h5 class="text-center">My Doctors</h5>
              <?php
                $pat = $_SESSION['patient'];
                $query = mysqli_query($connect, "SELECT id FROM patient WHERE username='$pat'");
                $row = mysqli_fetch_array($query);
                $pat_id = $row['id'];
                $query = "SELECT * FROM doctor WHERE id IN (SELECT doctor_id FROM doc_treats_pat WHERE patient_id='$pat_id')";
                $res = mysqli_query($connect, $query);
                $output = "
                  <table class='table table-bordered'>
                  <tr>
                  <th>ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Specialism</th>
                  <th>Department</th>
                  <tr>";
                if (mysqli_num_rows($res) < 1) {
                  $output .= "<tr><td colspan='5' class='text-center'>No Doctors.</td></tr>";
                }
                while ($row = mysqli_fetch_array($res)) {
                  $id = $row['id'];
                  $fname = $row['fname'];
                  $lname = $row['lname'];
                  $specialism = $row['specialism'];
                  $dep_id = $row['dep_id'];
                  $query = mysqli_query($connect, "SELECT name FROM department WHERE id='$dep_id'");
                  $row = mysqli_fetch_array($query);
                  $dep_name = $row['name'];
                $output .= "
                  <tr>
                  <td>$id</td>
                  <td>$fname</td>
                  <td>$lname</td>
                  <td>$specialism</td>
                  <td>$dep_name</td>";
                }
                $output .= "
                  </tr>
                  </table>";

                echo $output;

              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>