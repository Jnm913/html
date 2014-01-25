<?php
    // the possible array lists results
   $a1 = array(
   "Black"     => "0" ,
   "Blue"      => "0" ,
   "Gray"      => "0" ,
   "Green"     => "0" ,
   "Rainbow"   => "0" ,
   "Red"       => "0" ,
   "White"     => "0" );

   $a2 = array(
   "Acura"       => "0" , 
   "Audi"        => "0" , 
   "Bently"      => "0" , 
   "BMW"         => "0" , 
   "Chevrolet"   => "0" , 
   "Datsun"      => "0" , 
   "Dodge"       => "0" , 
   "Fiat"        => "0" , 
   "Ford"        => "0" , 
   "GMC"         => "0" , 
   "Honda"       => "0" ,
   "Hyundai"     => "0" , 
   "Jeep"        => "0" , 
   "Kia"         => "0" , 
   "Land Rover"  => "0" , 
   "Lotus"       => "0" ,
   "Maserati"    => "0" , 
   "Mazda"       => "0" , 
   "Mercedes"    => "0" , 
   "Mini"        => "0" , 
   "Nissan"      => "0" , 
   "Renault"     => "0" , 
   "Subaru"      => "0" , 
   "Suzuki"      => "0" , 
   "Tesla"       => "0" , 
   "Toyota"      => "0" , 
   "Volkswagen"  => "0" , 
   "Volvo"       => "0" );

   $a3 = array(
   "Audi"        => "0" , 
   "BMW"         => "0" , 
   "Chevrolet"   => "0" , 
   "Dodge"       => "0" , 
   "Ford"        => "0" , 
   "GMC"         => "0" , 
   "Honda"       => "0" ,
   "Jeep"        => "0" , 
   "Land Rover"  => "0" , 
   "Mazda"       => "0" , 
   "Mini"        => "0" , 
   "Nissan"      => "0" , 
   "Subaru"      => "0" , 
   "Toyota"      => "0" , 
   "Volkswagen"  => "0" , 
   "Volvo"       => "0" );

   $a4 = array();  //starts out an empty array.
   
   function some($array1, $array2, $array3, $array4)
   {
      foreach ($array1 as $key => $value)
      {
         print "$key : $value <br />\n"; 
      }               
      
      foreach ($array2 as $key => $value)
      {
         print "$key : $value <br />\n"; 
      }               
      
      foreach ($array3 as $key => $value)
      {
         print "$key : $value <br />\n"; 
      }    
      
      foreach ($array4 as $value)
      {
         print "$value <br />\n"; 
      } 
      
      echo "<br /><br /><br /><br />";
   }
   
?>