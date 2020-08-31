<?php
session_start();
include 'db.php';
global $con;

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 

$userid = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id=" . $userid;
$res = mysqli_query($con, $query);
 while ($row = mysqli_fetch_assoc($res)) {
	 $user_username = $row['username'];
	 $creator = $row['name'];
	 $user_image = $row['image'];
	
 }
if (isset($_GET['empid'])) {
	
$emp_id = test_input($_GET['empid']);
$query = "SELECT * FROM employees WHERE id=".$emp_id;
$result = mysqli_query($con, $query);
$suppliers_count = mysqli_num_rows($result);
     while ($row = mysqli_fetch_assoc($result)) {
	     $emp_id = $row['id'];
		 $emp_name = $row['name'];
		 $emp_location = $row['location'];
		 $emp_image = $row['image'];
		 $emp_creator_id = $row['creator_id'];
		 $emp_sup_location = $row['sup_location'];
		 $emp_resigned = $row['resigned'];
		 $emp_job_title = $row['job_title'];
		 $emp_employee_id = $row['employee_id'];
		 $emp_department = $row['department'];
		 
	 }

	 

	 
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	     
	
	
		$get_name = test_input($_POST['name']);
		$get_location = test_input($_POST['location']);
		$get_suplocation = test_input($_POST['suplocation']);
		$get_resigned = test_input($_POST['resigned']);
		$get_tag = test_input($_POST['tag']);
		$get_department = test_input($_POST['department']);
		$get_title = test_input($_POST['title']);
	
		
		// image start 
		if(isset($_FILES['image'])) {
			
            $dir = "../images/";
			$image = $dir.basename($_FILES['image']['name']);
			if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
				  echo "Image was uploaded";
				  $index_dir = substr($image, 1);
				
			} else {
				echo "Image Not Updated";
				$index_dir = $supp_image;
			}
			// this to remove the first letter from directory becuase /images/fb.gp not open from index it must be images/fb.gp
			
		}
        // image end 

//$sql = "UPDATE `todo` SET `finished`=1 WHERE id=".$task_id;

//$sql = "UPDATE `suppliers` SET `name`=". $supp_name .",`mobile`=".$supp_mobile.",`sup_image`=".$supp_image.",`sup_history`=".$sup_history.",`extra_data`=".$sup_extra."WHERE sup_id=".$sup_id;
$sql = "UPDATE `employees` SET `name`='$get_name', `location`='$get_location',`image`='$index_dir',`sup_location`='$get_suplocation',`resigned`='$get_resigned',`job_title`='$get_title',`employee_id`='$get_tag',`department`='$get_department'  WHERE id=$emp_id";
if (mysqli_query($con, $sql)) {
               // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			$notifications_content = $get_name . " Updated sucessfully!";      
            $notifications_reciver_id = $userid;
			$notifications_title = "employee_updated";
			
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
	
	
	
	
   header("location: ../employees.php");
} else {
  echo "Error updating record: " . mysqli_error($con);
}

mysqli_close($con);
}



}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Employee</title>
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
				<div class="panel-heading" style="background-color:#59ff00;color:gray;
                text-align: center;">Update Employee</div>
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
                <input type="radio" name="resigned" value="no" 	<?php if($emp_resigned == "no") {echo "checked='checked'";} ?>> <label> No</label>
				<input type="radio" name="resigned" value="yes" <?php if($emp_resigned == "yes") {echo "checked='checked'";} ?> > <label> Yes</label>

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