<!-- Check if user loged in or not if not redirect to login page -->
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
// tried: is to check if user redirected from unathurized page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: includes/login.php?tried=yes");
    exit;
}
?>
<!-- check login end -->

<!-- Header Start -->
<?php include "includes/header.php"; ?>
<!-- Header End -->

<!-- #-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-# -->

<!-- sidebar start -->
<?php include "includes/aside.php"; ?>
<!--/.sidebar-->


<!-- Add Handle Login get loged user deatlis -->
<?php include "includes/handle_login.php"; ?>
<!-- end of login handle -->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	   <!-- Dashboard start -->
	     <?php include "includes/dashbaord.php"; ?>
		<!--/.row-->
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="easypiechart-panel">
						<h4>Ticket Precent</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="92"><span class="percent"><?php echo 
						$ticket_precent; ?>%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Ticket Created</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent"><?php echo 
						$ticket_count; ?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Messages Recived</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent"><?php echo $messages_count; ?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Not Finshed Tasks</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent"><?php echo $todo_count ?></span></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		
		
		<div class="row">
			<div class="col-md-11">
			<!-- chat start -->
			<!-- ================================== -->
			<!-- ============Chat============== -->
			<!-- ================================== -->
			
		      <!-- ?php include "includes/chat.php"; ?> -->
				<!-- chat end -->
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color:#ccffcc;">
						To-do List
						<ul class="pull-right panel-settings panel-button-tab-right">

								<em class="fa fa-lg fa-tasks color-blue"></em>

								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 1
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 2
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 3
											</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						</div>
					<div class="panel-body">
						<ul class="todo-list">
						
						  <!-- todo start -->

							<?php include 'includes/todo.php'; ?>
							<!-- todo end -->
						</ul>
					</div>
					<div class="panel-footer">
						
						<form  action="includes/add_task.php" method="post" role="form" enctype="multipart/form-data">
						<div class="input-group">
							<input id="btn-input1" type="text" name="task" class="form-control input-md" placeholder="Add new task" /><span class="input-group-btn">
								<button type="submit" class="btn btn-primary btn-md" id="btn-todo">Add</button></span>
								</div>
						</form>		
						</div>
					</div>
				</div>
			</div>			
			<!--/.col-->
			
			
            <!-- timeline start -->
			
            <!-- ================================== -->
			<!-- ============TimeLine============== -->
			<!-- ================================== -->
			<!-- ?php include "includes/timeline.php"; ?> -->

			<!-- timeline end -->
		
		
		<!-- tickets table -->
				<div class="row">
			<div class="col-md-6">
			<!-- chat start -->

			<?php include "includes/chat.php"; ?>
			<!-- chat end -->
				</div>
			</div><!--/.col-->
		
		<!-- tickets -->
					<div class="col-sm-11 ">
				<p class="back-link">Developed By <a href="https://2wenos.co">Mahmoud Hegazy</a></p>
			</div>
		
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>


	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>