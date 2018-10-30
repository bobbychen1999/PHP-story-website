<!DOCTYPE=html>
<html>
	<form action="reset-verify.php" method="POST">
	Please enter your current password: <input type="password" name="currpw">
	Please enter the new password: <input type="password" name="newpw">
	<input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />

	<input type="submit" name="submit" value="reset my password">
</html>