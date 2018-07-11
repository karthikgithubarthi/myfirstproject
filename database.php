<?php
    	//$dbhost = 'localhost';
         //$dbuser = 'root';
        // $dbpass = '';
        $con = mysqli_connect("localhost","root","","test1");
   
         if(! $con ){
            die('Could not connect: ' . mysqli_error());
         }
         //echo 'Connected successfully';
     


?>
