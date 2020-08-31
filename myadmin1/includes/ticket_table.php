
<?php 
$ticket_id = $ticket_title = $ticket_date = $ticket_creator =  "";

//$query = "SELECT * FROM maintenance";

?>



<br /><br />  
<div class="container table-responsive-sm col-mid-8" style="width:80%;">
  <table class="table table-bordered table-hover">
    <thead>
      <tr style="background-color:;color:white;">
	        <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Creator</th>
				 <th>Device</th>
                <th>Status</th>
		
      </tr>
	  </thead>
      <tbody>
<?php 
$getloged_id = $_SESSION['id'];


$query = "SELECT * FROM users WHERE id=" . $getloged_id;
$result = mysqli_query($con, $query);


while ($row = mysqli_fetch_assoc($result)) {
	 $uid = $row['id'];
	 $user = $row['name'];
	 $userimage = $row['image'];
}


// get * ticket created by loged in user 
$q = "SELECT * FROM `maintenance` WHERE creator_id=" . $uid;
$res = mysqli_query($con, $q);
$count_rows = mysqli_num_rows($res);

// if no tickets found for loged user show himm message 
if ($count_rows < 1 ) {

	echo "
    <div class='alert alert-warning alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>" .  $user . " : </strong> Did not Create Any Tickets yet.</div>";

}
while ($row = mysqli_fetch_assoc($res)) {

   
	 $ticket_title = $row['title'];
	 $ticket_id = $row['id'];
	 $ticket_creator_id = $row['creator_id'];
	 $ticket_supplier_id = $row['supplier_id'];
	 $ticket_last_employee_id = $row['last_employee_id'];
	 $ticket_device_id = $row['device_id'];
	 $ticket_price = $row['price'];
	 $ticket_date = $row['date'];
	 $ticket_status = $row['status'];

    
   
 


?> 



	  <tr>
	  <td><?php echo $ticket_id; ?></td>
	  <td><?php echo $ticket_title; ?></td>
	  <td><?php echo $ticket_date; ?></td>
	  <td><?php echo $ticket_creator_id; ?></td>
	  <td><?php echo $ticket_device_id; ?></td>


		 	<td>
			
			<div style="display:flex;align-items:center;justify-content:space-between;">
		 <select id="myticket_status" class='form-control' name='sticket_status' <?php if($ticket_status == "closed") {echo 'disabled="disabled"';}?>>
		    <option name='open' value='open' <?php if($ticket_status == "open") {echo 'selected';} ?> >Open</option>
			<option name='pending' value='pending' <?php if($ticket_status == "pending") {echo 'selected=selected';} ?> >Pending</option>
			<option name='closed' value='closed' <?php if($ticket_status == "closed") {echo 'selected=selected';} ?> >Closed</option>
			<option name='reopen' value='reopen' <?php if($ticket_status == "reopen") {echo 'selected=selected';} ?> >Re-open</option>
		 </select>
		 
	
		 </div>
		</td>
	</tr>
	
	
<?php }
 
?>

    </tbody>
  </table>
  
      <div class="alert alert-success">
           Total Tickets Created By <?php echo $user;?> : <?php echo $count_rows; ?> Tickets
      </div>

</div>





<!-- 
      <tr>
	 <td>1</td>
        <td><?php //echo $ticket_title; ?></td>
        <td>4/15/2020</td>
        <td>Mahmoud</td>

		<td>
		 <select class="form-control" name="sticket_status">
		    <option name="open" value="open">Open</option>
			<option name="pending" value="pending">Pending</option>
			<option name="closed" value="closed">Closed</option>
			<option name="reopen" value="reopen">Re-open</option>
		 </select>
		</td>
      </tr>

-->