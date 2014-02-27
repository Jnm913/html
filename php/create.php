<!DOCTYPE html>
<html>
   <head>
   </head>
   <body>
      <form name="Form1" method="post" action="create.php">
         <td>
            <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
               <tr>
                  <td colspan="3"><strong>Create User</strong></td>
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
                  <td><input type="submit" name="Submit" value="Create"></td>
               </tr>
            </table>
         </td>
      </form>
      
      <?php
      
         require "../NotGit/names.php";
               
         //start the connection
         $mysqli = new mysqli($connect, $username, $password, "test");

         if ($mysqli->connect_errno) 
         { 
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
         }
      
         if (isset($_POST['myusername']))
         {
      
            // username and password sent from form 
            $myusername = htmlspecialchars($_POST['myusername']); 
            $mypassword = htmlspecialchars($_POST['mypassword']);

            $mypassword = hash('sha256', $mypassword);
            
            echo "user: $myusername <br> pass: $mypassword";
            
            $mysqli->query("INSERT INTO user (username, password) values ('$myusername', '$mypassword')");
            
            header("Refresh: 1; url='logintest.php'");
         }
         
         
         
         
         
         
      ?>
      
   </body>
</html>