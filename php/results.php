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
               <li class="active"><a href="../313_projects.html">Class Assignments</a></li>
            </ul>
         </div><!-- /.navbar-collapse -->
      </nav>
  
      <div class="container">
         <div class="phpSurvay">
         
            <h2 class="header">These are the results from the cars survay.</h2>
         
            <?php
               require 'surveyArrays.php'; // the arrays defined.
               //require 'fileFunctions.php'; // the file functions defined.
            
               $fileName = "results.txt";
            
               // get the form data out
               $Q1 = $_POST["1"];
               $Q2 = $_POST["2"];
               $Q3 = $_POST["3"];
               $Q4 = $_POST["4"];
               
               // print_r(file($fileName));
               
               $file = file($fileName);
               
               // print "This is in the File: $file[0] <br />";
               
               $fileArray = explode(" ", $file[0]);
               
               $index = 0;
               
               // read the file
               // $rfile = fopen($fileName, "r"); // read only

               $line = $fileArray[$index]; //fgets($rfile);
               $index++;
             
               foreach($a1 as $key => $value)
               {
                  $a1[$key] = $fileArray[$index]; //fgets($rfile);
                  $index++;
                  // print "value is : $a1[$key] <br />";
               }
             
               $line = $fileArray[$index]; //fgets($rfile);
               $index++;
            
               foreach($a2 as $key => $value)
               {
                  $a2[$key] = $fileArray[$index]; //fgets($rfile);
                  $index++;
               }
              
               $line = $fileArray[$index]; //fgets($rfile);
               $index++;
              
               foreach($a3 as $key => $value)
               {
                  $a3[$key] = $fileArray[$index]; //fgets($rfile);
                  $index++;
               }
              
               $line = $fileArray[$index]; //fgets($rfile);
               $index++;
 
               for (;$index < count($fileArray);$index++)
               {
                  $something = $fileArray[$index]; //fgets($rfile);
                  // print "value is : $something <br />";
                  if ($something != "")
                     $a4[] = $something;
               }
 
 
               // while(feof($rfile) === false)
               // {
                  // $something = fgets($rfile);
                  // print "value is : $something <br />";
                  // $a4[] = $something;
               // }
        
               // fclose($rfile);
              
               // setting the values
               if ($Q1 != "")
               {
                  $a1[$Q1] = $a1[$Q1] + "1";
               
                  foreach ($Q2 as $val)
                  {
                     $a2[$val] = $a2[$val] + "1";
                  }
                  
                  $a3[$Q3] = $a3[$Q3] + "1";
                  
                  $a4[] = $Q4;
               }                  
            
               $wfile = fopen($fileName, "w"); // writes and clear the file each time.
      
               fwrite($wfile, "a1 ");
               
               foreach($a1 as $value)
               {
                  fwrite($wfile, "$value ");
               }

               fwrite($wfile, "a2 ");
               
               foreach($a2 as $value)
               {
                  fwrite($wfile, "$value ");
               }
               
               fwrite($wfile, "a3 ");
               
               foreach($a3 as $value)
               {
                  fwrite($wfile, "$value ");
               }

               fwrite($wfile, "a4 ");
               
               foreach($a4 as $value)
               {
                  if ($value == "")
                  {
                     print "Nothing";
                  }
                  else if ($value == " ")
                  {
                     print "Space";
                  }
                  else
                  {
                     fwrite($wfile, "$value ");
                  }
               }   
               
               fclose($wfile);
               
               // printing the results
               print "<h3>Colors chosen for Question 1:</h3>\n";
               
               foreach ($a1 as $key => $value)
               {
                  print "$key : $value <br />\n"; 
               }               
               
               print "<h3>Car makers Checked in Question 2:</h3>\n";
                              
               foreach ($a2 as $key => $value)
               {
                  print "$key : $value <br />\n"; 
               }               
                              
               print "<h3>Favorite car maker's selected in Question 3:</h3>\n";
               
               foreach ($a3 as $key => $value)
               {
                  print "$key : $value <br />\n"; 
               }    
               
               print "<h3>Cars people drive or (text entered) in Question 4:</h3>\n";
               
               foreach ($a4 as $value)
               {
                  print "$value <br />\n"; 
               } 
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