<!DOCTYPE html>
<?php
   
   $visits = 0;
   $key = "visits";
   
   if (isset($_COOKIE[$key]))
   {
      $visits = $_COOKIE[$key];
   }
   else
   {
      $visits = 0;
   }
   
   $visits++;
   setcookie($key, $visits, time() + 3600);
   
?>

<html>
   <head>
      
   </head>
   
   <body>
      Some text <br />
       <?php 
         print "PHP printed text <br />";
         print $visits;
       ?>
   </body>
</html>