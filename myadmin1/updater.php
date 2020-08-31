
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


if (isset($_GET['uid']) && isset($_GET['fid'])) {
	
  $userid = test_input($_GET['uid']);
  $friendid = test_input($_GET['fid']);


 // get total loged user notifications
$query = "SELECT COUNT(id) FROM notifications WHERE reciver_id=" .$userid;
$res = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($res)) {

	 $notifications_count = $row['COUNT(id)'];
}




// get message recived by loged user 
$query = "SELECT COUNT(id) FROM messages WHERE reciver_id=" . $userid;
$res = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($res)) {

	 $messages_count = $row['COUNT(id)'];
} 
  
   
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
     $mytime_ago =  time_Ago($time_ago); 
	 // message time part 
	 $new_friend_message = "";
	 $new_user_message = "";
	 
	 if ($friendid == $sender) {
		//echo "<img src='". $friend_image  ."' width='100' height='100'>Maddona : " . $message;
		

 		
		
	 	$new_friend_message = '<li class="right clearfix"><span class="chat-img pull-right"><img src="' . $friend_image . '" alt="User Avatar" class="img-circle" width="60" height="60" /></span><div class="chat-body clearfix"><div class="header"><strong class="pull-left primary-font">' . $friend_name . '</strong> <small class="text-muted">'  .$mytime_ago.  '</small></div><p>'. $message.'.</p></div></li>';
		array_push($messages, $new_friend_message);					
		
	 } 
	 
	 if ($userid == $sender) {
		$new_user_message =  '<li class="left clearfix"><span class="chat-img pull-left"><img src="' . $loged_image . '" class="img-circle" width="60" height="60" /></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">' . $loged_name .'</strong> <small class="text-muted">' .$mytime_ago . '</small></div><p>' . $message . '</p></div></li>';
	 	array_push($messages, $new_user_message);
	 }
     
	}
              echo json_encode(array('success' => 1, 'messages' => $messages, 'total_message' => $messages_count, 'total' => $notifications_count));
			  
              //echo json_encode(array('success' => 1, 'uid' => $loged_name, 'fid' => $friend_name, 'message' => $new_message));


            // end push
			
				
			
			
			
			} else {

                echo mysqli_error($con) . "don't forget about notification errors";
				//echo json_encode(array('success' => 0));
			}			
		

   
   
   
   
   // End Of adding New Message   
   

    
   
 
 // End Of the COde  

?>