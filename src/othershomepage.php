<!DOCTYPE html>
<html>
<?php
	 require 'database.php';
 session_start();

echo '<form action = "homepage.php" method = "POST">';
	echo "<input type = 'submit' value='view all stories'>";
	echo "</form>";
	echo "<form action = 'logout.php' method = 'post'>";
	echo "<input type = 'submit' value = 'logout'></form>";
	$user = $_POST["user"];
	// select that user's stories
$stmt = $mysqli->prepare("select title, numcomment, id from stories where author=?");

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
while($row = $result->fetch_assoc()){
	$count++;
//display titles of his/her stories in his/her own page
	echo $row["title"];
?>
 

<form action = "view.php" method = "POST">
<input type='hidden' id='story_id' name='story_id' value="<?php echo $row['id']; ?>">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />

<input type='submit' name='view' value='view'>
</form>
<?php
	echo "<br>";
}


if ($count == 0) echo "no stories published yet";

 echo "</form>";

$stmt->close();

?>
</html>