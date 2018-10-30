<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>verification</title>
</head>
<body>
<?php
session_start();
	require 'database.php';
	//require database everytime
$_SESSION["username"] = "";
// Use a prepared statement
$stmt = $mysqli->prepare("SELECT password FROM accounts WHERE username=?");
if (!$stmt) {
	echo "guobuqua";
}
// Bind the parameter
$user = $_POST['username'];
//check if the username is empty
if ($user === "") {
	echo "The username you typed in is empty";
	header("refresh:0; url = login.php");
	exit;
}

$stmt->bind_param('s', $user);

$stmt->execute();
// Bind the results
$stmt->bind_result($pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['password'];
// Compare the submitted password to the actual password hash
if(password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
	$_SESSION['username'] = $user;
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));

	
	// Redirect to your target page
	header("refresh:0; url = homepage.php");
} else{
	// Login failed; redirect back to the login screen
	echo "password::";
	echo $pwd_guess;
	echo $pwd_hash;
	echo "Login failed: your password doesn't match the username.";
	header("refresh:1; url = login.php");
}
?>
</body>
</html>