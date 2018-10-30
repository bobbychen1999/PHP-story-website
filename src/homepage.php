<!DOCTYPE HTML>
<html lang="en">
<head>
 <title>all stories</title>
</head>
<?php

 require 'database.php';
 session_start();

 // check if it is a registered user or a guest 
 //guest
 if ($_SESSION["username"] == "") {
	echo '<form action = "login.php" method = "POST">';
	echo '<input type="hidden" name="token" value=$_SESSION["token"]>';

	echo "<input type='submit' value ='login'>";
	echo "</form>";
}
//registered user
else {
	echo '<form action = "personalhp.php" method = "POST">';
	?>
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
	<?php
		echo "<input type = 'submit' value= 'my homepage'>";
	echo "</form>";
	echo '<form action = "allusers.php" method = "POST">';
	?>
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
	<?php
		echo "<input type = 'submit' value= 'all users'>";
	echo "</form>";
	echo "<form action = 'logout.php' method = 'post'>";
	?>
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
	<?php

	echo "<input type = 'submit' value = 'logout'></form>";

	echo '<form action = "addstory.php" method = "POST">';
?>
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
<?php
	echo "<input type = 'submit' value='tell my story'>";
	echo "</form>";
}

echo "<br>";
echo '<form action = "search.php" method = "POST">';
echo "<input type='text' name='search' value = 'Type the exact name of the title of the story!'>";
?>
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
<?php
echo "<input type='submit' value='search'>";
echo "</form>";


$stmt = $mysqli->prepare("select title, author, numcomment, id from stories order by id");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$result = $stmt->get_result();


echo "</ul>\n";
 
 // iterate to display the information of author and story
echo "<ul>\n";
$count = 0;


while($row = $result->fetch_assoc()){
	$count++;
	$title = $row["title"];
	$story_id = $row["id"];
	//echo "<input type='radio' name='FILE' value=$title>","<span>";
	printf("\t<li>%s %s</li>\n",
		//打点东西
		htmlspecialchars( $row["title"] ),
		htmlspecialchars( $row["author"] )
	);
//	echo "<input type='hidden' name='story_id' value='story_id";
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

</body>
</html>
