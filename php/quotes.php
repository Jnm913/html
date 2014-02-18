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
               <li><a href="login_success.php">Pictures</a></li>
               <li Class="active"><a href="quotes.php">Quotes</a></li>
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

            <?php
               require "../NotGit/names.php";
               
               //start the connection
               $mysqli = new mysqli($connect, $username, $password, "cs313");

               if ($mysqli->connect_errno) 
               { 
                  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
               }

               //
               // add a quote
               //
               echo "<h3>Add a Quote</h3>";
               
               echo "<form action='quotes.php' method='post'>
               Quote: <textarea name='Quote' rows='5' cols='100'></textarea><br /><br />
               Author: <input type='text' name='Author'><br /><br />
               <input type='submit' value='Add Quote' />
               </form>";
               
               if (isset($_POST['Quote']))
               {
                  $Quote = htmlspecialchars($_POST['Quote']);
                  $Author = htmlspecialchars($_POST['Author']);
               
                  //debug
                  //echo "the Quote: $Quote <br /> the Author: $Author\n";
                  
                  $mysqli->query("INSERT INTO quote (theQuote, author) values ('$Quote', '$Author')");
                  
                  echo "<p>Success in adding the Quote.</p>";
               }
               
               //
               // change a quote on a slideshow
               //
               echo "<h3>Change a Quote on a Slideshow</h3>";
               
               //show the form
               echo "<form action='quotes.php' method='post'>";
               
               echo "<select name='slidesID'>
               <option value='' hidden='true' selected='selected'></option>";
               
               $slides = $mysqli->query("select * from slides");

               while ($row = $slides->fetch_assoc())
               {
                  echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>\n";
               }
               echo "</select>
               <br />";
               
               echo "<select name='quoteID'>
               <option value='' hidden='true' selected='selected'></option>";
               
               $quote = $mysqli->query("select * from quote");

               while ($row = $quote->fetch_assoc())
               {
                  echo "<option value='" . $row['id'] . "'>" . $row['theQuote'] . "</option>\n";
               }
               echo "</select>
               <br />
               
               <input type='submit' value='Change Quote'>
               </form>";
               
               if (isset($_POST['slidesID']) and isset($_POST['quoteID']))
               {
                  $slidesID = htmlspecialchars($_POST['slidesID']);
                  $quoteID = htmlspecialchars($_POST['quoteID']);
               
                  //debug
                  //echo "the slidesID: $slidesID <br /> the quoteID: $quoteID\n";
                  
                  $mysqli->query("UPDATE slides SET quoteId='$quoteID' WHERE id='$slidesID'");
                  
                  echo "<p>Success in changing the Quote.</p>";
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