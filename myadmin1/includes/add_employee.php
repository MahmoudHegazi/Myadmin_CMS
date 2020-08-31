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
$emp_name = $emp_location = $emp_creator_id = $emp_sup_location = $emp_resigned = $emp_job_title = $emp_employee_id = $emp_department = $emp_creator = "";


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
        
        $emp_name = test_input($_POST['name']);
		$emp_location = test_input($_POST['location']);
		$emp_sup_location = test_input($_POST['suplocation']);
		$emp_resigned = test_input($_POST['resigned']);
		$emp_job_title = test_input($_POST['title']);
		$emp_employee_id = test_input($_POST['tag']);
		$emp_department = test_input($_POST['department']);
        $emp_creator = $userid;

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
		
        $sql = "INSERT INTO employees (name, location,image, creator_id, sup_location, resigned, job_title, employee_id, department) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_name, $param_location, $param_image, $param_creator, $param_slocation, $param_resigned, $param_title, $param_tag, $param_department);
            // Set parameters
            $param_name = $emp_name;
			$param_location = $emp_location;
			$param_image = $index_dir;
			$param_creator = $emp_creator;
			$param_slocation = $emp_sup_location;
			$param_resigned = $emp_resigned;            
			$param_title = $emp_job_title;
			$param_tag = $emp_employee_id;
            $param_department = $emp_department;
			
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
				
            
            // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			$notifications_content = $param_name . " added sucessfully!";            
            $notifications_reciver_id = $userid;
			$notifications_title = "employee_added";
			
        $myquery = "INSERT INTO notifications (content, reciver_id, title) VALUES('$notifications_content','$notifications_reciver_id','$notifications_title')";
        $myresult = mysqli_query($con, $myquery);

        if (!$myresult) {
			
			// if can't add notifiction show error
          die("Could not send data " . mysqli_error($con));
        }
        else{
			// if notification created and mysqli_stmt_execute($stmt) added device redirect to workstation page 
            //echo "submited";
		    header("location: ../employees.php");
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
	




?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Employee</title>
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
				<div class="panel-heading" style="background-color:#45b8ac;color:white;
                text-align: center;">Add New Employee</div>
				<div class="panel-body">

		
				
        <form  action="" method="post" role="form" enctype="multipart/form-data">
		  <fieldset>	  
            <div class="form-group">
                <label>Employee Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $emp_name; ?>" required="required">

            </div>    
            <div class="form-group">
                <label>location</label>
                <input type="text" name="location" class="form-control" value="<?php echo $emp_location; ?>">

            </div>            
            <div class="form-group">
                <label>sup location</label>
                <input type="text" name="suplocation" class="form-control" value="<?php echo $emp_sup_location; ?>">

            </div>            

            <div class="form-group">
                <label>resigned: </label>
                <input type="radio" name="resigned" value="no" checked="checked"> <label> No</label>
				<input type="radio" name="resigned" value="yes" > <label> Yes</label>

            </div>		

            <div class="form-group">
                <label>Job Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $emp_job_title; ?>">

            </div>
            <div class="form-group">
                <label>Employee ID</label>
                <input type="text" name="tag" class="form-control" value="<?php echo $emp_employee_id; ?>">

            </div>
            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" class="form-control" value="<?php echo $emp_department; ?>">

            </div>		

			
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