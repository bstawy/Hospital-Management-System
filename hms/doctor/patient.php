<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Patients</title>
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
            <h5 class="text-center">My Patients</h5>
              <?php
                $doc = $_SESSION['doctor'];
                $query = mysqli_query($connect, "SELECT id FROM doctor WHERE username='$doc'");
                $row = mysqli_fetch_array($query);
                $doc_id = $row['id'];
                $query = "SELECT * FROM patient WHERE id IN (SELECT patient_id FROM doc_treats_pat WHERE doctor_id='$doc_id')";
                $res = mysqli_query($connect, $query);
                $output = "
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
                  <th>Disease</th>
                  <th>Treatment</th>
                  <th style='width: 10%'>Action</th>
                  <tr>";
                if (mysqli_num_rows($res) < 1) {
                  $output .= "<tr><td colspan='13' class='text-center'>No Patients.</td></tr>";
                }
                while ($row = mysqli_fetch_array($res)) {
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
                  $query = "SELECT name FROM department WHERE id='$dep_id'";
                  $result = mysqli_query($connect, $query);
                  $row2 = mysqli_fetch_array($result);
                  $dep_name = $row2['name'];
                  $query = "SELECT * FROM disease WHERE patient_id='$id'";
                  $res = mysqli_query($connect, $query);
                  while ($row = mysqli_fetch_array($res)) {
                    $disease = $row['disease'];
                    $treatment = $row['treatment'];
                  }
                $output .= "
                  <tr>
                  <td>$id</td>
                  <td>$fname</td>
                  <td>$lname</td>
                  <td>$age</td>
                  <td>$gender</td>
                  <td>$phone</td>
                  <td>$city</td>
                  <td>$street</td>
                  <td>$dep_name</td>
                  <td>$room_num</td>
                  <td>$disease</td>
                  <td>$treatment</td>
                  <td><a href='patient?id=$id'>
                    <button id='$id' class='btn btn-danger'>Remove</button>
                  </a></td>";
                }
                $output .= "
                  </tr>
                  </table>";

                echo $output;

                if (isset($_GET['id'])) {
                  $id = $_GET['id'];
                  $query = "DELETE FROM doc_treats_pat WHERE patient_id='$id'";
                  mysqli_query($connect, $query);
                  $query = "UPDATE patient SET dep_id=0, room_number=0";
                  mysqli_query($connect, $query);
                }
              ?>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <?php
                    if (isset($_POST['insert'])) {
                      $id = $_POST['id'];
                      $dep_name = $_POST['dep_name'];
                      $room_num = $_POST['room_number'];
                      $disease = $_POST['disease'];
                      $treatment = $_POST['treatment'];

                      $error = array();

                      $query_2 = "SELECT * FROM department WHERE name='$dep_name'";
                      $r = mysqli_query($connect, $query_2);
                      if (mysqli_num_rows($r) < 1) {
                        $error['n'] = "Department is not exist";
                      } else {
                        $query = "SELECT * FROM department WHERE name='$dep_name'";
                        $res = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($res);
                        $dep_id = $row['id'];
                      }

                      if (empty($id)) {
                        $error['n'] = "Enter patient's id";
                      } else if (empty($dep_name)) {
                        $error['n'] = "Enter patient's department";
                      } else if (empty($room_num)) {
                        $error['n'] = "Enter patient's room";
                      } else if (empty($disease)) {
                        $error['n'] = "Enter patient's disease";
                      }


                      if (count($error) == 0) {
                        $q = "UPDATE patient SET dep_id='$dep_id', room_number='$room_num'";
                        $_result = mysqli_query($connect, $q);
                        $q = "INSERT INTO disease (patient_id, disease, treatment) VALUES ('$id', '$disease', '$treatment')";
                        $_result = mysqli_query($connect, $q);
                        $q = "INSERT INTO doc_treats_pat (doctor_id, patient_id) VALUES ('$doc_id', '$id')";
                        $_result = mysqli_query($connect, $q);
                      }
                    }

                    if (isset($error['n'])) {
                      $er = $error['n'];

                      $show = "<h6 class='text-center alert alert-danger'>$er</h6>";
                    } else {
                      $show = "";
                    }
                  ?>
                  <?php
                    if (isset($_POST['update'])) {
                      $id = $_POST['id'];
                      $dep_name = $_POST['dep_name'];
                      $room_num = $_POST['room_number'];
                      $disease = $_POST['disease'];
                      $treatment = $_POST['treatment'];

                      $error = array();

                      $query_2 = "SELECT * FROM department WHERE name={$dep_name}";
                      $r = mysqli_query($connect, $query_2);
                      if (mysqli_num_rows($r) == 0) {
                        $error['n'] = "Department is not exist";
                      } else {
                        $query = mysqli_query($connect, "SELECT id FROM department WHERE name='$dep_name'");
                        $row = mysqli_fetch_array($query);
                        $dep_id = $row['id'];
                      }

                      if (empty($id)) {
                        $error['n'] = "Enter patient's id";
                      } else if (empty($dep_id)) {
                        $error['n'] = "Enter patient's department";
                      } else if (empty($room_num)) {
                        $error['n'] = "Enter patient's room";
                      } else if (empty($disease)) {
                        $error['n'] = "Enter patient's disease";
                      } 

                      if (count($error) == 0) {
                        $q = "UPDATE patient SET dep_id='$dep_id', room_number='$room_num'";
                        $_result = mysqli_query($connect, $q);
                        $q = "INSERT INTO disease (patient_id, disease, treatment) VALUES ('$id', '$disease', '$treatment')";
                        $_result = mysqli_query($connect, $q);
                      }
                    }

                    if (isset($error['n'])) {
                      $er = $error['n'];

                      $show = "<h6 class='text-center alert alert-danger'>$er</h6>";
                    } else {
                      $show = "";
                    }
                  ?>
                  <h5 class="text-center">Add or Update patient</h5>
                  <form method="post" enctype="multipart/form-data">
                    <div>
                      <?php echo $show; ?>
                    </div>
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" name="id" class="form-control" autocomplete="off" placeholder="Enter patient's ID" value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>">
                    </div>
                    <div style="margin-top: 10px;"></div>
                    <div class="form-group">
                      <label>Department</label>
                      <input type="text" name="dep_name" class="form-control" autocomplete="off" placeholder="Enter patient's department" value="<?php if (isset($_POST['dep_id'])) echo $_POST['dep_id']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Room Number</label>
                      <input type="text" name="room_number" class="form-control" placeholder="Enter Room number" value="<?php if (isset($_POST['room_number'])) echo $_POST['room_number']; ?>">
                    </div>
                    <div style="margin-top: 10px;"></div>
                    <div class="form-group">
                      <label>Disease</label>
                      <input type="text" name="disease" class="form-control" autocomplete="off" placeholder="Enter Disease" value="<?php if (isset($_POST['disease'])) echo $_POST['disease']; ?>">
                    </div>
                    <div style="margin-top: 10px;"></div>
                    <div class="form-group">
                      <label>Treatment</label>
                      <input type="text" name="treatment" class="form-control" placeholder="Enter Treatment" value="<?php if (isset($_POST['treatment'])) echo $_POST['treatment']; ?>">
                    </div>
                    <div style="margin-top: 10px;"></div><br>
                    <input type="submit" name="insert" value="Insert" class="btn btn-success">
                    <input type="submit" name="update" value="Update" class="btn btn-success">
                  </form>
                  </div>
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