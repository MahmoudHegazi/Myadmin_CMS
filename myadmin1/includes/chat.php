<?php 

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
 
 


?>
<style>
@media (min-width: 1000px) {
    .container{
        max-width: 770px;
    }
}
</style>
     
		<div class="panel panel-default chat container">
					<div class="panel-heading">
						Chat
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-2x fa-address-book color-blue" title="Open Users List"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
										
 <?php 
$query1 = "SELECT * FROM users";
$res1 = mysqli_query($con, $query1);
 while ($row = mysqli_fetch_assoc($res1)) {
	 $friend_user = $row['username'];
	 $friend_id = $row['id'];
	 $friend_name = $row['name'];
	 $friend_image = $row['image'];
	

 
 ?>
											<li><a class="friend" data-uid="<?php echo $userid; ?>" data-friend="<?php echo $friend_id; ?>">
												<em class="fa fa-cog"></em> <?php echo $friend_name; ?>
											</a></li>
											<li class="divider"></li>

											
<?php } ?>
										</ul>
										
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>							
									</li>
								</ul>
							</li>
						</ul>
						</div>
					<div class="panel-body" id="chat_cont">
						<ul id="messages_container">

						</ul>
					</div>
					<div class="panel-footer">
						<div class="input-group">

							<input id="new_message" value="" type="text" class="form-control input-md" placeholder="Type your message here..." /><span class="input-group-btn">
								<button class="btn btn-primary btn-md" id="btn-chat">Send</button>
						</span></div>
					</div>
				</div>
				
<script>
	
// if you reached this part this awesome solve the problems with less than 4 hours chat what if i build chat in 3 months 	
let ulmessages = document.getElementById("messages_container");

let getdata = document.querySelectorAll('.friend');


let static_uid = null;
let static_fid = null;

function update_ids(user, friend) {
	static_uid = user;
	static_fid = friend;

}
// get the message by click on a friend 
$(document).ready(function() {
    $('.friend').click(function(e) {		
        e.preventDefault();
        let target_element = e.target;
		let uid = $(target_element).attr("data-uid");
		let fid = $(target_element).attr("data-friend");
        update_ids(uid, fid);
		let myurl = `chat_handle_ajax.php?uid=${uid}&fid=${fid}`;

		
		//alert(myurl);
		$.ajax({
            type: "GET",
            url: myurl,
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                ulmessages.innerHTML = "";

			//let arr = jsonData.messages.split(",");
			    
                    jsonData.messages.forEach((message) => {
						//alert(message);
						ulmessages.innerHTML += message;
					}

					)
					//alert(jsonData.messages[0]);
					//target_element.style.display="none";
					//parent.innerHTML = "<span class='glyphicon glyphicon-ok'></span>";
					//finished_container.innerHTML = "<span class='glyphicon glyphicon-ok'></span>";
					//location.href = 'includes/todo.php';
                }
                else
                {
                    alert('Invalid Credentials!');
                }
           }
       });
	   
     });
});






//let chat_container = document.querySelector("#chat_cont");
//chat_container.scrollTo(0, chat_container.scrollHeight);
let xx = document.querySelector("#chat_cont");

//alert(x.scrollHeight);



let empty_index = 0;
$(document).ready(function() {
    $('#btn-chat').click(function(e) {		
        e.preventDefault();
        //let target_element = e.target;
		//let uid = static_uid;
		//let fid = static_fid;

		let newmessage = $("#new_message").val();

		// empty text input for message after send it 
		$("#new_message").val("");

		
		//alert(newmessage);
		
		let myurl = `add_message.php?uid=${static_uid}&fid=${static_fid}&message=${newmessage}`;


		//alert(myurl);
		$.ajax({
            type: "GET",
            url: myurl,
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);
                
                // user is logged in successfully in the back-end
                // let's redirect
				 
                if (jsonData.success == "1")
                {
                //alert(jsonData.uid);
				//alert(jsonData.fid);
				//alert(jsonData.message);
				ulmessages.innerHTML = "";

			//let arr = jsonData.messages.split(",");
			   
				
				
                    jsonData.messages.forEach((message) => {
						//alert(message);
						ulmessages.innerHTML += message;
						xx.scrollTo(0, xx.scrollHeight);
					}

					)
					
					
					//alert(jsonData.messages[0]);
					//target_element.style.display="none";
					//parent.innerHTML = "<span class='glyphicon glyphicon-ok'></span>";
					//finished_container.innerHTML = "<span class='glyphicon glyphicon-ok'></span>";
					//location.href = 'includes/todo.php';
                }
                else
                {
					
					// inform user only 1 time  how he can send message
					empty_index += 1;
					xx.scrollTo(0, xx.scrollHeight);
					if (empty_index < 2) {
                    alert('Please Insert Your Message And Click Send');
					
					}
                }
           }
       });
	   
     });
});







// ####################################################################
//  Chat Updater every 10 seconds
// ####################################################################





// get the message by click on a friend 
$(document).ready(function() {
let update;

function updater() {
  update = setTimeout(update_callback, 10000);
}

function update_callback() {
         const counter_noti = document.getElementById("my_noti");
         const index_messages = document.getElementById("bemo");
	    
	    if (static_uid != null && static_fid != null) {
	     //alert(static_uid + static_fid);
		 let myurl = `updater.php?uid=${static_uid}&fid=${static_fid}`;
  		  $.ajax({
            type: "GET",
            url: myurl,
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response); 

                if (jsonData.success == "1")
                {
					
                ulmessages.innerHTML = "";

                     // update notification and messages number (total)
			        //index_notifications.textContent = jsonData.total_notifications;
					//index_messages.textContent = '16';
					
					counter_noti.textContent = jsonData.total;
					index_messages.textContent = jsonData.total_message;
					// update messages on time 
                    jsonData.messages.forEach((message) => {
						
						ulmessages.innerHTML += message;

					}

					)
  
                }
                else
                {
                    //sucess != 1
					
                }
           }
       });
		
		} else {
			
			// static_uid and static_fid  == null
			//alert('nothing');
			
		}
		
updater();

}
updater();

/*
        e.preventDefault();
        let target_element = e.target;
		let uid = $(target_element).attr("data-uid");
		let fid = $(target_element).attr("data-friend");
        update_ids(uid, fid);
		let myurl = `chat_handle_ajax.php?uid=${uid}&fid=${fid}`;

		
		//alert(myurl);
		$.ajax({
            type: "GET",
            url: myurl,
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response); 

                if (jsonData.success == "1")
                {
                ulmessages.innerHTML = "";

			//let arr = jsonData.messages.split(",");
			    
                    jsonData.messages.forEach((message) => {
						//alert(message);
						ulmessages.innerHTML += message;
					}

					)

                }
                else
                {
                    //sucess != 1
                }
           }
       });
	   
	   */
	   

});






</script>	
				