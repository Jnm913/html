<?php
   try 
   {
      // Undefined | Multiple Files | $_FILES Corruption Attack
      // If this request falls under any of them, treat it invalid.
      if (!isset($_FILES['userfile']['error']) ||
        is_array($_FILES['userfile']['error'])) 
      {
        throw new RuntimeException('Invalid parameters.');
      }

      // Check $_FILES['userfile']['error'] value.
      switch ($_FILES['userfile']['error']) 
      {
         case UPLOAD_ERR_OK:
            break;
         case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
         case UPLOAD_ERR_INI_SIZE:
         case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
         default:
            throw new RuntimeException('Unknown errors.');
      }

      // You should also check filesize here. 
      if ($_FILES['userfile']['size'] > 100000000) 
      {
        throw new RuntimeException('Exceeded filesize limit.');
      }

      // DO NOT TRUST $_FILES['userfile']['mime'] VALUE !!
      // Check MIME Type by yourself.
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      
      if (false === $ext = array_search($finfo->file($_FILES['userfile']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true))
      {
        throw new RuntimeException('Invalid file format.');
      }

      // You should name it uniquely.
      // DO NOT USE $_FILES['userfile']['name'] WITHOUT ANY VALIDATION !!
      // On this example, obtain safe unique name from its binary data.
      //$filePath = sprintf('../photos/%s.%s', sha1_file($_FILES['userfile']['tmp_name']), $ext);
      $filePath = sprintf('../photos/%s', $_FILES['userfile']['name']);
      
      if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $filePath))
      {
        throw new RuntimeException('Failed to move uploaded file.');
      }

      //
      //put the file into the image database here
      //
      require "../NotGit/names.php";
    
      //start the connection
      $mysqli = new mysqli($connect, $username, $password, "cs313");

      if ($mysqli->connect_errno) 
      { 
         echo "Failed to connect to MySQL: " . $mysqli->connect_error;
      }
      
      $mysqli->query("INSERT INTO images (fileName) values ('$filePath')");
      
      // END OF DATABASE STUFF
      
      echo "File is uploaded successfully.<br>\n";
  
   } 
   catch (RuntimeException $e) 
   {

      echo $e->getMessage();
      echo "<br>";
   }
  
   echo "Auto Redirct in : 2 Seconds<br>\n";
   header("Refresh: 2; url='login_success.php'");
?>