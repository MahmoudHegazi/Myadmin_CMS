
<?php 

$getloged_id = $_SESSION['id'];


$query = "SELECT * FROM users WHERE id=" . $getloged_id; //. $getloged_id;
$result = mysqli_query($con, $query);


while ($row = mysqli_fetch_assoc($result)) {
	 $uid = $row['id'];
	 $user = $row['name'];
	 $userimage = $row['image'];
}


// get * ticket created by loged in user 
$q = "SELECT * FROM `todo` WHERE user_id=" . $uid;
$res = mysqli_query($con, $q);
$count_rows = mysqli_num_rows($res);

// if no tickets found for loged user show himm message 
if ($count_rows < 1 ) {

	echo "
    <div class='alert alert-warning alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>! Hey " .  $user . ",</strong> Tasks Empty Add New Task.</div>";

}
// check title length if fit the required lengh
	 function make_title() {
		 global $task_title;
	 $title_length = strlen($task_title);
	 
	 
	 if ($title_length <= 38) {
		 $final_title = $task_title;
		 return $final_title;
	 } else {
	 while ($index <= $title_length ) {
		 $final_title +=  $index;
	 }
	    return $final_title;
	 }
	 
	 }

	 // get the q parameter from URL
if (isset($_REQUEST["q"])) {

$did_task = $_REQUEST["q"];

echo $q;

}
     $span_end = "</span>";
	 $myindex = 0;
	 while ($row = mysqli_fetch_assoc($res)) {

   
	 $task_title = $row['title'];
	 $task_id = $row['id'];
	 $task_important = $row['important'];
	 $task_finished = $row['finished'];
	 $task_create_date = $row['create_date'];
	 $task_creator = $row['user_id'];
     $myindex += 1;
	 // check if task done render done or make it done 
     if ($task_finished == 1) {
		 // This do 2 jobs check for done tasks and show nike if done, and give the parent dynamic id to help js 
		 $task_done = "<span id='niky_container" . $myindex . "'><span class='glyphicon glyphicon-ok'></span></span>";

	 } else {
		 // This do 2 jobs check for done tasks and show button if not done, and give the parent dynamic id to help js 
		 $task_done = "<span id='niky_container" . $myindex . "'><input type='button' id='finished" . $myindex .  "'  data-id='" . $task_id . "' value='Done' class='btn-xs btn-success task'/>";
	 }
    
	
	 

make_title();

?>

							<li class="todo-list-item" id="<?php echo 'row' . $myindex; ?>">
								<div class="checkbox">									
									<span data-id="<?php echo $task_id; ?>"> <?php echo $task_done; ?> </span>
									<label><?php echo $row['title']; ?></label>
								</div>
								<div class="pull-right action-buttons taskr" ><a href="#" class="trash">
									<em class="fa fa-trash" data-id="<?php echo $task_id; ?>"></em>
								</a></div>
							</li>
							
<?php } ?>	

<?php


 ?>

<script>
// Finish Task

let finished_container = document.getElementById('finished');
let niky_container = document.getElementById('nike_container');



$(document).ready(function() {

    $('.task').click(function(e) {
	
        e.preventDefault();
		let target_element = e.target;		
		let target_id = "#" + target_element.id;
		let tar_id = target_element.id;
		//$(target_id).parent().css({"color": "red", "border": "2px solid red"});
		let parent_id = target_element.parentNode.id;
		let parent = target_element.parentNode;
		let task_id = $(target_element).data("id");
		const myurl = "todo_ajax.php?que=" + task_id;
		//alert(parent_id);
        $.ajax({
            type: "GET",
            url: myurl,
			//url: 'todo_ajax.php?que=hi',
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    //alert(jsonData.task);
					target_element.style.display="none";
					parent.innerHTML = "<span class='glyphicon glyphicon-ok'></span>";
					//finished_container.innerHTML = "<span class='glyphicon glyphicon-ok'></span>";
					//location.href = 'includes/todo.php';
                }
                else
                {
                    alert("Can't Add New Task Eror 302 Contact Admin Mahmoud 01113722390.");
                }
           }
       });
	   

	   
     });
	 
	 

	 
	 // Remove Task
	 
	 
	    $('.taskr').click(function(e) {		
        e.preventDefault();
		let gettarget = e.target;		
		let parent_row = gettarget.parentElement.parentElement.parentElement;
		let newid = $(gettarget).data("id");
		
		//alert(parent_row);
		let newurl = "todo_remove_ajax.php?row=" + newid;
        $.ajax({
            type: "GET",
            url: newurl,
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);
 
                if (jsonData.success == "1")
                {
                    //alert(jsonData.tid);
					$(parent_row).css({"display": "none"});
                }
                else
                {
                    alert('Invalid Credentials!');
                }
           }
       });
     });
	 
	 
	 //
});









</script>						