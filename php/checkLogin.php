<?php

   session_start();
   
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Home of Jeremy McCurdy</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap -->
    
      
      <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
      <link href="../css/photo.css" rel="stylesheet" />

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <nav class="navbar navbar-default navbar-fixed-top"  role="navigation">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <img class="navbar-brand" src="../images/logo35.png" alt="logo"></img>
        </div>

         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
               <li><a href="home.php">Home</a></li>
               <li><a href="nichole.php">Nichole</a></li>
               <li><a href="weddings.php">Weddings</a></li>
               <li><a href="engagements.php">Engagements</a></li>
               <li><a href="seniors.php">Seniors</a></li>
               <li><a href="contact.php">Contact</a></li>
               <li><a href="prices.php">Prices</a></li>
               <li><a href="faq.php">FAQ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="login.php">Login  </a></li>
            </ul>
         </div><!-- /.navbar-collapse -->
      </nav>
  
      <div class="container">
         <!-- Main component for a primary marketing message or call to action -->
         <div class="jumbotron">
         
            <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
               <tr>
                  <form name="Form1" method="post" action="checkLogin.php">
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
               $mysqli = new mysqli($connect, $username, $password, "cs313");

               if ($mysqli->connect_errno) 
               { 
                  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
               }
            
               // username and password sent from form 
               $myusername = htmlspecialchars($_POST['myusername']); 
               $mypassword = htmlspecialchars($_POST['mypassword']); 

               //echo "user: $myusername  and pass: $mypassword\n";
               
               
               $result = $mysqli->query("SELECT * FROM user WHERE username='$myusername'");
 
               // check the username and password
               $row = $result->fetch_assoc();
               
               // if they match then register
               if ($row['username'] == $myusername and $row['password'] == $mypassword)
               {                  
                  //Register $myusername, $mypassword and redirect to file "login_success.php"
                  $_SESSION['myusername'] = $myusername;
                  //echo "User from data:" . $row['username'] . "  and data pass: " . $row['password'] . " ";
                  header("location:login_success.php");
               }
               else 
               {
                  echo "Wrong Username or Password";
               }
             
            ?>

      <footer>
          <div class="footer">
              <ul>
                  Created by : Jeremy McCurdy : copyright 2014
              </ul>
          </div>
      </footer>


      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>