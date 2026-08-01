<?php

include_once("admin_header.php");

 echo '<form action = "admin/login.php" method="post">';
 echo '<p>Please login to continue.</p>';
 echo '<label for="uname">Username:</label><br>';
 echo '<input type="text" id="uname" name="uname"><br>';
 echo '<label for="pass">Password:</label><br>';
 echo '<input type="password" id="pass" name="pass"><br>';
 echo '<input type="submit" value="Login">';
 echo '</form>';

 include_once("footer.php");
?>