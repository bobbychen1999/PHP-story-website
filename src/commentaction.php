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

if (isset($_POST["delete"])) {
   
$stmt = $mysqli->prepare("DELETE from comment where id=?");

if (!$stmt) {
    echo "guobuqua";
}
$stmt->bind_param('i', $_POST["comment_id"]);
$stmt->execute();
$stmt->close();

header("refresh:2; url = personalhp.php");
}
if (isset($_POST["edit"])){
    // update the table because the comment is edited
    $_SESSION["comment_id"] = $_POST["comment_id"];
    $stmt = $mysqli->prepare("SELECT content FROM comment WHERE id=?");
	$stmt->bind_param("i",$_SESSION["comment_id"]);
	$stmt->execute();
	$stmt->bind_result($content);
	$stmt->fetch();
	$_SESSION["c"] = $content;
    ?>
    <form name="editcomment" action="editcomment.php" method = "POST">
    Edit the comment here: <input type='text' name='content' value="<?php echo $_SESSION["c"];?>" style="width: 200px;height: 50px">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
    <input type="submit" name="create" value="Submit"></form>	

<?php
    
}
?>
</body>
</html>