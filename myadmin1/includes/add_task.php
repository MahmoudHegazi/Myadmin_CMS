<?php 
include "db.php";
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
   


$userid = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id=" . $userid;
$res = mysqli_query($con, $query);
 while ($row = mysqli_fetch_assoc($res)) {
	 $user_username = $row['username'];
	 $creator = $row['name'];
	 $user_image = $row['image'];
	
 }



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['task']){
        
        $title = test_input($_POST['task']);
		$user_id = $userid;
	    
		
        // Prepare an insert statement
		
        $sql = "INSERT INTO todo (title, user_id) VALUES (?, ?)";
		
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_title, $param_creatorid);
            // Set parameters
            $param_title = $title;
			$param_creatorid = $userid;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
				
            
            // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			$notifications_content = 'Hey ' . $user_username . " New Task Added.";            
            $notifications_reciver_id = $userid;
			$notifications_title = "task_added";
			
        $myquery = "INSERT INTO notifications (content, reciver_id, title) VALUES('$notifications_content','$notifications_reciver_id','$notifications_title')";
        $myresult = mysqli_query($con, $myquery);

        if (!$myresult) {
			
			// if can't add notifiction show error
          die("Could not send data " . mysqli_error($con));
        }
        else{
			// if notification created and mysqli_stmt_execute($stmt) added device redirect to workstation page 
            //echo "submited";
		    header("location: ../index.php");
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
} else {
	
	header("location: ../index.php");
}



?>