<!DOCTYPE HTML>
<html lang="en">
<head>
 <title>my homepage</title>
</head>
<?php
 require 'database.php';
 session_start();


echo '<form action = "homepage.php" method = "POST">';
	echo "<input type = 'submit' value='view all stories'>";
	?>
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
	<?php
	echo "</form>";
	echo "<form action = 'logout.php' method = 'post'>";
	?>
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
	<?php
	echo "<input type = 'submit' value = 'logout'></form>";
	$user = $_SESSION["username"];
	// get information about the author's stories
$stmt = $mysqli->prepare("select title, numcomment,id from stories where author=?");

if(!$stmt){
	printf($mysqli->error);
	exit;
}

$stmt->bind_param('s', $user);


$stmt->execute();

$result = $stmt->get_result();
echo '</ul>';
echo '<form action = "view.php" method = "POST">';
?>
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
<?php
echo "<ul>\n";
$count = 0;
echo $user;
while($row = $result->fetch_assoc()){
	$count++;
	// output title of that story
	$title = $row["title"];
	$story_id = $row["id"];
	echo htmlentities($title);
	
?>
 

<form action = "view.php" method = "POST">
<input type='hidden' id='story_id' name='story_id' value="<?php echo $row['id']; ?>">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />

<input type='submit' name='delete' value='delete'>
<input type='submit' name='view' value='view'>
<input type='submit' name='edit' value='edit'>
</form>
<?php
	echo "<br>";
}

// if no stories is published, echo this information instead
if ($count == 0) echo "no stories published yet";

 echo "</form>";

$stmt->close();

?>
<form action = "reset.php" method = POST>
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />

<input type = submit value = "Reset my password">
<br>
</body>
</html>