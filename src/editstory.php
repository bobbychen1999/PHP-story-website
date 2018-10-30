<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
</head>
<body>

<?php
session_start();
require 'database.php';
// edit an existing story
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
$content = $_POST['content'];
$zero = 0;
$stmt = $mysqli->prepare("update stories set content = ? where id = ?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('si', $content, $_SESSION["story_id"]);

$stmt->execute();

$stmt->close();
header("refresh:2; url = homepage.php");
?>
</body>
</html>