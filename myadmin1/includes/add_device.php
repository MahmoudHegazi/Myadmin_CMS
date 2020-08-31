<?php 
include 'db.php';


// check if the device set or the add link clicked
if (isset($_GET['add'])) {

  
  // function for secuirty
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
   }
   
   echo $get_id;
   

// get all devices data   
 /*  
   global $con;
$sql = "INSERT INTO `workstation`(`id`, `service_tag`, `manufacture`, `purchased_date`, `supplier_id`,
 `price`, `history`, `status`, `images`, `model`, `type`)
 VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11])"


if (mysqli_query($con, $sql)) {

} else {
  echo "Error updating record: " . mysqli_error($con);
}
*/

}   


   /*
   UPDATE `workstation` SET `id`=[value-1],`service_tag`=[value-2],`manufacture`=[value-3],`purchased_date`=[value-4],`supplier_id`=[value-5],`price`=[value-6],`history`=[value-7],`status`=[value-8],`images`=[value-9],`model`=[value-10],`type`=[value-11] WHERE 1
   */
 /*  


*/
?>