<!DOCTYPE html>
<html>
   <head>
      <title>McCurdyPhotography</title>
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
               <li Class="active"><a href="weddings.php">Weddings</a></li>
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
         
            <?php
               require "../NotGit/names.php";
               
               //start the connection
               $mysqli = new mysqli($connect, $username, $password, "cs313");

               if ($mysqli->connect_errno) 
               { 
                  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
               }
            
               $name = "Weddings";
            
               $slides = $mysqli->query("select * from slides AS s JOIN quote AS q ON s.quoteID = q.id where s.name = '$name'");
            
               if($row = $slides->fetch_assoc())
               {
                  // the title
                  echo "<h1>" . $row['name'] . "</h1>\n";
                  // the quote
                  echo "<h3>" . $row['theQuote'] . " <br />\n-" . $row['author'] . "</h3>\n";
               }
            
               echo "<br />\n";
               //<!-- Start of Carolsel-->
               echo "<div class='carousel_section'>\n" .
                    "<div id='myCarousel' class='carousel slide'>\n" .
                    "<div class='carousel-inner'>\n";
                    
               
               $photos = $mysqli->query("select * from slides AS s JOIN show_images AS i ON s.id = i.slidesId JOIN images AS im ON i.imageId = im.id where s.name = '$name'");
               $first = 1;
               
               while ($row = $photos->fetch_assoc())  
               {
                  if ($first == 1)
                  {
                     echo "<div class='item active' " .  
                        "style='background-image: url(" . $row['fileName'] . "); '>\n" .
                     "</div>\n";

                     // "<img src='" . $row['fileName'] . "' alt=''>\n" .  
                     
                     // echo "<div class='item active'>\n" .
                        // "<img src='" . $row['fileName'] . "' alt=''>\n" .  
                     // "</div>\n";
                     $first = 0;
                  }
                  else
                  {
                     echo "<div class='item' " .  
                        "style='background-image: url(" . $row['fileName'] . ");'>\n" .
                     "</div>\n";
                  
                     // echo "<div class='item'>\n" .
                        // "<img src='" . $row['fileName'] . "' alt=''>\n" .  
                     // "</div>\n";
                  }
               }
               
               echo "</div>\n";
               // the two chevrons and the end of the div for the carousel
               echo "<a class='left carousel-control' href='#myCarousel' data-slide='prev'>&lsaquo;</a>\n" . 
                     "<a class='right carousel-control' href='#myCarousel' data-slide='next'>&rsaquo;</a>\n" . 
                  "</div><!-- /.carousel -->\n" . 
               "</div>\n";
                  
               echo "<div class='packages'>\n";
               echo "<h2>Recomended Package(s)</h2>\n";
               
                $packages = $mysqli->query("select * from slides AS s JOIN show_packages AS p ON s.id = p.slidesId JOIN package AS pa ON p.packageId = pa.id where s.name = '$name'");
                
                while ($row = $packages->fetch_assoc())  
               {
                  echo "<p>Package " . $row['id'] . " : $" . $row['price'] . "</p>\n";  
                  
                  echo "<p>" . $row['description'] . "</p>\n";
                  
               }
               
               echo "</div>\n";
                     
               echo "</div>\n";
               echo "</div> <!-- /container -->\n";
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