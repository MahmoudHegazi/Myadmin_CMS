<?php
session_start();
 
 
// Check if the user is already logged in, if yes then redirect him to welcome page

// Include config file
require_once "db.php";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
   }
   
   
// Define variables and initialize with empty values
$supplier_name = $supplier_mobile = $supplier_history = $supplier_info = "";


$userid = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id=" . $userid;
$res = mysqli_query($con, $query);
 while ($row = mysqli_fetch_assoc($res)) {
	 $user_username = $row['username'];
	 $creator = $row['name'];
	 $user_image = $row['image'];
	
 }
 



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $supplier_name = test_input($_POST['name']);
		$supplier_mobile = test_input($_POST['mobile']);;
		$supplier_history = test_input($_POST['sup_history']);
		$supplier_info  = test_input($_POST['extra_data']);


		// image start 
		if(isset($_FILES['image'])) {
			
            $dir = "../images/";
			$image = $dir.basename($_FILES['image']['name']);
			if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
				  echo "Image was uploaded";
				
			} else {
				echo "Can't upload the image";
				
			}
			// this to remove the first letter from directory becuase /images/fb.gp not open from index it must be images/fb.gp
			$index_dir = substr($image, 1);
		}
        // image end 

	    
		
        // Prepare an insert statement
		global $con;
		
        $sql = "INSERT INTO suppliers (name, mobile,sup_image, sup_history, extra_data, added_by) VALUES (?, ?, ?, ?, ?, ?)";
		
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_mobile, $param_image, $param_history, $param_info, $param_creator);
            // Set parameters
            $param_name = $supplier_name;
            $param_mobile = $supplier_mobile;
			$param_image = $index_dir;
			$param_history = $supplier_history;
            $param_info = $supplier_info;
			$param_creator = $creator;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
				
            
            // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			$notifications_content = $supplier_name . " added sucessfully!";            
            $notifications_reciver_id = $userid;
			$notifications_title = "supplier_added";
			
        $myquery = "INSERT INTO notifications (content, reciver_id, title) VALUES('$notifications_content','$notifications_reciver_id','$notifications_title')";
        $myresult = mysqli_query($con, $myquery);

        if (!$myresult) {
			
			// if can't add notifiction show error
          die("Could not send data " . mysqli_error($con));
        }
        else{
			// if notification created and mysqli_stmt_execute($stmt) added device redirect to workstation page 
            //echo "submited";
		    header("location: ../suppliers.php");
        }

// end push
                
			  
            } else{

				echo mysqli_error($con) . "don't forget about notification errors";
				
				//echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

    
    // Close connection
    mysqli_close($con);
}
	

// suppliers part

    global $con;
    $query = "SELECT * FROM suppliers";
    $result = mysqli_query($con, $query);
    $suppliers_count = mysqli_num_rows($result);	


	


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
				<div class="panel-heading" style="background-color:crimson;color:white;
                text-align: center;">Add New supplier</div>
				<div class="panel-body">
				
				
        <form  action="add_supplier_form.php" method="post" role="form" enctype="multipart/form-data">
		  <fieldset>	  
            <div class="form-group">
                <label>Supplier Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $supplier_name; ?>" required="required">
                <!-- <span class="help-block">?php //echo $username_err; ?></span> -->
            </div>    
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo $supplier_mobile; ?>">
                <!-- <span class="help-block">?php //echo $password_err; ?></span> -->
            </div>
            
            


		
		

									
									
            <div class="form-group">
                

                <label>history</label>
                <textarea name="sup_history" class="form-control" rows="5"><?php echo $supplier_history; ?></textarea>

            </div>

            <div class="form-group">
                <label>Notes</label>
                <input type="text" name="extra_data" class="form-control" value="<?php echo $supplier_info; ?>">
               <!-- <span class="help-block"><?php  //echo $name_err; ?></span> -->
            </div>

		

        <!--
            <div class="form-group">
                <label>image</label>
                <input type="text" name="image" class="form-control" value="?php //echo $image; ?>">
                <span class="help-block">?php  //echo $name_err; ?></span>
            </div>
			-->
			
	<div class="form-group">
        <label for="image">Image</label>

		<input type="file" name="image" class="form-control" value="<?php echo $image; ?>">
          </div>




			
	
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="../suppliers.php"><input type="button" class="btn btn-default" value="Cancel"></a>
            </div>

	      </fieldset>
        </form>
    </div>    
				</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>
</html>