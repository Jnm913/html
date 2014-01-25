<!DOCTYPE html>
<?php
   
   $url = "http://ec2-54-209-234-48.compute-1.amazonaws.com/php/results.php";
   $key = "visited";
   $visited = 0;
   
   if (isset($_COOKIE[$key]))
   {
      // has been visited
      header("Location: $url");
      $visited = $_COOKIE[$Key];
   }
   else
   {
      $visited = 0;
   }
   
   $visited++;
   setcookie($key, $visited, time() + 3600);

?>

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
            <a class="navbar-brand">McCurdy.inc</a>
         </div>

         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
               <li><a href="../index.html">Home</a></li>
               <li><a href="../aboutme.html">About Me</a></li>
               <li class="active" ><a href="../313_projects.html">Class Assignments</a></li>
            </ul>
         </div><!-- /.navbar-collapse -->
      </nav>
  
      <div class="container">
         <div class="phpSurvay">
         
            <h2 class="header">Enjoy this survay about cars!</h2>
         
            <?php
               require('formFunctions.php'); // where the functions are defined.
      
               // This is the dynamic form built with the above functions
               echo "<form action='results.php' method='post'>\n";
               
               // question 1
               multiQuestion("radio", "What is your favorite color on a car?", 1, array("Green", "Red", "Blue", "White", "Gray", "Black", "Rainbow"));
               
               // question 2
               multiQuestion("checkbox", "Check all the car makers that you know of:", 2, array("Honda", "Chevrolet", "Ford", "Land Rover", "Dodge", "Jeep", "GMC", "Volvo", "Mazda", "Audi", "BMW", "Mini", "Volkswagen", "Tesla", "Fiat", "Maserati", "Subaru", "Suzuki", "Toyota", "Nissan", "Datsun", "Acura", "Mercedes", "Renault", "Hyundai", "Kia", "Bently", "Lotus"));
               
               // question 3
               listQuestion("Select your favorite car maker:", 3, array("Honda", "Chevrolet", "Ford", "Land Rover", "Dodge", "Jeep", "GMC", "Volvo", "Subaru","Toyota", "Nissan","Mazda", "Audi", "BMW", "Mini", "Volkswagen", "z"));
               
               // question 4
               multiQuestion("text", "What kind of car do you drive?", 4, array("None"));
               
               // the submit part
               echo "<br />\n";
               echo "<input type='submit' value='Submit'>\n";
               // the end of the form
               echo "</form>";
            ?>            
         </div>
      </div> <!-- /container -->
     
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