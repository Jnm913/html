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
               <li><a href="login_success.php">Pictures</a></li>
               <li><a href="quotes.php">Quotes</a></li>
               <li Class="active"><a href="packages.php">Packages</a></li>
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

            <?php
               require "../NotGit/names.php";
               
               //start the connection
               $mysqli = new mysqli($connect, $username, $password, "cs313");

               if ($mysqli->connect_errno) 
               { 
                  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
               } 
               
               //
               // add packages
               //
               echo "<h3>Add a Package</h3>";
               
               echo "<form action='packages.php' method='post'>
               Package: <textarea name='Package' rows='5' cols='100'></textarea><br /><br />
               Price (just the number): <input type='text' name='Price'><br /><br />
               <input type='submit' value='Add Package' />
               </form>";
               
               if (isset($_POST['Package']))
               {
                  $Package = htmlspecialchars($_POST['Package']);
                  $Price = htmlspecialchars($_POST['Price']);
               
                  //debug
                  echo "the Package: $Package <br /> the Price: $Price\n";
                  
                  $mysqli->query("INSERT INTO package (description, price) values ('$Package', '$Price')");
                  
                  echo "<p>Success in adding the Package.</p>";
               }
               
               
               //
               // assign a package to a slideshow
               //
               echo "<h3>Assign a Package to a Slideshow</h3>";
               
               //show the form
               echo "<form action='packages.php' method='post'>";
               
               echo "<select name='slidesID'>
               <option value='' hidden='true' selected='selected'></option>";
               
               $slides = $mysqli->query("select * from slides");

               while ($row = $slides->fetch_assoc())
               {
                  echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>\n";
               }
               echo "</select>
               <br />";
               
               echo "<select name='packageID'>
               <option value='' hidden='true' selected='selected'></option>";
               
               $package = $mysqli->query("select * from package");

               while ($row = $package->fetch_assoc())
               {
                  echo "<option value='" . $row['id'] . "'>Package " . $row['id'] . " at $" . $row['price'] . "</option>\n";
               }
               echo "</select>
               <br />
               
               <input type='submit' value='Update'>
               </form>";
               
               if (isset($_POST['slidesID']) and isset($_POST['packageID']))
               {
                  $slidesID = htmlspecialchars($_POST['slidesID']);
                  $packageID = htmlspecialchars($_POST['packageID']);
               
                  //debug
                  //echo "the slidesID: $slidesID <br /> the packageID: $packageID\n";
                  
                  $mysqli->query("INSERT INTO show_packages (slidesId, packageId) values ('$slidesID', '$packageID')");
                  
                  echo "<p>Success in Updating.</p>";
               }
               
               
               
               //
               // remove a package from a slide show
               //
               echo "<h3>Remove a Package from a Slideshow</h3>";

               //show the form
               echo "<form name='removePackage1' action='packages.php' method='post'>";
               
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
                  echo "<form name='removePackage2' action='packages.php' method='post'>";
                  // the first selection
                  echo "<input type='hidden' name='slidesID2' value='$selectedID' />";
                  // <select name='slidesID2' disabled>\n
                  // <option value='$selectedID' selected='selected'></option>
                  // </select>
                  
                  //<br />";
                  echo "<select name='packageID' size='1'>\n
                  <option value='' hidden='true' selected='selected'></option>";
                  
                  $package = $mysqli->query("SELECT * FROM show_packages WHERE slidesId='$selectedID'");

                  while ($row = $package->fetch_assoc())
                  {
                     echo "<option value='" . $row['packageId'] . "'>Package " . $row['packageId'] . "</option>\n";
                  }
                  echo "</select>
                  <br />
                  <input type='submit' value='Remove'>
                  </form>";
                  
               }
               
               if (isset($_POST['slidesID2']) and isset($_POST['packageID']))
               {
                  $slidesID2 = htmlspecialchars($_POST['slidesID2']);
                  $packageID = htmlspecialchars($_POST['packageID']);
               
                  //debug
                  //echo "the slidesID2: $slidesID2 <br /> the packageID: $packageID\n";
                  
                  $mysqli->query("DELETE FROM show_packages WHERE slidesId='$slidesID2' AND packageId='$packageID'");
                  
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