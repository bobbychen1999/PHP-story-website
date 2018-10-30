<!DOCTYPE html>
<html lang="en">
<?php
 session_start(); // start the session
 // form that passes username to verification.php
require 'database.php';
 $username = $_POST["newusername"];
 $password = $_POST["newpassword"];
 $passwordhash = password_hash ($password,PASSWORD_BCRYPT);

// add a user and the password to the databse
$stmt = $mysqli->prepare("insert into accounts (username, password) values (?,?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ss', $username, $passwordhash);

$stmt->execute();

$stmt->close();

echo "success";
header("refresh:0; url = login.php");
?>

 </body>
</html>