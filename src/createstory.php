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

$title = $_POST['title'];
$content = $_POST['content'];
$username = $_SESSION["username"];
$zero = 0;
// add a story to table stories
$stmt = $mysqli->prepare("insert into stories (title, author, content, numcomment) values (?,?,?,?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('sssi', $title, $username, $content, $zero);

$stmt->execute();

$stmt->close();
header("refresh:2; url = homepage.php");
?>
</body>
</html>