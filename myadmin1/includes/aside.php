<?php include 'db.php'; ?>
<!-- Check if user loged in or not if not redirect to login page -->

<!-- check login end -->
<?php
/* inner search query 
$query = "SELECT messages.subject, users.myid FROM messages INNER JOIN users ON messages.sender_id = users.myid AND messages.sender_id = 1";
*/  


include 'handle_login.php';
// get the loged user name from the session



$userid = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id=" . $userid;
$res = mysqli_query($con, $query);
 while ($row = mysqli_fetch_assoc($res)) {
	 $user_username = $row['username'];
	 $user_name = $row['name'];
	 $user_image_aside = $row['index_image'];
	
 }

	



 


$current_page = $_SERVER["PHP_SELF"];
$index_page  = '/myadmin1/index.php';
$employess_page  = '/myadmin1/employees.php';
$suppliers_page  = '/myadmin1/suppliers.php';
$workstation_page  = '/myadmin1/workstation.php';




?>


<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>My</span>Admin</a>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-envelope"></em><span id="bemo" class="label label-danger"><?php echo $messages_count; ?></span>
					</a>
						<ul class="dropdown-menu dropdown-messages">
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="<?php echo $user_image_aside; ?>" height="40" width="40">
									</a>
									<div class="message-body"><small class="pull-right">3 mins ago</small>
										<a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
									<br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="<?php echo $user_image_aside; ?>" height="40" width="40">
									</a>
									<div class="message-body"><small class="pull-right">1 hour ago</small>
										<a href="#">New message from <strong>Jane Doe</strong>.</a>
									<br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="all-button"><a href="#">
									<em class="fa fa-inbox"></em> <strong>All Messages</strong>
								</a></div>
							</li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span id="my_noti" class="label label-info"><?php echo $notifications_count; ?></span>
					</a>

						<ul class="dropdown-menu dropdown-alerts">
<?php 
					// get the last notification set as new
$newquery = "SELECT * FROM notifications WHERE reciver_id =" . $uid . " ORDER BY id DESC LIMIT 1";

$newres = mysqli_query($con, $newquery);
while ($row = mysqli_fetch_assoc($newres)) {

	 $new_id = $row['id'];
}

$newquery1 = "SELECT * FROM notifications WHERE reciver_id =" . $uid . " ORDER BY id ASC LIMIT 5";

$newres1 = mysqli_query($con, $newquery1);
while ($row1 = mysqli_fetch_assoc($newres1)) {

	 if ($last_id = $row1['id'])break;
}
?>


					
<?php 
					// get notifications detials for looged used 
$query = "SELECT * FROM notifications WHERE reciver_id =" . $uid . " ORDER BY id DESC LIMIT 5";

$res = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($res)) {

	 $notifications_content = $row['content'];
	 $notifications_reciver = $row['reciver_id'];
	 $notifications_title = $row['title'];
	 $notifications_date = $row['date'];
	 $notifications_id = $row['id'];
?>
							<li><a href="#">
								<div><em class="fa fa-envelope"></em><?php 
								if ($notifications_id == $new_id) {
									echo "<span class='indicator label-success pull-right'></span> <span class='pull-right' style='margin-right:4px;margin-top:-4px;'> new</span>";
									} 							
									?> <?php

								echo $notifications_date . '<br><br>'; 


								?>
									<span class="pull-left text-muted big"><?php 
							 
									echo $notifications_content; ?></span></div>
							</a></li>
							<li <?php if ($notifications_id == $last_id) {
                                  $got_last = "<br><br> <p class='text-center'>See More...</p>";
								  
							} else {
   								  echo 'class="divider"';
							}
								?>><?php echo $got_last; ?></li>
<?php } ?>							
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
			
			    <!-- user  image -->
				<img src="<?php echo $user_image_aside; ?>" class="img-responsive" alt="<?php echo $user_name . 'profile picture image'; ?>">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $user_username;?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
		





			<li class="<?php if ($current_page == $index_page ) {echo "active";} ?>"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<!-- <li><a href="./widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li> -->
			<li class="<?php if ($current_page == $employess_page ) {echo "active";} ?>"><a href="./employees.php"><em class="fa fa-users">&nbsp;</em> Employees</a></li>
			<li class="<?php if ($current_page == $suppliers_page ) {echo "active";} ?>"><a href="./suppliers.php"><em class="fa fa-cc-visa">&nbsp;</em> Suppliers</a></li>
			<li class="<?php if ($current_page == $workstation_page ) {echo "active";} ?>"><a href="./workstation.php"><em class="fa fa-diamond">&nbsp;</em> Workstation</a></li>
			
			<!-- you need one like this on your server droopdown nav item 
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li>
			-->
			<li><a href="includes/logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div>