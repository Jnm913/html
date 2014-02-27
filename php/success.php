<?php

   session_start();
   
   if($_SESSION['myusername'])
   {
      $user = $_SESSION['myusername'];
   }
   else
   {
      header("location:logintest.php");
   }
?>


<!DOCTYPE html>
<html>
   <head>
      <title>Home Page</title>
   </head>
   <body>
      <?php
         echo "<h2>Welcome $user</h2>";
         echo "<p>Some text on the page.</p>";
      ?>
   </body>
</html>