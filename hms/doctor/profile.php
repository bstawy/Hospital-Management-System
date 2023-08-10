<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Profile</title>
  </head>
  <body>
    <?php 
      include("../include/header.php");
      include("../include/connection.php");

      $doc = $_SESSION['doctor'];
      $query = "SELECT * FROM doctor WHERE username='$doc'";
      $res = mysqli_query($connect,$query);

      while($row = mysqli_fetch_array($res)) {
        $username = $row['username'];
      }
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
                <h5 class="text-center">Update doctor's credentials</h5>
                <br><br>
                <div class="col-md-6">
                  <h5 class="text-center">My information</h5>
                  <?php
                    $doc = $_SESSION['doctor'];
                    $query = "SELECT * FROM doctor WHERE username = '$doc'";
                    $res = mysqli_query($connect,$query);
                    $row = mysqli_fetch_array($res);
                  ?>
                  <div>
                    <table class='table table-bordered'>
                      <tr>
                        <td>ID</td>
                        <td><?php echo $row['id']; ?></td>
                      </tr>
                      <tr>
                        <td>First name</td>
                        <td><?php echo $row['fname']; ?></td>
                      </tr>
                      <tr>
                        <td>Last name</td>
                        <td><?php echo $row['lname']; ?></td>
                      </tr>
                      <tr>
                        <td>Phone</td>
                        <td><?php echo $row['phone']; ?></td>
                      </tr>
                      <tr>
                        <td>Specialism</td>
                        <td><?php echo $row['specialism']; ?></td>
                      </tr>
                      <tr>
                        <td>City</td>
                        <td><?php echo $row['city']; ?></td>
                      </tr>
                      <tr>
                        <td>Street</td>
                        <td><?php echo $row['street']; ?></td>
                      </tr>
                      <tr>
                        <td>Department</td>
                        <td>
                          <?php
                            $dep_id = $row['dep_id'];
                            $query = mysqli_query($connect, "SELECT * FROM department WHERE id='$dep_id'");
                            $row2 = mysqli_fetch_array($query);
                            $dep_name = $row2['name'];
                            echo  $dep_name; 
                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-3">
                  <?php 
                    if(isset($_POST['change'])){
                      $uname = $_POST['uname'];
                      $sh = "";
                      if(empty($uname)){
                        $error['u'] = "Enter username";
                        if(isset($error['u'])) {
                          $er = $error['u'];
                          
                        }else {
                          $sh = "";
                        }
                      } else {
                        $query = "UPDATE doctor SET username='$uname' WHERE username='$doc'";
                        $res = mysqli_query($connect,$query);
                        if($res) {
                          $_SESSION['doctor'] = $uname;
                        }
                      }
                    } else{
                      $sh = "";
                    }
                  ?>
                  <form method="post">
                    <label>Change Username</label>
                    <div>
                      <?php echo $sh; ?>
                    </div>
                    <input type="text" name="uname" class="form-control" autocomplete="off">
                    <input type="submit" name="change" value="change" class="btn btn-success my-2">
                  </form>
                  <br>
                  <?php 
                    if(isset($_POST['update_pass'])){
                      $old_pass = $_POST['old_pass'];
                      $new_pass = $_POST['new_pass'];
                      $con_pass = $_POST['con_pass'];

                      $error = array();

                      $old = mysqli_query($connect,"SELECT * FROM doctor WHERE username='$doc'");

                      $row = mysqli_fetch_array($old);
                      $pass = $row['password'];

                      if(empty($old_pass)){
                        $error['P'] = "Enter old password";
                      }else if(empty($new_pass)){
                        $error['P'] = "Enter new password";
                      }else if(empty($con_pass)){
                        $error['P'] = "Confirm password";
                      }else if($old_pass != $pass){
                        $error['P'] = "Invalid Current password";
                      }else if($new_pass != $con_pass){
                        $error['P'] = "Both passwords does not match";
                      }

                      if(count($error) == 0) {
                        $query = "UPDATE doctor SET password='$new_pass' WHERE username = '$doc'";
                        mysqli_query($connect,$query);
                      }
                    }

                    if(isset($error['P'])) {
                      $e = $error['P'];
                      $show = "<h6 class='text-center alert alert-danger'>$e</h6>";
                    }else {
                      $show = "";
                    }
                  ?>
                  <form method="post">
                    <h5 class="text-center mt-4">Change Password</h5>
                    <div>
                      <?php echo $show; ?>
                    </div>
                    <div class="form-group">
                      <label>Current Password</label>
                      <input type="password" name="old_pass" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>New Password</label>
                      <input type="password" name="new_pass" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Confirm new Password</label>
                      <input type="password" name="con_pass" class="form-control">
                    </div>
                    <input type="submit" name="update_pass" value="Update Password" class="btn btn-success my-2">
                  </form>
                </div>
              </div>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </body>
</html>