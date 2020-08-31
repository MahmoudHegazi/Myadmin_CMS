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
if (isset($_GET['device'])) {
	
$device_id = test_input($_GET['device']);
$query = "SELECT * FROM workstation WHERE id=".$device_id;
$result = mysqli_query($con, $query);
$suppliers_count = mysqli_num_rows($result);
     while ($row = mysqli_fetch_assoc($result)) {
	     $device_id = $row['id'];
		 $device_tag = $row['service_tag'];
		 $device_manufacture = $row['manufacture'];
		 $device_date = $row['purchased_date'];
		 $device_supplier_id = $row['supplier_id'];
		 $device_price = $row['price'];
		 $device_history = $row['history'];
		 $device_model = $row['model'];
		 $device_type = $row['type'];
		 $device_status = $row['status'];
		 $device_image = $row['images'];
		 
	 }

 




	 
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	     
	
	
		$get_tag = test_input($_POST['tag']);
		$get_manufacture = test_input($_POST['man']);
		$get_purchased_date = test_input($_POST['pdate']);
		$get_supplier_id = test_input($_POST['sup_id']);
		$get_price = test_input($_POST['price']);
		$get_price = number_format($get_price,2,',','.');
		$get_history = test_input($_POST['history']);
		$get_status = test_input($_POST['status']);
		$get_model = test_input($_POST['model']);
		$get_type = test_input($_POST['type']);
	
		
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

//$sql = "UPDATE `todo` SET `finished`=1 WHERE id=".$task_id;

//$sql = "UPDATE `suppliers` SET `name`=". $supp_name .",`mobile`=".$supp_mobile.",`sup_image`=".$supp_image.",`sup_history`=".$sup_history.",`extra_data`=".$sup_extra."WHERE sup_id=".$sup_id;
$sql = "UPDATE `workstation` SET `service_tag`='$get_tag', `manufacture`='$get_manufacture',`purchased_date`='$get_purchased_date',`supplier_id`='$get_supplier_id',`price`='$get_price',`history`='$get_history',`status`='$get_status',`images`='$index_dir',`model`='$get_model',`type`='$get_type' WHERE id=$device_id";
if (mysqli_query($con, $sql)) {
               // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			$notifications_content = "Device updated sucessfully ID :" . $get_tag;      
            $notifications_reciver_id = $userid;
			$notifications_title = "device_updated";
			
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
	
	
	
	
   header("location: ../workstation.php");
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
				
				
        <form  action="" method="post" role="form" enctype="multipart/form-data">
		  <fieldset>	  
            <div class="form-group">
                <label>service_tag</label>
                <input type="text" name="tag" class="form-control" value="<?php echo $device_tag; ?>" required="required">
                <span class="help-block"><?php //echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>manufacture</label>
                <input type="text" name="man" class="form-control" value="<?php echo $device_manufacture; ?>">
                <span class="help-block"><?php //echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>purchased_date</label>
                <input type="date" name="pdate" class="form-control" value="<?php echo $device_date; ?>" required="required">
                <span class="help-block"><?php //echo $confirm_password_err; ?></span>
            </div>


		
		
		
		<!-- suppliers Part start -->
		<?php $query = "SELECT * FROM suppliers";
$result = mysqli_query($con, $query);
$suppliers_count = mysqli_num_rows($result);
     while ($row = mysqli_fetch_assoc($result)) {
	     $supp_id = $row['sup_id'];
		 $supp_name = $row['name'];
		 $supp_mobile = $row['mobile'];
		 $supp_image = $row['sup_image'];
		 $sup_history = $row['sup_history'];
		 $sup_extra = $row['extra_data'];
	 }
?>	 

	
			<div class="form-group">
										<label>supplier_id (<?php echo $suppliers_count; ?>)</label>
										<select class="form-control" name="sup_id" required="required">
										
										
										<?php 


	// we found the rows

$query1 = "SELECT * FROM suppliers";
$result1 = mysqli_query($con, $query1);

    if(mysqli_num_rows($result) < 1) {
	     // No rows found 
         echo "<option value='undefined'>undefined</option>";
	     return;
    } 
	
	while ($newrow = mysqli_fetch_assoc($result1)) {
		
		 $supplier_id = $newrow['sup_id'];
		 $supplier_name = $newrow['name'];
		 

		if ($device_supplier_id == $supplier_id) {
			echo "<option value='" . $device_supplier_id . "' selected='selected'>" . $supplier_name ." (" . $supplier_id . ")" . "</option>";
			

        } else {
		 
		 echo "<option value='" . $supplier_id . "'>" . $supplier_name ." (" . $supplier_id . ")" . "</option>";
		 
		}

	} 
	
	
	/* 
			 if ($device_supplier_id == $supplier_id) {
			echo "<option value='" . $device_supplier_id . "' selected='selected'>" . $supplier_name ." (" . $supplier_id . ")" . "</option>";
		 } else {
	*/
?>

										</select>
									</div>
		<!-- supplers part end -->
		
									
									
            <div class="form-group">
                <label>price</label>
                <input type="text" name="price" class="form-control" value="<?php echo $device_price; ?>">
            </div>

            <div class="form-group">
                <label>history</label>
                <input type="text" name="history" class="form-control" value="<?php echo $device_history; ?>">
            </div>

            <div class="form-group">
			

				<div class="radio">
				  <label>
				    <input type="radio" name="status" value="old" <?php if ($device_status =='old') echo 'checked=""'; ?> checked="">Old
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="status" value="new" <?php if ($device_status =='new') echo 'checked=""'; ?>>New
				  </label>
				</div>
				
            </div>			

        <!--
            <div class="form-group">
                <label>image</label>
                <input type="text" name="image" class="form-control" value="?php //echo $image; ?>">
            </div>
			-->
			
	<div class="form-group">
        <label for="image">Image</label>

		<input type="file" name="image" class="form-control" value="<?php echo $param_image; ?>">
          </div>

            <div class="form-group">
                <label>model</label>
                <input type="text" name="model" class="form-control" value="<?php echo $device_model; ?>">
            </div>	















			<div class="form-group">
										<label>Type</label>
										<select class="form-control" name="type" required="required">
										 <option value="laptop" <?php if ($device_type=='laptop') echo 'selected="selected"'; ?>>Laptop</option>
										 <option value="computer" <?php if ($device_type=='computer') echo 'selected="selected"'; ?>>Computer</option>
										 <option value="printer" <?php if ($device_type=='printer') echo 'selected="selected"'; ?>>Printer</option>
										 <option value="scanner" <?php if ($device_type=='scanner') echo 'selected="selected"'; ?>>Scanner</option>
										 <option value="camera" <?php if ($device_type=='camera') echo 'selected="selected"'; ?>>Camera</option>
										 <option value="projector" <?php if ($device_type=='projector') echo 'selected="selected"'; ?>>Projector</option>
										 <option value="tablet" <?php if ($device_type=='tablet') echo 'selected="selected"'; ?>>Tablet</option>
										 <option value="router" <?php if ($device_type=='router') echo 'selected="selected"'; ?>>Router</option>
										 <option value="accesspoint" <?php if ($device_type=='accesspoint') echo 'selected="selected"'; ?>>Access point</option>
										 <option value="other" <?php if ($device_type=='other') echo 'selected="selected"'; ?>>not listed</option>
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