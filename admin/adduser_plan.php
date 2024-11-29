<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

if (isset($_POST['btn_save'])) {
    // Retrieve data from POST request
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];
    $rating = $_POST['rating'];

    // Validation
    $errors = array();
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name must have at least 3 characters";
    } elseif (strlen($name) > 50) {
        $errors[] = "Name cannot contain more than 50 characters";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }

    if (empty($number)) {
        $errors[] = "Number is required";
    } elseif (!is_numeric($number)) {
        $errors[] = "Number must be a number";
    }

    if (empty($message)) {
        $errors[] = "Message is required";
    }

    if (empty($rating)) {
        $errors[] = "Rating is required";
    } elseif (!is_numeric($rating)) {
        $errors[] = "Rating must be a number";
    }

    if (count($errors) == 0) {
        // Prepare the SQL statement for the user_plan table
        $stmt = $con->prepare("INSERT INTO `user_plan`(`Name`, `Email`, `Number`, `Message`, `Rating`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $number, $message, $rating);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to user_plan.php on success
            @header("location:user_plan.php"); 
            exit();
        } else {
            // Handle error
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        mysqli_close($con);
    }
}
?>


      <!-- End Navbar -->
    <!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <!-- your content here -->
    <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Add User Plan</h4>
            <p class="card-category">Complete Feedback profile</p>
          </div>
          <div class="card-body">
            <form action="" method="post" name="form" enctype="multipart/form-data">
              <div class="row">
                
             

                </div>
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <?php if (isset($errors) && in_array("Name is required", $errors)) { ?>
                        <span style="color: red;">Name is required</span>
                    <?php } elseif (isset($errors) && in_array("Name must have at least 3 characters", $errors)) { ?>
                        <span style="color: red;">Name must have at least 3 characters</span>
                    <?php } elseif (isset($errors) && in_array("Name cannot contain more than 50 characters", $errors)) { ?>
                        <span style="color: red;">Name cannot contain more than 50 characters</span>
                    <?php } ?>
                  </div>
                </div>
              
              </div>
               <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                    <?php if (isset($errors) && in_array("Email is required", $errors)) { ?>
                        <span style="color: red;">Email is required</span>
                    <?php } elseif (isset($errors) && in_array("Invalid email address", $errors)) { ?>
                        <span style="color: red;">Invalid email address</span>
                    <?php } ?>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label class ="bmd-label-floating">Number</label>
                    <input type="number" id="number" name="number" class="form-control">
                    <?php if (isset($errors) && in_array("Number is required", $errors)) { ?>
                        <span style="color: red;">Number is required</span>
                    <?php } elseif (isset($errors) && in_array("Number must be a number", $errors)) { ?>
                        <span style="color: red;">Number must be a number</span>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Message</label>
                    <input type="text" name="message" id="message" class="form-control">
                    <?php if (isset($errors) && in_array("Message is required", $errors)) { ?>
                        <span style="color: red;">Message is required</span>
                    <?php } ?>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Rating</label>
                    <input type="number" id="rating" name="rating" class="form-control">
                    <?php if (isset($errors) && in_array("Rating is required", $errors)) { ?>
                        <span style="color: red;">Rating is required</span>
                    <?php } elseif (isset($errors) && in_array("Rating must be a number", $errors)) { ?>
                        <span style="color: red;">Rating must be a number</span>
                    <?php } ?>
                  </div>
                </div>
              </div>

              

             
            
                  </div>
                </div>
                
              </div>
              
              <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Update User Plan</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
include "footer.php";
?>