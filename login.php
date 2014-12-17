<html>
<head>
	<title>News Project</title>
	<style type="text/css">
	body {
		font-family: Helvetica, Arial, san-serif;
	}
	</style>
</head>
<body>
<?php
	if (!empty($_GET['message'])) {
		echo "$_GET[message]<br />"; 
	}
?>
<form action="auth_user.php" method="post">
<table bgcolor="#aaaaaa" cellspacing="1" cellpadding="3">
<tr bgcolor="#ffffff">
<td> Username: <input type="text" name="username" /><br /></td>
<tr bgcolor="#ffffff">
<td>Password: <input type="password" name="password" /><br /></td>
<tr bgcolor="#ffffff">
<td><input type="submit" value="Login" />
<a href="http://ashoemaker.com/im4470/dropoff/register.php"> Register
</td>
</form>
</body>
</html>