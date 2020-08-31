<?php include 'db.php'; ?>
<?php 		 



function deletedevice() {
$userid = $_SESSION['id'];
global $con;
$stmt = $con->prepare('SELECT * FROM users WHERE id= ?');
$stmt->bind_param('i', $userid); 
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    // Do something with $row
	 $user_username = $row['username'];
	 $creator = $row['name'];
	 $user_image = $row['image'];
}
 
 









  if (isset($_GET['delete_device'])) {
global $con;	  
$stmt = $con->prepare('DELETE FROM workstation WHERE id = ?');
$dev_id = $_GET['delete_device'];
$stmt->bind_param('i', $dev_id);

if(!$stmt->execute()) {

	echo "<script>alert('Can not delete Device With ID: " . $dev_id . " Becuase It Has Ticket In maintenance delete it first!');</script>";
	
} else {
	

		
		            // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			$notifications_content = "Device Deleted Successfully ID: " . $dev_id;            
            $notifications_reciver_id = $userid;
			$notifications_title = "device_deleted";
			
        $myquery = "INSERT INTO notifications (content, reciver_id, title) VALUES('$notifications_content','$notifications_reciver_id','$notifications_title')";
        $myresult = mysqli_query($con, $myquery);

        if (!$myresult) {
			
			// if can't add notifiction show error
          die("Could not send data " . mysqli_error($con));
        }
        else{
			// if notification created and mysqli_stmt_execute($stmt) added device redirect to workstation page 
            //echo "submited";
		    header("Location: workstation.php");
        }

// end push
		
		
		

  }
  }
}

deletedevice();

?>