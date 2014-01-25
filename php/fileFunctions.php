<?php
   function writeFile($fileName, $array1, $array2, $array3, $array4)
   {
      $file = fopen($fileName, "w+"); // writes and clear the file each time.
      
      fwrite($file, "a1\n");
      
      foreach($array1 as $key => $value)
      {
         fwrite($file, "$value\n");
      }

      fwrite($file, "a2\n");
      
      foreach($array2 as $key => $value)
      {
         fwrite($file, "$value\n");
      }
      
      fwrite($file, "a3\n");
      
      foreach($array3 as $key => $value)
      {
         fwrite($file, "$value\n");
      }

      fwrite($file, "a4\n");
      
      foreach($array4 as $value)
      {
         fwrite($file, "$value\n");
      }   
      
      fclose($file);
   }
   
?>