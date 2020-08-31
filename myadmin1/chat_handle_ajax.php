
<?php

include "includes/db.php";


$user_id = $_GET['uid'];
$friend_id = $_GET['fid'];


/*Get Loged user name */
$stmt = $con->prepare('SELECT * FROM users WHERE id= ?');
$stmt->bind_param('i', $user_id); 
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    // Do something with $row
	 $loged_name = $row['name'];
	 $loged_image = $row['index_image'];
}

 
 /*Get friend user name */
$stmt = $con->prepare('SELECT * FROM users WHERE id= ?');
$stmt->bind_param('i', $friend_id); 
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    // Do something with $row
	$friend_name = $row['name'];
	$friend_image = $row['index_image'];
}


$stmt = $con->prepare('SELECT body, sender_id FROM messages WHERE sender_id = ? AND reciver_id= ? OR sender_id = ? AND reciver_id = ? ORDER BY sent_date ASC');
$stmt->bind_param('iiii', $user_id, $friend_id, $friend_id, $user_id); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();
$messages = [];
while ($row = $result->fetch_assoc()) {
    // Do something with $row
		 // if you need message for one we need another select from that table to get the message for one user i
	 $message = $row['body'];
	 $sender = $row['sender_id'];
     
	 $new_friend_message = "";
	 $new_user_message = "";
	 
	 if ($friend_id == $sender) {
		//echo "<img src='". $friend_image  ."' width='100' height='100'>Maddona : " . $message;
		

 		
		
	 	$new_friend_message = '<li class="right clearfix"><span class="chat-img pull-right"><img src="' . $friend_image . '" alt="User Avatar" class="img-circle" width="60" height="60" /></span><div class="chat-body clearfix"><div class="header"><strong class="pull-left primary-font">' . $friend_name . '</strong> <small class="text-muted">6 mins ago</small></div><p>'. $message.'.</p></div></li>';
		array_push($messages, $new_friend_message);					
		
	 } 
	 
	 if ($user_id == $sender) {
		$new_user_message =  '<li class="left clearfix"><span class="chat-img pull-left"><img src="' . $loged_image . '" class="img-circle" width="60" height="60" /></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">' . $loged_name .'</strong> <small class="text-muted">32 mins ago</small></div><p>' . $message . '</p></div></li>';
	 	array_push($messages, $new_user_message);
	 }
     
	}
echo json_encode(array('success' => 1, 'messages' => $messages));


?>