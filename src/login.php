<!DOCTYPE html>
<html lang="en">
<?php
 session_start(); // start the session
 // form that passes username to verification.php
 $_SESSION["username"]="";

?>
 <body>
  <form action="verification.php" method="post">
   <h1>Enter your username and password please </h1>
   <input type="text" name="username"/>
   <input type="password" name="password"/>
   <input type="submit" value="Log In"/>
  </form>
  <br>

  <form action="register.php" method="post">
  <input type="text" name="newusername"/>
   <input type="password" name="newpassword"/>
    <input type="submit" value="register"/>
    </form>

  <br>

    <h2> I don't want to register now </h2>

    <form action="homepage.php" method="post">
    <input type="submit" value="visit" name="visit"/>
    </form>
 </body>
</html>