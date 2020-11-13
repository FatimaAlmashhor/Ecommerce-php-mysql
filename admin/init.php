<?php

          include 'conf.php' ;

       // Routes

    
    $tpl  = 'include/templates/' ;  //template path
    $lang = 'include/languages/' ;  //Lsngueges path
    $func = 'include/functions/' ;  //Functions path 
    $css  = 'css/' ;         // layout css path
    $js   = 'js/'  ;         //layout javascript path
    


    //include the importent file
		
	   include   $func . 'function.php' ;
       include   $lang . 'en.php';
       include   $tpl  . 'head.php';
          
       if(!isset($noNavbar))
       {
           include $tpl . 'navbar.php';
       }
?>