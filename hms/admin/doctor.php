<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Doctors</title>
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
                <div class="col-md-9">
                  <h5 class="text-center">All Doctors</h5>
                  <?php
                    $doc = $_SESSION['admin'];
                    $query = "SELECT * FROM doctor";
                    $res = mysqli_query($connect,$query);
                    $output="
                      <table class='table table-bordered'>
                        <tr>
                          <th>ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Phone</th>
                          <th>Specialism</th>
                          <th>City</th>
                          <th>Street</th>
                          <th>Department</th>
                          <th style='width: 10%'>Action</th>
                        <tr>";

                    if(mysqli_num_rows($res) < 1) {
                      $output .= "<tr><td colspan='9' class='text-center'>No Doctors.</td></tr>";
                    }
                    while($row = mysqli_fetch_array($res)){
                      $id = $row['id'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
                      $phone = $row['phone'];
                      $city = $row['city'];
                      $street = $row['street'];
                      $specialism = $row['specialism'];
                      $dep_id = $row['dep_id'];
                      $query = "SELECT name FROM department WHERE id=$dep_id";
                      $result = mysqli_query($connect, $query);
                      $row2 = mysqli_fetch_array($result);
                      $dep_name = $row2['name'];
                      $output .="
                        <tr>
                          <td>$id</td>
                          <td>$fname</td>
                          <td>$lname</td>
                          <td>$phone</td>
                          <td>$specialism</td>
                          <td>$city</td>
                          <td>$street</td>
                          <td>$dep_name</td>
                          <td><a href='doctor?id=$id'>
                            <button id='$id' class='btn btn-danger'>Remove</button>
                          </a></td>";
                    }
                    $output .="
                      </tr>
                      </table>";
                    
                    echo $output;

                    if(isset($_GET['id'])) {
                      $id=$_GET['id'];

                      $query = "DELETE FROM doc_treats_pat WHERE doctor_id='$id'";
                      mysqli_query($connect,$query);
                      $query = "DELETE FROM doctor WHERE id='$id'";
                      mysqli_query($connect,$query);
                    }
                  ?>
                </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
