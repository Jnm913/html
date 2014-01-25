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
         
            <h2 class="header">Example Survey</h2>
         
            <?php
               
               // use this function to make questions using the <input> tag
               function multiQuestion($type, $question, $num, $answers)
               {               
                  print "<h3>$num : $question</h3>\n";
                  
                  if ($type == "text")
                  {
                     print "<input type='$type' name='$num'> <br />\n";
                  }
                  else //question is multiple choice of some kind
                  {
                     sort($answers);      
                     foreach ($answers as $val)
                     {
                        print "<input type='$type' name='$num' value='$val'> $val <br />\n";
                     }
                  }
               }

               // use this function to make questions ussing the <select> and <options> tags
               function listQuestion($question, $num, $answers)
               {
                  print "<h3>$num : $question</h3>\n";
                  print "<select name='$num' >\n";
                  print "<option selected disabled hidden value=''></option>\n";
                  sort($answers);
                  foreach ($answers as $val)
                  {
                     // put 'z' in the list for a "Don't Care" option at the end.
                     if ($val == "z")
                     {
                        print "<option value='$val'> Don't Care </option> \n";
                     }
                     else
                     {
                        print "<option value='$val'> $val </option> \n";  
                     }
                  }
                  
                  print "</select> <br /> \n";
               }
               
               
               // This is the dynamic form built with the above functions
               echo "<form action='form.php' method='post'>\n";
               
               echo "<h3>1 : What is your name?</h3>\n";
               echo "First : <input type='text' name='first'> <br />\n"; 
               echo "<br />\n";
               echo "Last  : <input type='text' name='last'>  <br />\n"; 
               echo "<br />\n";
               echo "Email  : <input type='text' name='email'>  <br />\n";
               
               
               // question 1
               multiQuestion("radio", "What is your Major?", 2, array("CS", "Web", "CIT", "CE", "Other"));
               
               // question 2
               multiQuestion("checkbox", "Places you have visited:", 3, array("North America", "South America", "Europe", "Asia", "Australia", "Africa", "Antarctica"));
               
               // question 3
               //listQuestion("Select your favorite car maker:", 3, array("Honda", "Chevrolet", "Ford", "Land Rover", "Dodge", "Jeep", "GMC", "Volvo", "Subaru","Toyota", "Nissan","Mazda", "Audi", "BMW", "Mini", "Volkswagen", "z"));
               
               // question 4
               //multiQuestion("text", "What kind of car do you drive?", 4, array("None"));
               
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