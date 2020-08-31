<?php 
session_start();
include 'db.php'; ?>
<?php 		 


 
 
// Check if the user is already logged in, if yes then redirect him to welcome page

// Include config file


$userid = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id=" . $userid;
$res = mysqli_query($con, $query);
 while ($row = mysqli_fetch_assoc($res)) {
	 $user_username = $row['username'];
	 $creator = $row['name'];
	 $user_image = $row['image'];
	
 }
 
 


  if (isset($_GET['emp'])) {
    $employee_id = $_GET['emp'];
    $query = "DELETE FROM employees WHERE id =" . $employee_id;
    $result = mysqli_query($con, $query);
    if (!$result) {
    

		//echo "Can't Delete This Device It Has Ticket in maintance you Had To delete The Ticket";
      
      
  

	  die("can't delete this Employee, He has Ticket In maintance <a href='../employees.php'><button class='btn btn-danger'>Back</button></a>");


	  //"Could not delete data " . 
    }
    else{
		
		            // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			
			$notifications_content = "!Employee Deleted sucessfully ID: " . $employee_id;     
            $notifications_reciver_id = $userid;
			$notifications_title = "employee_deleted";
			
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
		
		
		
		
		
		header("Location: ../employees.php");
    }
  }





?>