
<?php
include "includes/db.php";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// PHP program to convert timestamp 
// to time ago 
  

  
// to_time_ago() function call 
//echo to_time_ago( time() - 5); 


if (isset($_GET['uid']) && isset($_GET['fid']) && isset($_GET['message'])) {
	
  $userid = test_input($_GET['uid']);
  $friendid = test_input($_GET['fid']);
  $new_message = test_input($_GET['message']);

  
   // If message not empty let's add it
   if ($new_message !== "") {
   
   
   // Start Of Adding New Message
   
   /*Get Loged user name */
  $stmt = $con->prepare('SELECT * FROM users WHERE id= ?');
  $stmt->bind_param('i', $userid); 
  $stmt->execute();

  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
      // Do something with $row
	  $loged_name = $row['name'];
	  $loged_image = $row['index_image'];
  }

 
    /*Get friend user name */
  $stmt = $con->prepare('SELECT * FROM users WHERE id= ?');
  $stmt->bind_param('i', $friendid); 
  $stmt->execute();

  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
     // Do something with $row
	 $friend_name = $row['name'];
	 $friend_image = $row['index_image'];
  }
   
   
   
   // insert the message into the table 

   $sql = "INSERT INTO messages (body, sender_id, reciver_id) VALUES (?, ?, ?)";
           if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sii", $param_body, $param_sender, $param_reciver);
            // Set parameters
            $param_body = $new_message;
            $param_sender = $userid;
			$param_reciver = $friendid;			
		
		    // if we added the message send notification
			
			if(mysqli_stmt_execute($stmt)){
			
            // ---------------------------------------------
			// push new notification title new_device  
			// ---------------------------------------------
			//next update give him link to that device
			
			$notifications_content = "You Sent Message To: " . $friend_name;
            $notifications_reciver_id = $userid;
			$notifications_title = "send_message";
			
            $myquery = "INSERT INTO notifications (content, reciver_id, title) VALUES('$notifications_content','$notifications_reciver_id','$notifications_title')";
            $myresult = mysqli_query($con, $myquery);

            if (!$myresult) {
			
			   // if can't add notifiction show error
               die("Could not send data " . mysqli_error($con));
            }
            else{
			  // if notification created and mysqli_stmt_execute($stmt) added device redirect to workstation page 
              //echo "submited";
			  
			  //#######################################################
			  // Sucess Part  This send the response to the client side 
			  //#######################################################
			  
			  
$stmt = $con->prepare('SELECT body, sender_id, sent_date FROM messages WHERE sender_id = ? AND reciver_id= ? OR sender_id = ? AND reciver_id = ? ORDER BY sent_date ASC');
$stmt->bind_param('iiii', $userid, $friendid, $friendid, $userid); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();
$messages = [];



// I did that in 6 hours Get message in time ago format

function time_Ago($time) { 
  
    // Calculate difference between current 
    // time and given timestamp in seconds 
    $diff     = (time() + (60 *60 *2)) - $time; 
      
    // Time difference in seconds 
    $sec     = $diff; 
      
    // Convert time difference in minutes 
    $min     = round($diff / 60 ); 
      
    // Convert time difference in hours 
    $hrs     = round($diff / 3600); 
      
    // Convert time difference in days 
    $days     = round($diff / 86400 ); 
      
    // Convert time difference in weeks 
    $weeks     = round($diff / 604800); 
      
    // Convert time difference in months 
    $mnths     = round($diff / 2600640 ); 
      
    // Convert time difference in years 
    $yrs     = round($diff / 31207680 ); 
      
    // Check for seconds 
    if($sec <= 60) { 
        return "$sec seconds ago"; 
    } 
      
    // Check for minutes 
    else if($min <= 60) { 
        if($min==1) { 
            return "one minute ago"; 
        } 
        else { 
            return "$min minutes ago"; 
        } 
    } 
      
    // Check for hours 
    else if($hrs <= 24) { 
        if($hrs == 1) {  
            return "an hour ago"; 
        } 
        else { 
            return "$hrs hours ago"; 
        } 
    } 
      
    // Check for days 
    else if($days <= 7) { 
        if($days == 1) { 
            return "Yesterday"; 
        } 
        else { 
            return "$days days ago"; 
        } 
    } 
      
    // Check for weeks 
    else if($weeks <= 4.3) { 
        if($weeks == 1) { 
            return "a week ago"; 
        } 
        else { 
            return "$weeks weeks ago"; 
        } 
    } 
      
    // Check for months 
    else if($mnths <= 12) { 
        if($mnths == 1) { 
            return "a month ago"; 
        } 
        else { 
            return "$mnths months ago"; 
        } 
    } 
      
    // Check for years 
    else { 
        if($yrs == 1) { 
            return "one year ago"; 
        } 
        else { 
            return "$yrs years ago"; 
        } 
    } 
} 



while ($row = $result->fetch_assoc()) {
    // Do something with $row
		 // if you need message for one we need another select from that table to get the message for one user i
	 $message = $row['body'];
	 $sender = $row['sender_id'];
	 $message_time = $row['sent_date'];
	 
	 
	 // this part for message time 
	 $curr_time = $message_time;
	 $time_ago = strtotime($curr_time); 
     $fukyou =  time_Ago($time_ago); 
	 // message time part 
	 $new_friend_message = "";
	 $new_user_message = "";
	 
	 if ($friendid == $sender) {
		//echo "<img src='". $friend_image  ."' width='100' height='100'>Maddona : " . $message;
		

 		
		
	 	$new_friend_message = '<li class="right clearfix"><span class="chat-img pull-right"><img src="' . $friend_image . '" alt="User Avatar" class="img-circle" width="60" height="60" /></span><div class="chat-body clearfix"><div class="header"><strong class="pull-left primary-font">' . $friend_name . '</strong> <small class="text-muted">'  .  '</small></div><p>'. $message.'.</p></div></li>';
		array_push($messages, $new_friend_message);					
		
	 } 
	 
	 if ($userid == $sender) {
		$new_user_message =  '<li class="left clearfix"><span class="chat-img pull-left"><img src="' . $loged_image . '" class="img-circle" width="60" height="60" /></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">' . $loged_name .'</strong> <small class="text-muted">' .$fukyou . '</small></div><p>' . $message . '</p></div></li>';
	 	array_push($messages, $new_user_message);
	 }
     
	}
              echo json_encode(array('success' => 1, 'messages' => $messages));
			  
              //echo json_encode(array('success' => 1, 'uid' => $loged_name, 'fid' => $friend_name, 'message' => $new_message));
            }

            // end push
			
				
			
			
			
			} else {

                echo mysqli_error($con) . "don't forget about notification errors";
			}			
		
		} else {
			
			 header("location: add_message.php");
		}
   
   
   
   
   // End Of adding New Message   
   
   } else {
	   // if message empty return success 0 to know there is no message + to have better performance
	   // its important becuase we don't need add empty rows to database table messages
	   echo json_encode(array('success' => 0));
   }
    
   
}  
 // End Of the COde  

?>