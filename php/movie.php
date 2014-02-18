<html>
  <head>
    <title>Movies</title>
  </head>
  <body>
    <p>-------------------</p>
    <h1>Names</h1>  

<?php


$mysqli = new mysqli("localhost", "php", "php-pass", "test");

if ($mysqli->connect_errno) 
{ 
   echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}



if (isset($_REQUEST['name']))
{
   //results
   $name = $_REQUEST['name'];
   
   $result = $mysqli->query("select * from actor AS a JOIN actor_movie AS c ON a.id = c.actorId JOIN movie as m on m.id = c.movieId where a.name = '$name'");
   
   while ($row = $result->fetch_assoc())
   {
      if ($row['name'] == $name)
      {
         echo $row['name'] . " " . $row['characterName'] . ":" . $row['title'];
         echo "<br /><br />";
      }
   }
}


   //show the form
   echo "<form action='movie.php' method='post'>
   
   <select name='name'>";
   
      $actors = $mysqli->query("select * from actor");

      while ($row = $actors->fetch_assoc())
      {
         echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>\n";
      }
   echo "</select>
   <br />
   
   <input type='submit' value='Submit'>
   </form>";


mysqli_close($mysqli);
  
 ?>

    <p>-------------------</p>
  </body>
</html>