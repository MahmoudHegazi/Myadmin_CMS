
<?php 


global $con;
$query = "SELECT * FROM employees";
$result = mysqli_query($con, $query);
$employess_count = mysqli_num_rows($result);
if(mysqli_num_rows($result) < 1) {
	// No rows found 
    echo "<div class='alert alert-info'>
           <strong>Info!</strong> No Employess Found.
       </div>";
	   return;
} 
	// we found the rows
		 echo "<br /><div class='alert alert-success'>
           <strong>Found: </strong>" . $employess_count ." Employees</div>";

?>

    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Title</th>
		<th>Department</th>
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

        $total_pages_sql = "SELECT COUNT(*) FROM employees";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM employees LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($con,$sql);
		
$r = 0;
     while ($row = mysqli_fetch_array($res_data)) {
	     $emp_id = $row['id'];
		 $emp_name = $row['name'];
		 $emp_location = $row['location'];
		 $emp_creator = $row['creator_id'];
		 $emp_sup = $row['sup_location'];
		 $emp_resigned = $row['resigned'];
         $emp_title = $row['job_title'];
         $emp_empid = $row['employee_id'];
         $emp_dep = $row['department'];
		 $r += 1;
     
?>	

      <tr>
        <td><?php echo $emp_empid; ?></td>
        <td><?php echo $emp_name; ?></td>
        <td><?php echo $emp_title; ?></td>
		<td><?php echo $emp_dep; ?></td>

        <td>
     <button type="button" class="btn btn-success btn-sm border-success" data-toggle="modal" data-target="#myModal<?php echo $r;?>">View</button>
	 
	 <a href="<?php echo 'includes/delete_employee.php?emp=' . $emp_id; ?>">
     <button class="btn btn-danger btn btn-sm btn-info border border-success">Delete</button>
     </a>
	 <a href="<?php echo 'includes/update_employee.php?empid=' . $emp_id; ?>">
	 <button class="btn btn-info btn-sm border-success">Update</button></td>
	 </a>
      </tr>

	  
	  
<?php }


?>	  
    </tbody>
  </table>

  <!-- start of pangi ul -->
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

  
  <!-- end of ul for pangi -->

  
  <?php 
global $con;
$query = "SELECT * FROM employees";
$result = mysqli_query($con, $query);
$employess_count = mysqli_num_rows($result);
$r = 0;
       while ($row = mysqli_fetch_assoc($result)) {
	     $emp_id = $row['id'];
		 $emp_name = $row['name'];
		 $emp_location = $row['location'];
		 $emp_creator = $row['creator_id'];
		 $emp_sup = $row['sup_location'];
		 $emp_resigned = $row['resigned'];
         $emp_title = $row['job_title'];
         $emp_empid = $row['employee_id'];
         $emp_dep = $row['department'];
		 $emp_image = $row['image'];
		 $r += 1;

	   
  
  ?>

  <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $r;?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php  echo 'Employee Name: ' . $emp_name; ?> </h4>
        </div>
        <div class="modal-body">
		<div class="mx-auto d-block" style="text-align:center;">
          <img class="img-fluid" src="<?php echo $emp_image; ?>" alt="<?php echo $emp_image . ' Image'; ?>" width="300" height="300">
		  </div>
          <ul class="list-group">		  
		    <li class="list-group-item list-group-item-info " >Employee ID:  <?php  echo $emp_empid; ?></li>
            <li class="list-group-item list-group-item-success"> Title:  <?php  echo $emp_title; ?></li>
            <li class="list-group-item list-group-item-warning"> Department:  <?php  echo $emp_dep; ?></li>
            <li class="list-group-item list-group-item-info"> Location:  <?php  echo  $emp_location; ?></li>
			<li class="list-group-item list-group-item-success"> Sup Location:  <?php echo  $emp_sup; ?></li>
            <li class="list-group-item list-group-item-danger"> Resigned:  <?php  echo $emp_resigned; ?></li>
			<li class="list-group-item list-group-item-info"> System Id:  <?php  echo $emp_id; ?></li>
			<li class="list-group-item list-group-item-success"> Added By:  <?php  echo $emp_creator; ?></li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
<?php 	   }
mysqli_close($con);
 ?>