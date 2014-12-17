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
<h1>DropOff Administrative Dashboard Students</h1>
<?php
	$logout_link = $_SESSION['PHP_SELF']."?task=logout";
?>
<a href="<?php echo $logout_link; ?>">Logout</a><br />
<p>

<html>
	<a href="http://ashoemaker.com/im4470/dropoff/index.php"> Home,
	<a href="http://ashoemaker.com/im4470/dropoff/course.php"> Course material
</html>

<?php 
	if ( $task == 'get_user_for_update' ) {
		echo "<h3>Update User</h3>";
	}
	else {
		echo "<h3>Insert User</h3>";
	}
?>
<form name="insert_dropoff_user" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<?php
	if ( $task == 'get_user_for_update' ) {
		echo '<input type="hidden" name="task" value="update_dropoff_user" />'."\n";
		echo '<input type="hidden" name="uid" value="'.$u->uid.'" />';		
	}
	else {
		echo '<input type="hidden" name="task" value="insert_dropoff_user" />';
	}
?>
<table bgcolor="#aaaaaa" cellspacing="1" cellpadding="3">
<tr bgcolor="#ffffff">
<td>Username:</td>
<td>
<input name="username" type="text" value="<?php echo $u->username; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td>Password:</td>
<td>
<input name="password" type="password" value="" /></td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">First Name:</td>
<td>
<input name="first_name" type="text" value="<?php echo $u->first_name; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">Last Name:</td>
<td>
<input name="last_name" type="text" value="<?php echo $u->last_name; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">Email Address:</td>
<td>
<input name="email_address" type="text" value="<?php echo $u->email_address; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">Address:</td>
<td>
<input name="address" type="text" value="<?php echo $u->address; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">City:</td>
<td>
<input name="city" type="text" value="<?php echo $u->city; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">State:</td>
<td>
<input name="state" type="text" value="<?php echo $u->state; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">Postal:</td>
<td>
<input name="postal_code" type="text" value="<?php echo $u->postal_code; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">Country:</td>
<td>
<input name="country" type="text" value="<?php echo $u->country; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">Notify:</td>
<td>
<?php
	$nvalue[$u->notify] = ' checked="true"';
?>
Yes <input name="notify" type="radio" value="Yes"<?php echo $nvalue['Yes']; ?> />
No <input name="notify" type="radio" value="No"<?php echo $nvalue['No']; ?> />
</td>
</tr>
<tr bgcolor="#ffffff">
<td>Date of Birth:</td>
<td>
<input name="dob" type="text" value="<?php echo $u->dob; ?>" /></td>
</tr>
<tr bgcolor="#ffffff">
<td>User Type:</td>
<td>
<?php
  $utselected[$u->user_type] = ' selected="true"';
?>
<select name="user_type">
<option value="Admin"<?php echo $utselected['Admin']; ?>>Admin</option>
<option value="Instructor"<?php echo $utselected['Instructor']; ?>>Instructor</option>
<option value="Student"<?php echo $utselected['Student']; ?>>Student</option>
</select>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>Status:</td>
<td>
<?php
  $sselected[$u->status] = ' selected="true"';
?>
<select name="status">
<option value="active"<?php echo $sselected[active]; ?>>Active</option>
<option value="disabled"<?php echo $sselected[disabled]; ?>>Disabled</option>
</select>
</td>
</tr>
<tr bgcolor="#ffffff">
<td colspan="2">
<input name="submit" value="Submit" type="submit" /></td>
</tr>
</table>
</form><!-- close dropoff_users form-->

<!-- start enrollment form -->
<h3>Create Enrollment</h3>
<form name="insert_dropoff_enrollment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="task" value="insert_dropoff_enrollment" />
<table bgcolor="#aaaaaa" cellspacing="1" cellpadding="3">
<tr bgcolor="#ffffff">
<td>Student:</td>
<td>
	<select name="user_id">
<?php
	while( $row = mysql_fetch_array($dou) ) {	
		echo('<option value="'.$row['uid'].'">'.$row['first_name'].' '.$row['last_name'].' ('.$row['username'].')</option>');
	}
	mysql_data_seek($dou,0);
?>
	</select>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>Course to Enroll:</td>
<td>
	<select name="course_id">
<?php
	while( $row = mysql_fetch_array($doc) ) {	
		echo('<option value="'.$row['cid'].'">'.$row['course_title'].'</option>');
	}
	mysql_data_seek($doc,0);
?>
	</select>
</td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">Session of Enrollment:</td>
<input type="hidden" name="session_id" value="1" />
<td>
1</td>
</tr>
<tr bgcolor="#ffffff">
<td height="27">Enrollment Status:</td>
<td>
<select name="status">
<option value="active">Active</option>
<option value="disabled">Disabled</option>
</select>
</td>
</tr>
<tr bgcolor="#ffffff">
<td colspan="2">
<input name="submit" value="Submit" type="submit" /></td>
</tr>
</table>
</form>
<!-- end of enrollment form -->


<?php
	// $active_link = "$_SERVER[PHP_SELF]?task=get_courses&p=active";
	// $pending_link = "$_SERVER[PHP_SELF]?task=get_courses&p=pending";
	// $archived_link = "$_SERVER[PHP_SELF]?task=get_courses&p=archived";
	$mycourses_link = "$_SERVER[PHP_SELF]?task=get_courses&p=".$user_id;
?>
<!-- <a href="<?php echo $mycourses_link; ?>">Show My Courses</a> | <a href="<?php echo $_SERVER[PHP_SELF]; ?>">Show All Courses</a> | <a href="<?php echo $active_link; ?>">Show Active Courses</a> | <a href="<?php echo $pending_link; ?>">Show Pending Courses</a> | <a href="<?php echo $archived_link; ?>">Show Archived Courses</a>  -->
<h3>Users (Faculty and Students)</h3>
<table>
<tr>
<th>Name</th><th>Username</th><th>Email Address</th><th>Notify</th><th>User Type</th><th>Status</th><th>Edit User</th><th>Delete User</th>
</tr>
<?php
  while( $row = mysql_fetch_array($dou) ) {
  	$deleteuser_link = "<a onclick=\"return confirm('Are you sure that you want to permanently delete this user from the databse?');\" href=\"$_SERVER[PHP_SELF]?task=delete_user&uid=$row[uid]\">Delete</a>";
 	$viewuser_link = "<a title=\"View Student Profile\" href=\"student_profile.php?uid=$row[uid]\">$row[first_name] $row[last_name]</a>";
 	$updateuser_link = "<a title=\"Update\" href=\"$_SERVER[PHP_SELF]?task=get_user_for_update&uid=$row[uid]\">Edit</a>";
    echo ( "<tr><td>$viewuser_link</td><td>$row[username]</td><td>$row[email_address]</td><td>$row[notify]</td><td>$row[user_type]</td><td>$row[status]</td><td>$updateuser_link</td><td>$deleteuser_link</td></tr>\n" );
  }
  // echo DOCourse::hasProjects;
?>
</table>
<p>&nbsp;</p>