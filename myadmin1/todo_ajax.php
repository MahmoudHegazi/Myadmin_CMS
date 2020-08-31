
<?php



if (isset($_GET['que'])) {
$task_id = $_GET['que'] + 0;


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myadmin1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE `todo` SET `finished`=1 WHERE id=".$task_id;


if (mysqli_query($conn, $sql)) {

} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

echo json_encode(array('success' => 1, 'task' => $task_id));
//mysqli_close($con);
}
// get the q parameter from URL
/*
if ($_GET['done']) {


} else {
echo json_encode(array('success' => 0));	
}

*/



?>