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
            print "<input type='$type' name='$num";
            if ($type == "checkbox")
            {
               print "[]";
            }
            print "' value='$val'> $val <br />\n";
         }
      }
   }

   // use this function to make questions ussing the <select> and <options> tags
   function listQuestion($question, $num, $answers)
   {
      $Other = "Other";
      print "<h3>$num : $question</h3>\n";
      print "<select name='$num' >\n";
      print "<option selected disabled hidden value=''></option>\n";
      sort($answers);
      foreach ($answers as $val)
      {
         // put 'z' in the list for a "Don't Care" option at the end.
         if ($val == "z")
         {
            print "<option value='Other'> Other </option> \n";
         }
         else
         {
            print "<option value='$val'> $val </option> \n";  
         }
      }
      
      print "</select> <br /> \n";
   }

?>