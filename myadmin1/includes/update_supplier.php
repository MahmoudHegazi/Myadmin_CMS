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
if (isset($_GET['supid'])) {
	
$sup_id = test_input($_GET['supid']);
$query = "SELECT * FROM suppliers";
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

	 
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	     
	
	
		$get_name = test_input($_POST['name']);
		$get_mobile = test_input($_POST['mobile']);
		$get_history = test_input($_POST['sup_history']);
		$get_info = test_input($_POST['extra_data']);
		
		
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
$sql = "UPDATE `suppliers` SET `name`='$get_name',`mobile`='$get_mobile',`sup_image`='$index_dir',`sup_history`='$get_history',`extra_data`='$get_info' WHERE sup_id=$sup_id";
if (mysqli_query($con, $sql)) {
               // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			$notifications_content = $supp_name . " Updated sucessfully!";            
            $notifications_reciver_id = $userid;
			$notifications_title = "supplier_updated";
			
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
	
	
	
	
   header("location: ../suppliers.php");
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
				<div class="panel-heading" style="background-color:crimson;color:white;
                text-align: center;">Update supplier Date</div>
				<div class="panel-body">
				
				
        <form  action="" method="POST" role="form" enctype="multipart/form-data">
		  <fieldset>	  
            <div class="form-group">
                <label>Supplier Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $supp_name; ?>" required="required">

            </div>    
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo $supp_mobile; ?>">

            </div>
								
									
            <div class="form-group">

                <label>history</label>
                <textarea name="sup_history" class="form-control" rows="5"><?php echo $sup_history; ?></textarea>

            </div>

            <div class="form-group">
                <label>Notes</label>
                <input type="text" name="extra_data" class="form-control" value="<?php echo $sup_extra; ?>">

            </div>

	<div class="form-group">
        <label for="image">Image</label>

		<input type="file" name="image" class="form-control" value="<?php echo $supp_image; ?>">
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