<!DOCTYPE html>
<html lang="en">
<head>
<title>logout</title>
</head>
<body>
<p>Logged out</p >
<p>Redirecting to login page</p >
</body>
   </html>
<?php
 session_start();
 session_unset();
 session_destroy();
 header("refresh:1;url=login.php");
?>