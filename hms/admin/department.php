<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Departments</title>
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
                <div class="col-md-8">
                  <h5 class="text-center">All Departments</h5>
                  <?php
                    $dep = $_SESSION['admin'];
                    $query = "SELECT * FROM department";
                    $res = mysqli_query($connect,$query);
                    $output="
                      <table class='table table-bordered'>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th style='width: 10%'>Action</th>
                        <tr>";

                    if(mysqli_num_rows($res) < 1) {
                      $output .= "<tr><td colspan='4' class='text-center'>No Departments.</td></tr>";
                    }
                    
                    while($row = mysqli_fetch_array($res)){
                      $id = $row['id'];
                      $name = $row['name'];
                      $phone = $row['phone'];
                      $dep = mysqli_query($connect,"SELECT * FROM department");
                      $dep_num = mysqli_num_rows($dep);
                      $output .="
                        <tr>
                          <td>$id</td>
                          <td>$name</td>
                          <td>$phone</td>
                          <td><a href='department?id=$id'>
                            <button id='$id' class='btn btn-danger'>Remove</button>
                          </a></td>";
                    }
                    $output .="
                      </tr>
                      </table>";
                    
                    echo $output;

                    if(isset($_GET['id'])) {
                      $id=$_GET['id'];

                      $query = "DELETE FROM department WHERE id='$id'";
                      mysqli_query($connect,$query);
                    }
                  ?>
                </div>
                <div class="col-md-3">
                  <?php
                    if(isset($_POST['add'])) {
                      $name = $_POST['name'];
                      $phone = $_POST['phone'];
                      
                      $error = array();

                      if(empty($name)) {
                        $error['n'] = "Enter department's name";
                      } else if(empty($phone)) {
                        $error['n'] = "Enter department's phone";
                      }

                      if(count($error) == 0) {
                        $q = "INSERT INTO department(name, phone) VALUES ('$name','$phone')";
                      
                        $_result = mysqli_query($connect,$q);
                      }
                    }

                    if(isset($error['n'])) {
                      $er = $error['n'];

                      $show = "<h6 class='text-center alert alert-danger'>$er</h6>";
                    } else {
                      $show = "";
                    }
                  ?>
                  <h5 class="text-center">Add new department</h5>
                  <form method="post" enctype="multipart/form-data">
                    <div>
                      <?php echo $show; ?>
                    </div>
                    <div class="from-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" autocomplete="off">
                    </div>
                    <div class="from-group">
                      <label>Phone</label>
                      <input type="text" name="phone" class="form-control" autocomplete="off">
                    </div><br>
                    <input type="submit" name="add" value="Add new department" class="btn btn-success">
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
