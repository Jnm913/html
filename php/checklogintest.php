<?php

   session_start();
   
?>



<!DOCTYPE html>
<html>
   <head>
      <title>test</title>
      
   </head>
   <body>
      
      
         
            <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
               <tr>
                  <form name="Form1" method="post" action="checklogintest.php">
                     <td>
                        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                           <tr>
                              <td colspan="3"><strong>Login</strong></td>
                           </tr>
                           <tr>
                              <td width="78">Username</td>
                              <td width="6">:</td>
                              <td width="294"><input name="myusername" type="text" id="myusername"></td>
                           </tr>
                           <tr>
                              <td>Password</td>
                              <td>:</td>
                              <td><input name="mypassword" type="text" id="mypassword"></td>
                           </tr>
                           <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><input type="submit" name="Submit" value="Login"></td>
                           </tr>
                        </table>
                     </td>
                  </form>
               </tr>
            </table>

            <?php
               require "../NotGit/names.php";
               
               //start the connection
               $mysqli = new mysqli($connect, $username, $password, "test");

               if ($mysqli->connect_errno) 
               { 
                  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
               }
            
               // username and password sent from form 
               $myusername = htmlspecialchars($_POST['myusername']); 
               $mypassword = htmlspecialchars($_POST['mypassword']); 
               
               $mypassword = hash('sha256', $mypassword);
       
               echo "user: $myusername <br> pass: $mypassword";
       
       
               $result = $mysqli->query("SELECT * FROM user WHERE username='$myusername'");

               // check the username and password
               $row = $result->fetch_assoc();
               // if they match then register
               
               echo "stored pass:" . $row['password'];
               
               if ($row['username'] == $myusername and $row['password'] == $mypassword)
               {                  
                  //Register $myusername
                  $_SESSION['myusername'] = $myusername;
                  header("location:success.php");
               }
               else 
               {
                  echo "Wrong Username or Password";
               }
             
            ?>

    
   </body>
</html>