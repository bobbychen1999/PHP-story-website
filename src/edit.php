<!DOCTYPE HTML>
<html lang="en">
<head>
 <title>all stories</title>
</head>
<?php
	session_start();
	require 'database.php';
	if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
	
	$stmt = $mysqli->prepare("SELECT title, content FROM stories WHERE id=?");
	$stmt->bind_param("i",$_SESSION["story_id"]);
	$stmt->execute();
	//edit an existing story in table stories
	$stmt->bind_result($title, $content);
	$stmt->fetch();
	$_SESSION["t"] = $title;
	$_SESSION["c"] = $content;
?>
<form name="editstory" action="editstory.php" method = "POST">
Title:  <?php echo $_SESSION["t"]; ?> <br>
Edit the story here: <input type='text' name='content' value="<?php echo $_SESSION["c"];?>" style="width: 600px;height: 200px">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
<input type="submit" name="create" value="Submit"></form>	
</html>