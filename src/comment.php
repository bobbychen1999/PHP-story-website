<!DOCTYPE HTML>
<html lang="en">
<head>
 <title>comment</title>
</head>
<?php
	session_start();
	require 'database.php';
	if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }

	$comment = $_POST['comment'];
$zero = 0;
// add the comment to the table
$stmt = $mysqli->prepare("insert into comment (author,content,story) values (?,?,?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('ssi', $_SESSION["username"],$comment, $_SESSION["story_id"]);



$stmt->execute();

$stmt->close();
echo "success";
header("refresh:2; url = homepage.php");
?>

</html>