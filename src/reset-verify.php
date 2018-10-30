<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
</head>
<body>

<?php
session_start();
require 'database.php';
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$curr = $_POST["currpw"];
$new = $_POST["newpw"];
$stmt = $mysqli->prepare("SELECT password FROM accounts WHERE username=?");
if (!$stmt) {
	echo "sql query invalid";
}
$stmt->bind_param("s", $_SESSION["username"]);
$stmt->execute();
$stmt->bind_result($pwd_hash);
$stmt->fetch();
$stmt->close();
// Compare the submitted password to the actual password hash

if(password_verify($curr, $pwd_hash)){
	// Login succeeded!
	echo "current password verified, resetting your password";
	$passwordhash = password_hash ($new,PASSWORD_BCRYPT);
	$stmt = $mysqli->prepare("update accounts set password=? WHERE username=?");
	
if (!$stmt) {
	echo "sql query invalid";
}
$stmt->bind_param("ss", $passwordhash, $_SESSION["username"]);
	$stmt->execute();
	$stmt->close();
	header("refresh:3; url=personalhp.php");
} 	else{
	// Login failed; redirect back to the login screen
		echo "Verification failed: your password doesn't match.";
		header("refresh:3; url = personalhp.php");
}
?>
</body>
</html>