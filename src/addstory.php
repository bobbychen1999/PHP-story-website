<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"><title>Add story</title></head>
<body>
<form name="addstory" action="createstory.php" method = "POST">
Title: <input type="text" name="title"><br>
Put the story here: <input type="text" name="content" style="width: 600px;height: 200px">
<input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
<input type="submit" name="create" value="Submit">
</form>
</body>
</html>
