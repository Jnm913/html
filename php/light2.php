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

   if (isset($_POST['book']))
   {
      //results
      $book = $_POST['book'];
      $chap = $_POST['chap'];
      $verse = $_POST['verse'];
      $content = $_POST['content'];
      $topics = $_POST['topics'];
     
      //echo "<p>" . $book . " " . $chap . " " . $verse . "</p>";
      echo "<p>" . $topics[0] . "</p>";
     
     
      //update the data base
      $mysqli->query("INSERT INTO scripture (book, chapter, verse, content) values ('$book', '$chap', '$verse', '$content')");
      
      $newID = $mysqli->insert_id;
      // //$id = $mysqli->query("SELECT id FROM scripture WHERE book=$book WHERE chapter=$chap WHERE verse=$verse");
      
      foreach ($topics as $val)
      {
         echo $val . "<br>\n";
      
         $id = $mysqli->query("SELECT id FROM topic WHERE name='$val'");
      
         echo "the topic id is:" . $id . "    the NEWID is: " . $newID;
      
         $mysqli->query("INSERT INTO topic_scrip (scripId, topicId) values ('$newID', '$id')");
      
      }

      $result = $mysqli->query("SELECT * FROM scripture");
      
      while ($row = $result->fetch_assoc())
      {
         echo $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " - " . $row['content'];
         echo "<br /><br />";

      }
  }


   //show the form
   echo "<form action='light2.php' method='post'>\n
   
   Book: <input type='text' name='book'><br>\n
   Chapter: <input type='text' name='chap'><br>\n
   Verse: <input type='text' name='verse'><br>\n
   Content: <br><textarea name='content' rows='10' cols='30'></textarea><br><br>\n";
   
   
   //the checkboxes
   $topic = $mysqli->query("SELECT * FROM topic");
   
   while ($row = $topic->fetch_assoc())
   {
      echo "<input type='checkbox' name='topics' value=" . $row['name'] . ">" . $row['name'] . "<br>";
   }
   

   echo "<br />
   
   <input type='submit' value='Submit'>
   </form>";


   mysqli_close($mysqli);
  
 ?>

    <p>-------------------</p>
  </body>
</html>