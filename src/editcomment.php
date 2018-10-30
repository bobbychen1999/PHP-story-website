<!DOCTYPE HTML>
<html lang="en">
<head>
 <title>edit comment</title>
</head>
<?php
	session_start();
    require 'database.php';
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    // edit an existing comment
    $content = $_POST['content'];
    $zero = 0;
    $stmt = $mysqli->prepare("update comment set content = ? where id = ?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('si', $content, $_SESSION["comment_id"]);
    
    $stmt->execute();
    
    $stmt->close();
    header("refresh:1; url = personalhp.php");
?>

</html>