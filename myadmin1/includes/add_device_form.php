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
$stag = $manufacture = $purchased_date = $sup_id = $price = $history = $status = $model = $type = "";


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
        
        $stag = test_input($_POST['tag']);

		$manufacture = test_input($_POST['man']);
;
		$purchased_date = test_input($_POST['pdate']);
		$sup_id = test_input($_POST['supid']) + 0;

		$money_number = test_input($_POST['price']) + 0;
		$price = number_format($money_number,2,',','.');
		
		$history = test_input($_POST['history']);

		$status = test_input($_POST['status']);

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
		$model = test_input($_POST['model']);

		$type = test_input($_POST['type']);

	    
		
        // Prepare an insert statement
		global $con;
		
        $sql = "INSERT INTO workstation (service_tag, manufacture,purchased_date, supplier_id, price,
		history, status, images, model, type, creator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssisssssss", $param_stag, $param_man, $param_date, $param_supid, $param_price, $param_history, $param_status, $param_image, $param_model, $param_type, $param_creator);
            // Set parameters
            $param_stag = $stag;
            $param_man = $manufacture;
			$param_date = $purchased_date;
			$param_supid = $sup_id;
			$param_price = $price;
			$param_history = $history;
			$param_status = $status;
			$param_image = $index_dir;
			$param_model = $model;
			$param_type = $type;
			$param_creator = $creator;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
				
            
            // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			$notifications_content = "New Device has Added id: " . $stag;            
            $notifications_reciver_id = $userid;
			$notifications_title = "new_device";
			
        $myquery = "INSERT INTO notifications (content, reciver_id, title) VALUES('$notifications_content','$notifications_reciver_id','$notifications_title')";
        $myresult = mysqli_query($con, $myquery);

        if (!$myresult) {
			
			// if can't add notifiction show error
          die("Could not send data " . mysqli_error($con));
        }
        else{
			// if notification created and mysqli_stmt_execute($stmt) added device redirect to workstation page 
            //echo "submited";
		    header("location: ../workstation.php");
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
				<div class="panel-heading">Add New Device</div>
				<div class="panel-body">
				
				
        <form  action="add_device_form.php" method="post" role="form" enctype="multipart/form-data">
		  <fieldset>	  
            <div class="form-group">
                <label>service_tag</label>
                <input type="text" name="tag" class="form-control" value="<?php echo $stag; ?>" required="required">
                <span class="help-block"><?php //echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>manufacture</label>
                <input type="text" name="man" class="form-control" value="<?php echo $manufacture; ?>">
                <span class="help-block"><?php //echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>purchased_date</label>
                <input type="date" name="pdate" class="form-control" value="<?php echo $purchased_date; ?>" required="required">
                <span class="help-block"><?php //echo $confirm_password_err; ?></span>
            </div>

		
		
		
		
		<!-- suppliers Part start -->
		

	
			<div class="form-group">
										<label>supplier_id (<?php echo $suppliers_count; ?>)</label>
										<select class="form-control" name="supid" required="required">
										<?php 

    if(mysqli_num_rows($result) < 1) {
	    // No rows found 
        echo "<option value='undefined'>undefined</option>";
	   return;
} 
	// we found the rows
	while ($row = mysqli_fetch_assoc($result)) {
		
		 $supplier_id = $row['sup_id'];
		 $supplier_name = $row['name'];
		 
		 echo "<option value='" . $supplier_id . "'>" . $supplier_name ." (" . $supplier_id . ")" . "</option>";

	}
?>

										</select>
									</div>
		<!-- supplers part end -->
		
		
		

									
									
            <div class="form-group">
                <label>price</label>
                <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                <span class="help-block"><?php  //echo $name_err; ?></span>
            </div>

            <div class="form-group">
                <label>history</label>
                <input type="text" name="history" class="form-control" value="<?php echo $history; ?>">
                <span class="help-block"><?php  //echo $name_err; ?></span>
            </div>

            <div class="form-group">
			

				<div class="radio">
				  <label>
				    <input type="radio" name="status" value="old" <?php if ($status=='old') echo 'checked=""'; ?> checked="">Old
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="status" value="new" <?php if ($status=='new') echo 'checked=""'; ?>>New
				  </label>
				</div>
				
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

		<input type="file" name="image" class="form-control" value="<?php echo $param_image; ?>">
          </div>

            <div class="form-group">
                <label>model</label>
                <input type="text" name="model" class="form-control" value="<?php echo $model; ?>">
                <span class="help-block"><?php  //echo $name_err; ?></span>
            </div>	


			<div class="form-group">
										<label>Type</label>
										<select class="form-control" name="type" required="required">
										 <option value="laptop">Laptop</option>
										 <option value="computer">Computer</option>
										 <option value="printer">Printer</option>
										 <option value="scanner">Scanner</option>
										 <option value="camera">Camera</option>
										 <option value="projector">Projector</option>
										 <option value="tablet">Tablet</option>
										 <option value="router">Router</option>
										 <option value="accesspoint">Access point</option>
										 <option value="other">not listed</option>
										</select>
									</div>
			
<!--			
            <div class="form-group">
                <label>Type</label>
                <input type="text" name="type" class="form-control" value="?php echo $type; ?>" required="required">
                <span class="help-block">?php  //echo $name_err; ?></span>
            </div>	
-->			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="../index.php"><input type="button" class="btn btn-default" value="Cancel"></a>
            </div>
            <!-- <p>Already have an account? <a href="login.php">Login here</a>.</p> -->
	      </fieldset>
        </form>
    </div>    
				</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>
</html>