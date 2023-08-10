<?php
  include("include/connection.php");

  if(isset($_POST['apply'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $specialism = $_POST['specialism'];

    $error = array();

    $query = "SELECT * FROM department WHERE name='$specialism'";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) < 1) {
      $error['apply'] = "No Department is existed for your Specialism";
    } else {
      $row = mysqli_fetch_array($result);
      $dep_id = $row['id'];
    }

    if(empty($fname) || empty($lname)) {
      $error['apply'] = "Enter Full name";
    }else if(empty($username)) {
      $error['apply'] = "Enter Username";
    } else if(empty($password)) {
      $error['apply'] = "Enter Password";
    } else if(empty($specialism)) {
      $error['apply'] = "Enter Specialism";
    }

    if(count($error) == 0) {
      $query = "INSERT INTO doctor(fname, lname, username, password, phone, city, street, specialism, dep_id) VALUES ('$fname', '$lname', '$username', '$password', '$phone', '$city', '$street', '$specialism', '$dep_id')";

      $result = mysqli_query($connect,$query);

      if($result) {
        echo "<script>alert('You have Successfully Applied')</script>";
        header("Location:doctorlogin.php");
      } else {
        echo "<script>alert('Failed')</script>";
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Doctor Sign Up Page</title>
  </head>
  <body style="background-image: url(img/hospital.jpg);background-size: cover;">

    <?php
      include("include/header.php");
    ?>

    <div style="margin-top: 20px;"></div>

    <div class="container">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8 mt-4 p-4 bg-light text-black rounded">
            <center>
              <i class="fa-solid fa-user-doctor fa-2xl my-3" style="color: black;"></i>
              <p>Apply Now</p>
            </center>
            <form method="post" class="my-2">
              <div>
                <?php
                  if(isset($error['apply'])) {
                    $sh = $error['apply'];
                    $show = "<h6 class='alert alert-danger' role='alert'>$sh</h6>";
                  } else {
                    $show = "";
                  }
                  echo $show;
                ?>
              </div>
              <div class="form-group">
                <label>First name</label>
                <input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Enter First name" 
                  value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
              </div>
              <div style="margin-top: 10px;"></div>
              <div class="form-group">
                <label>Last name</label>
                <input type="text" name="lname" class="form-control" autocomplete="off" placeholder="Enter Last name"
                  value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>">
              </div>
              <div style="margin-top: 10px;"></div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username"
                  value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
              </div>
              <div style="margin-top: 10px;"></div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" class="form-control" placeholder="Enter password">
              </div>
              <div style="margin-top: 10px;"></div>
              <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter phone number of 6 digit"
                  value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
              </div>
              <div style="margin-top: 10px;"></div>
              <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" autocomplete="off" placeholder="Enter City"
                  value="<?php if(isset($_POST['city'])) echo $_POST['city']; ?>">
              </div>
              <div style="margin-top: 10px;"></div>
              <div class="form-group">
                <label>Street</label>
                <input type="text" name="street" class="form-control" autocomplete="off" placeholder="Enter Street"
                  value="<?php if(isset($_POST['street'])) echo $_POST['street']; ?>">
              </div>
              <div style="margin-top: 10px;"></div>
              <div class="form-group">
                <label>Specialism</label>
                <input type="text" name="specialism" class="form-control" autocomplete="off" placeholder="Enter Specialism"
                  value="<?php if(isset($_POST['specialism'])) echo $_POST['specialism']; ?>">
              </div>
              <div style="margin-top: 20px;"></div>
              <input type="Submit" name="apply" value="Apply Now" class="btn btn-success">
              <div style="margin-top: 20px;"></div>
              <p>Already have an account.<a href="doctorlogin.php">Click here to Sign In</a></p>
            </form>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>
    </div>

  </body>
</html>