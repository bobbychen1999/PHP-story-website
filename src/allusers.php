<!DOCTYPE html>
<html>
<?php
	require "database.php";
	session_start();
	if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
	$stmt = $mysqli->prepare("SELECT username from accounts");
	$stmt->execute();
	$result = $stmt->get_result();
	echo "</ul>\n";
	echo '<form action = "othershomepage.php" method = "POST">';
 // iterate to display all users here
 //always click the radio button before view the personal page
	echo "<ul>\n";
	$count = 0;
	while($row = $result->fetch_assoc()){
		$count++;
		$name = $row["username"];
		if ($name != $_SESSION["username"]) {
			echo "<input type='radio' name='user' value=$name>","<span>";
			echo $name;
			echo "<input type='submit' name='view' value='view his/her homepage'>";
			echo "<br>";
		}
	}
	if ($count == 0) echo "no users registered yet";
	echo "</form>";

	$stmt->close();
?>
</html>