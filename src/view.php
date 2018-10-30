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

// when the user clicked the delete button
if (isset($_POST["delete"])) {

    //delete the comments first
    $stmt = $mysqli->prepare("DELETE from comment where story=?");

	if (!$stmt) {
		echo "guobuqua";
	}
	$stmt->bind_param('s', $_POST["story_id"]);
    $stmt->execute();
    $stmt->close();
// then delete the story
    $stmt = $mysqli->prepare("DELETE from stories where id=?");

	if (!$stmt) {
		echo "guobuqua";
	}
	$stmt->bind_param('s', $_POST["story_id"]);
	$stmt->execute();
	echo "story deleted";
	header("refresh:2;url=personalhp.php");
}

// when the user clicked the edit button
if (isset($_POST["edit"])) {
	$_SESSION["story_id"] = $_POST["story_id"];
	header("refresh:1;url=edit.php");
}

// when the user clicked the view button
if (isset($_POST["view"])){
 $stmt = $mysqli->prepare("SELECT content FROM stories WHERE id=?");
if (!$stmt) {
echo "guobuqua";
}
// Bind the parameter
$stmt->bind_param('s', $_POST["story_id"]);

$stmt->execute();

// Bind the results
$stmt->bind_result($content);
$stmt->fetch();
$str = $content;
echo htmlentities($str);
echo "<br><br><br>";

// if the user is a registered user, here is the place to make comments
if ($_SESSION["username"]!=""){
    echo "<form action = 'comment.php' method = 'POST'>";
    echo "comment: <input type = 'text' name = 'comment'style='width: 200px;height: 50px'>";
    ?>
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
    <?php
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
    }
    $stmt->close();
    $stmt = $mysqli->prepare("select author, content, id from comment where story = ?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $_POST["story_id"]);
    $_SESSION["story_id"] = $_POST["story_id"];
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    
    echo "</ul>\n";
     echo "<ul>\n";
    $count = 0;
    while($row = $result->fetch_assoc()){
        $count++;
    
    
        printf("\t<li>%s %s</li>\n",
            //display all the existed comments
            htmlspecialchars( $row["author"] ),
            htmlspecialchars( $row["content"] )
        );
        if ($_SESSION["username"]==$row["author"]){

        ?>
 
<form action = "commentaction.php" method = "POST">
<input type='hidden' id='comment_id' name='comment_id' value="<?php echo $row['id']; ?>">
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />

<input type='submit' name='delete' value='delete'>
<input type='submit' name='edit' value='edit'>
</form>
<?php
        }
	echo "<br>";
    }
    
    if ($count == 0) echo "no comment yet";
}
echo "<form action = 'homepage.php' method = 'POST'>";
?>
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
<?php
echo "<input type = 'submit' value = 'back to homepage'>";
echo "</form>";

?>

 </body>
</html>

