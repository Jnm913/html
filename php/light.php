<html>
  <head>
    <title>Scripture Resources</title>
  </head>
  <body>
    <p>-------------------</p>
    <h1>Scripture Resources</h1>  

<?php
   require "../NotGit/names.php";

$mysqli = new mysqli($connect, $username, $password, "test");

if ($mysqli->connect_errno) 
{ 
   echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

// $result = $mysqli->query("SELECT * FROM scripture");

// while ($row = $result->fetch_assoc())
// {
   // echo $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " - " . $row['content'];
   // echo "<br /><br />";
// }




if (isset($_REQUEST['book']))
{
   //results
   $book = $_REQUEST['book'];
   
   $result = $mysqli->query("SELECT * FROM scripture");
   
   while ($row = $result->fetch_assoc())
   {
      if ($row['book'] == $book)
      {
         echo $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " - " . $row['content'];
         echo "<br /><br />";
      }
   }
}


   //show the form
   echo "<form name='form' action='light.php' method='post'>
   
   <select name='book'>
      <option value='Doc. & Cov.'>Doc. & Cov.</option>
      <option value='Mosiah'>Mosiah</option>
      <option value='John'>John</option>
   </select>
   <br />
   
   <input type='submit' value='Submit'>
   </form>";


mysqli_close($mysqli);
  
 ?>

    <p>-------------------</p>
  </body>
</html>