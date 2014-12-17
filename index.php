<?php
	include('config_dropoff.php');
	include('check_auth.php');
	include('dropoff_classes.php');
	include('dropoff_control.php');
?>
<html>
<head>
	<title>Drop Off Project Submission System</title>
	<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dropoff.css" />
	<script type="text/javascript">
	<!--
	function checkApply(sel,rid) {
	  if (sel.options[sel.selectedIndex].value) {
	    // alert(rid);
	    document.status_form["change_list["+rid+"]"].checked = true;
	  }
	}
	-->
	</script>
	<script type="text/javascript">
	tinymce.init({
	    selector: "textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
	</script>
</head>
<body>
	
<div id="wrapper">
<h1>DropOff Administrative Dashboard Grading</h1>
<?php
	$logout_link = $_SESSION['PHP_SELF']."?task=logout";
?>
<a href="<?php echo $logout_link; ?>">Logout</a><br />
<p>

<html>
	<a href="http://ashoemaker.com/im4470/dropoff/course.php"> Course Material,
	<a href="http://ashoemaker.com/im4470/dropoff/students.php">Students
</html>
</div>
<div id="bottom">
<
<!-- Display dropoff_projects for update and delete -->
<?php
	$active_link = "$_SERVER[PHP_SELF]?task=get_projects&p=active";
	$pending_link = "$_SERVER[PHP_SELF]?task=get_projects&p=pending";
	$archived_link = "$_SERVER[PHP_SELF]?task=get_projects&p=archived";
	$myprojects_link = "$_SERVER[PHP_SELF]?task=get_projects&p=".$user_id;
?>
<a href="<?php echo $myprojects_link; ?>">Show My projects</a> | <a href="<?php echo $_SERVER[PHP_SELF]; ?>">Show All projects</a> | <a href="<?php echo $active_link; ?>">Show Active projects</a> | <a href="<?php echo $pending_link; ?>">Show Pending projects</a> | <a href="<?php echo $archived_link; ?>">Show Archived projects</a> 
<table>
<tr>
<th>Project Title</th><th>Description</th><th>Course</th><th>Author</th><th>Due Date</th><th>Submit Start</th><th>Submit End</th><th>Points</th><th>Status</th><th>Delete Project</th>
</tr>
<?php
  while( $row = mysql_fetch_array($dop) ) {
  	$deleteproject_link = "<a href=\"$_SERVER[PHP_SELF]?task=delete_project&pid=$row[pid]\">Delete</a>";
 	$updateproject_link = "<a title=\"Update\" href=\"$_SERVER[PHP_SELF]?task=get_project_for_update&pid=$row[pid]\">$row[project_title]</a>";
    echo ( "<tr><td>$updateproject_link</td><td>$row[description]</td><td>$row[course_title]</td><td>$row[first_name] $row[last_name]</td><td>$row[due_date]</td><td>$row[submit_start]</td><td>$row[submit_end]</td><td>$row[points]</td><td>$row[status]</td><td>$deleteproject_link</td></tr>\n" );
  }
?>
</table>



</body>
</html>