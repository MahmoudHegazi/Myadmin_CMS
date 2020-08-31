
<?php 


global $con;
$query = "SELECT * FROM suppliers";
$result = mysqli_query($con, $query);
$suppliers_count = mysqli_num_rows($result);
if(mysqli_num_rows($result) < 1) {
	// No rows found 
    echo "<div class='alert alert-info'>
           <strong>Info!</strong> No Suppliers Found.
       </div>";
	   return;
} 
	// we found the rows
		 echo "<br /><div class='alert alert-success'>
           <strong>Found: </strong>" . $suppliers_count ." Suppliers</div>";

?>

    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Mobile</th>
		<th>Image</th>
		<th>Action</th>
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

        $total_pages_sql = "SELECT COUNT(*) FROM suppliers";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM suppliers LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($con,$sql);

$r = 0;
    
     while($row = mysqli_fetch_array($res_data)){
	     $supp_id = $row['sup_id'];
		 $supp_name = $row['name'];
		 $supp_mobile = $row['mobile'];
		 $supp_image = $row['sup_image'];
		 $sup_history = $row['sup_history'];
		 $sup_extra = $row['extra_data'];
		 $r += 1;
		 

?>	

      <tr>
        <td><?php echo $supp_id; ?></td>
        <td><?php echo $supp_name . $r; ?></td>
        <td><?php echo $supp_mobile; ?></td>
		
	
		
		
		<td><img src="<?php echo $supp_image; ?>" width="50" height="50" alt="<?php echo $supp_name . ' profile photo'; ?>"></td>
        <td>
 <button type="button" class="btn btn-success btn-sm border-success" data-toggle="modal" data-target="#myModal<?php echo $r;?>">View</button>
	 
	 
	 
     <a href="<?php echo 'includes/delete_supplier.php?sup=' . $supp_id; ?>">
	 <button class="btn btn-danger btn btn-info btn-sm border border-success">Delete</button>
     </a>
	 <a href="<?php echo 'includes/update_supplier.php?supid=' . $supp_id; ?>">
	 <button class="btn btn-info btn-sm border-success">Update</button>
	 </a>

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
$query = "SELECT * FROM suppliers";
$result = mysqli_query($con, $query);
$employess_count = mysqli_num_rows($result);
$r = 0;

   while ($row = mysqli_fetch_assoc($result)) {
     $sup_id = $row['sup_id'];
     $sup_name = $row['name'];
	 $sup_mobile = $row['mobile'];
	 $sup_image = $row['sup_image'];
	 $sup_history = $row['sup_history'];
	 $sup_extra = $row['extra_data'];
	 $r += 1; 

	   
  
  ?>

  <div class="modal fade" id="myModal<?php echo $r;?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php  echo 'Supplier Name: ' . $sup_name; ?> </h4>
		  <div class="mx-auto d-block" style="text-align:center;">
          <img class="img-fluid" src="<?php echo $sup_image; ?>" alt="<?php echo $sup_name . ' Image'; ?>" width="300" height="300">
		  </div>
        </div>
        <div class="modal-body">
          <ul class="list-group">
		    <li class="list-group-item list-group-item-info " >Supplier ID:  <?php  echo $sup_id; ?></li>
            <li class="list-group-item list-group-item-primary"> Name:  <?php  echo $sup_name; ?></li>
            <li class="list-group-item list-group-item-success"> Mobile:  <?php  echo $sup_mobile; ?></li>

          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
<?php    }  mysqli_close($con); ?>





