<?php
    // help to show the errors
    ini_set('display_error' , 'On');
    error_reporting(E_ALL);

 
          include 'admin/conf.php' ;

       // Routes

    $sesstionUser ='';
    if(isset($_SESSION['User']))
    {
        $sesstionUser  = $_SESSION['User'];
    }
    $tpl  = 'include/templates/' ;  //template path
    $lang = 'include/languages/' ;  //Lsngueges path
    $func = 'include/functions/' ;  //Functions path 
    $css  = 'css/' ;         // layout css path
    $js   = 'js/'  ;         //layout javascript path
    


    //include the importent file
		
	   include   $func . 'function.php' ;
       include   $lang . 'en.php';
       include   $tpl  . 'head.php';
          
?>