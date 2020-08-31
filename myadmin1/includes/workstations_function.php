		 <!-- delete -->

<?php 


global $con;
$query = "SELECT * FROM workstation";
$result = mysqli_query($con, $query);
$devices_count = mysqli_num_rows($result);
if(mysqli_num_rows($result) < 1) {
	// No rows found 
    echo "<div class='alert alert-info'>
           <strong>Info!</strong> No Device Found.
       </div>";
	   return;
} 
	// we found the rows
		 echo "<br /><div class='alert alert-success'>
           <strong>Found: </strong>" . $devices_count ." Devices</div>";

?>

    <thead>
      <tr>
        <th>ID</th>
        <th>Service Tag</th>
        <th>purchased</th>
        <th>Supplier</th>
	<th>Price</th>
	<th>Actions</th>
      </tr>
    </thead>
    <tbody>
	
<?php 



        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;

   
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

        $total_pages_sql = "SELECT COUNT(*) FROM workstation";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM workstation LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($con,$sql);
$r = 0;
     while ($row = mysqli_fetch_array($res_data)) {
	     $device_id = $row['id'];
		 $device_tag = $row['service_tag'];
         $device_man = $row['manufacture'];
		 $device_purchased = $row['purchased_date'];
		 $device_supplier_id = $row['supplier_id'];
		 $device_price = $row['price'];
		 $device_history = $row['history'];
		 $device_status = $row['status'];
		 $device_images = $row['images'];
		 $device_model = $row['model'];
		 $device_type = $row['type'];
		 $r += 1;
		 $super_query = "SELECT name FROM suppliers WHERE sup_id=" . $device_supplier_id;
		 $res1 = mysqli_query($con, $super_query);
		 while ($record1 = mysqli_fetch_assoc($res1)) {
			$supp_name = $record1['name'];
		 }		 
?>	

      <tr>
        <td><?php echo $device_id; ?></td>
        <td><?php echo $device_tag; ?></td>
        <td><?php echo $device_purchased; ?></td>
		<td><?php echo $supp_name; ?></td>
		<td><?php echo $device_price; ?></td>
        <td>
		<button type="button" class="btn btn-success border-success btn-sm" data-toggle="modal" data-target="#myModal<?php echo $r;?>">View</button>
		
		<a href='workstation.php?delete_device=<?php echo $device_id; ?>'><button class="btn btn-danger btn-sm">Delete</button></a>
		<a href="<?php echo 'includes/update_workstation.php?device=' . $device_id; ?>">
		<button class="btn btn-info btn-sm">update</button>
		</a>
		<!-- update_workstation-->
		</td>
      </tr>

<?php }

?>	  
    </tbody>
  </table>
        <ul class="pagination" style="display:flex;justify-content:center;">
        <li><a href="?pageno=1" style="background-color:darkblue;color:white;font-family:lemon;font-weight:bold;">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>" style="background-color:crimson;color:white;font-family:lemon;font-weight:bold;">Last</a></li>
    </ul>

  
  
 <?php
global $con;
$query = "SELECT * FROM workstation";

$result = mysqli_query($con, $query);
$devices_count = mysqli_num_rows($result);
$r = 0;
     while ($row = mysqli_fetch_assoc($result)) {
	     $device_id = $row['id'];
		 $device_tag = $row['service_tag'];
         $device_man = $row['manufacture'];
		 $device_purchased = $row['purchased_date'];
		 $device_supplier_id = $row['supplier_id'];
		 $device_price = $row['price'];
		 $device_history = $row['history'];
		 $device_status = $row['status'];
		 $device_images = $row['images'];
		 $device_model = $row['model'];
		 $device_type = $row['type'];
		 $r += 1;
		 $sup_query = "SELECT name FROM suppliers WHERE sup_id=" . $device_supplier_id;
		 $res = mysqli_query($con, $sup_query);
		 
		 while ($record = mysqli_fetch_assoc($res)) {
			$supplier_name = $record['name'];
		 }
?>
  

  <div class="modal fade" id="myModal<?php echo $r;?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php  echo 'Service Tag: ' . $device_tag; ?> </h4>
        </div>
        <div class="modal-body">
		
				<div class="mx-auto d-block" style="text-align:center;">
          <img class="img-fluid" src="<?php echo $device_images; ?>" alt="<?php echo $device_images . ' Image'; ?>" width="300" height="300">
		  </div>
          <ul class="list-group">
		    <li class="list-group-item list-group-item-info " >ID:  <?php  echo $device_id; ?></li>
			<li class="list-group-item list-group-item-success"> Type:  <?php  echo $device_type; ?></li>
			<li class="list-group-item list-group-item-success"> Status:  <?php  echo $device_status; ?></li>
            <li class="list-group-item list-group-item-primary"> Manufacture:  <?php  echo $device_model; ?></li>
			<li class="list-group-item list-group-item-primary"> Model:  <?php  echo $device_man; ?></li>
            <li class="list-group-item list-group-item-success"> purchased date:  <?php  echo $device_purchased; ?></li>
		    <li class="list-group-item list-group-item-info " > Supplier:  <?php  echo $supplier_name; ?></li>
            <li class="list-group-item list-group-item-primary"> Price:  <?php  echo $device_price; ?></li>
            <li class="list-group-item list-group-item-success"> Status:  <?php  echo $device_status; ?></li>			
          </ul>
		   
	
		     <!-- Supplier History -->
			 <h2>History</h2>
             <p><?php echo $device_history; ?></p>
      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
		 <?php  } mysqli_close($con);?>  
		 
		 
		 


