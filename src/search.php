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
//search in the database
    $search=$_POST['search'];
    $stmt = $mysqli->prepare("SELECT title, author, content FROM stories where title=?");
  if(!$stmt){

          printf("Query Prep Failed: %s\n", $mysqli->error);
          exit;
      }
      
        $stmt->bind_param("s", $search);
    $stmt->execute();
   $stmt->bind_result($title, $author, $content);
    $stmt->store_result();
//if there's no match
      if($stmt->num_rows == 0) {
  echo "no matches found ";
  header("refresh:3; url = homepage.php");
  exit;
}
//display the matched information
while ($stmt->fetch()){
    printf("Title : %s", htmlspecialchars($title));
    printf(" <br> Author :  %s ", htmlspecialchars($author));
    printf("<br>  Content : %s",     htmlspecialchars($content));
    echo "<br>";
}
echo "<form action = 'homepage.php' method = 'POST'>";
echo '<input type="hidden" name="token" value=$_SESSION["token"]>';
echo "<input type = 'submit' value = 'back to homepage'>";
echo "</form>";
?>

</html>