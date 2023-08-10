<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Patients</title>
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
              <div class="row my-3">
                <div class="col-md-12">
                  <h5 class="text-center">All Patients</h5>
                  <?php
                    $doc = $_SESSION['admin'];
                    $query = "SELECT * FROM patient";
                    $res = mysqli_query($connect,$query);
                    $output="
                      <table class='table table-bordered'>
                        <tr>
                          <th>ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Age</th>
                          <th>Gender</th>
                          <th>Phone</th>
                          <th>City</th>
                          <th>Street</th>
                          <th>Department</th>
                          <th>Room number</th>
                          <th style='width: 10%'>Action</th>
                        <tr>";

                    if(mysqli_num_rows($res) < 1) {
                      $output .= "<tr><td colspan='11' class='text-center'>No Patients.</td></tr>";
                    }
                    while($row = mysqli_fetch_array($res)){
                      $id = $row['id'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
                      $age = $row['age'];
                      $gender = $row['gender'];
                      $phone = $row['phone'];
                      $city = $row['city'];
                      $street = $row['street'];
                      $dep_id = $row['dep_id'];
                      $room_num = $row['room_number'];
                      $output .="
                        <tr>
                          <td>$id</td>
                          <td>$fname</td>
                          <td>$lname</td>
                          <td>$age</td>
                          <td>$gender</td>
                          <td>$phone</td>
                          <td>$city</td>
                          <td>$street</td>
                          <td>$dep_id</td>
                          <td>$room_num</td>

                          <td><a href='patient?id=$id'>
                            <button id='$id' class='btn btn-danger'>Remove</button>
                          </a></td>";
                    }
                    $output .="
                      </tr>
                      </table>";
                    
                    echo $output;

                    if(isset($_GET['id'])) {
                      $id=$_GET['id'];

                      $query = "DELETE FROM patient WHERE id='$id'";
                      mysqli_query($connect,$query);
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
