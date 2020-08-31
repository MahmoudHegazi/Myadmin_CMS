
<?php
include "includes/db.php";


if (isset($_GET['row'])) {
  $get_id = $_GET['row'];

   echo json_encode(array('success' => 1, 'tid' => $get_id));


   
   global $con;
   $sql = "DELETE FROM `todo` WHERE id=".$get_id;
   if (mysqli_query($con, $sql)) {

   } else {
     echo "Error updating record: " . mysqli_error($con);
   }

mysqli_close($con);

}



/*


*/



?>