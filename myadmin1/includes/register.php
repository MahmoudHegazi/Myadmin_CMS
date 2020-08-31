<?php
session_start();
// Include config file
require_once "db.php";


// next time we going to add rule for who can add 
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true ){
	header("location: ../../forbiden.php");
	//die();
} 


 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
   }
 
 
   
// Define variables and initialize with empty values
$username = $password = $confirm_password = $uname = $image = $index_image = "";
$username_err = $password_err = $confirm_password_err = $name_err = "";




// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
     

	
	// get image 
			// image start 
		if(isset($_FILES['image'])) {
			
            $dir = "../images/";
			$image = $dir.basename($_FILES['image']['name']);
			if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
				  echo "Image was uploaded";
				  $user_image = $image;
				  $index_image = 'images/' . $_FILES['image']['name'];
			} else {
				echo "Can't upload the image";
				$user_image = 'images/fb.jpg';
				$index_image = 'images/fb.jpg';
				
			}
		}
        // image end 
	

    // Validate name
	$getname = test_input($_POST["thename"]);
	if(!preg_match("/^[a-zA-Z ]*$/",$getname)){
		$name_err = "Please enter valid name";
		return;
	} else {
		$uname = test_input($_POST["thename"]);
	}

	
	 
    // Validate username
    if(empty(test_input($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = test_input($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = test_input($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(test_input($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(test_input($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = test_input($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(test_input($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = test_input($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, name, user_image, index_image) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_name, $param_uimage, $param_index);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash		
			$param_name = $uname;
            
			// user image 
			$param_uimage = $user_image;
			$param_index = $index_image;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ../index.php");
			  
            } else{
                echo 'user: ' . $param_username . '<br>';
				echo 'user_err: ' . $username_err. '<br>';
                echo 'pass err :' . $password_err. '<br>';
                echo 'pass : ' . $password. '<br>';
				echo 'image:' . $image . '<br>';
				echo 'index_image' . $index_image . '<br>';
				
				//echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($con);
}
	

	


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Sign Up</div>
				<div class="panel-body">
				
				
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" role="form" enctype="multipart/form-data">
		  <fieldset>	  
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

		
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="thename" class="form-control" value="<?php echo $uname; ?>">
                <span class="help-block"><?php  echo $name_err; ?></span>
            </div>
			
			<!-- image part start -->
			
	<div class="form-group">
        <label for="image">Image</label>

		<input type="file" name="image" class="form-control" value="<?php echo $user_image; ?>">
          </div>
			<!-- image end -->
			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
	      </fieldset>
        </form>
    </div>    
				</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>
</html>