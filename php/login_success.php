<?php

   session_start();
   
   if(!session_is_registered(myusername))
   {
      header("location:login.php");
   }
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Home of Jeremy McCurdy</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap -->
    
      
      <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
      <link href="../css/main.css" rel="stylesheet" />

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
            <a class="navbar-brand">McCurdyPhotography</a>
        </div>

         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
               <li Class="active"><a href="login_success.php">Pictures</a></li>
               <li><a href="quotes.php">Quotes</a></li>
               <li><a href="packages.php">Packages</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li><a href="logout.php">Logout  </a></li>
            </ul>
         </div><!-- /.navbar-collapse -->
      </nav>
  
      <div class="container">
         <!-- Main component for a primary marketing message or call to action -->
         <div class="jumbotron">
         
            <h1>Make Edits Page</h1>

            <h3>Upload a Picture</h3>
            
            <!-- The data encoding type, enctype, MUST be specified as below -->
            <form enctype="multipart/form-data" action="upload2.php" method="POST">
               <!-- MAX_FILE_SIZE must precede the file input field -->
               <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
               <!-- Name of input element determines name in $_FILES array -->
               Send This File: <input name="userfile" type="file" />
               <input type="submit" value="Send File" />
            </form>
  
            <?php
               require "../NotGit/names.php";
               
               //start the connection
               $mysqli = new mysqli($connect, $username, $password, "cs313");

               if ($mysqli->connect_errno) 
               { 
                  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
               } 
               
               //
               // assign a picture to a slideshow
               //
               echo "<h3>Assign a Picture to a Slideshow</h3>";
               
               //show the form
               echo "<form action='login_success.php' method='post'>";
               
               echo "<select name='slidesID'>
               <option value='' hidden='true' selected='selected'></option>";
               
               $slides = $mysqli->query("select * from slides");

               while ($row = $slides->fetch_assoc())
               {
                  echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>\n";
               }
               echo "</select>
               <br />";
               
               echo "<select name='imageID'>
               <option value='' hidden='true' selected='selected'></option>";
               
               $images = $mysqli->query("select * from images");

               while ($row = $images->fetch_assoc())
               {
                  echo "<option value='" . $row['id'] . "'>FileName: " . $row['fileName'] . "</option>\n";
               }
               echo "</select>
               <br />
               
               <input type='submit' value='Update'>
               </form>";
               
               if (isset($_POST['slidesID']) and isset($_POST['imageID']))
               {
                  $slidesID = htmlspecialchars($_POST['slidesID']);
                  $imageID = htmlspecialchars($_POST['imageID']);
               
                  //debug
                  //echo "the slidesID: $slidesID <br /> the imageID: $imageID\n";
                  
                  $mysqli->query("INSERT INTO show_images (slidesId, imageId) values ('$slidesID', '$imageID')");
                  
                  echo "<p>Success in Updating.</p>";
               }
               
               //
               // remove a picture from a slideshow
               //
               echo "<h3>Remove a Picture from a Slideshow</h3>";
               
               //show the form
               echo "<form name='removeImage1' action='login_success.php' method='post'>";
               
               echo "<select name='slidesID'>\n
               <option value='' hidden='true' selected='selected'></option>";
               
               $slides = $mysqli->query("select * from slides");

               while ($row = $slides->fetch_assoc())
               {
                  echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>\n";
               }
               echo "</select>
               <br />
               <input type='submit' value='Go'>
               </form>";
               
               if (isset($_POST['slidesID']))
               {
                  $selectedID = htmlspecialchars($_POST['slidesID']);
                  
                  // DEBUG
                  //echo "This is the ID: $selectedID <br />";
                  
                  // the second form
                  echo "<form name='removeImage2' action='login_success.php' method='post'>";
                  // the first selection
                  echo "<input type='hidden' name='slidesID2' value='$selectedID' />";
                  // <select name='slidesID2' disabled>\n
                  // <option value='$selectedID' selected='selected'></option>
                  // </select>
                  
                  //<br />";
                  echo "<select name='imageID'>\n
                  <option value='' hidden='true' selected='selected'></option>";
                  
                  $image = $mysqli->query("SELECT * FROM show_images WHERE slidesId='$selectedID'");

                  while ($row = $image->fetch_assoc())
                  {
                     echo "<option value='" . $row['imageId'] . "'>Image #" . $row['imageId'] . "</option>\n";
                  }
                  echo "</select>
                  <br />
                  <input type='submit' value='Remove'>
                  </form>";
                  
               }
               
               if (isset($_POST['slidesID2']) and isset($_POST['imageID']))
               {
                  $slidesID2 = htmlspecialchars($_POST['slidesID2']);
                  $imageID = htmlspecialchars($_POST['imageID']);
               
                  //debug
                  echo "the slidesID2: $slidesID2 <br /> the imageID: $imageID\n";
                  
                  $mysqli->query("DELETE FROM show_images WHERE slidesId='$slidesID2' AND imageId='$imageID'");
                  
                  echo "<p>Success in Removing.</p>";
               }
            
            ?>
            
         </div>
      </div>

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