<?php

     session_start();
     include 'init.php' ;
    if(isset($_SESSION['User']))
    {
        
    
     //----------------for comments---------------------------------
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
             
            $user_id = getUser($_SESSION['User']);
            $item_id = $_GET['itemid'];
            $comm = $_POST['comm'] ;
            
            $stmt = $con->prepare("INSERT INTO  comment (  user_id , item_id , containt ,comm_date ) VALUES (:zuser , :zitem , :zcontent,  now()  )");

								$stmt->execute(array(
									'zuser'     =>$user_id       ,   
									'zitem'     =>$item_id       ,    
									'zcontent'  =>$comm          
								));
                 $theMsg = "<div class ='alert alert-success  box-suc'>" .$stmt->rowCount() . 'done will</div>';
            redirectHome($theMsg , 'back' ,3 );
        }
        
        
    }
else
{
    echo 'sorry can not';
}
?>