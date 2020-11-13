<?php
        session_start();
     include 'init.php' ;
if(isset($_SESSION['User']))
     {
 

        if(isset($_SESSION['cart']) & !empty($_SESSION['cart'])){
            
            $items = $_SESSION['cart'];
             $cartitems = explode(",", $items);
            
                if(in_array($_GET['itemid'], $cartitems))
                
                {
                    
                    $theMsg = '<div class="alert alert-danger "> all ready incart </div>' ;
                    redirectHome($theMsg , 'back');
                    
                    
                }else{
                    
          
                    $items .= "," . $_GET['itemid'];
                    $_SESSION['cart'] = $items;
                    //--------------------------add order---------------------------------
                     $user = getUser($sesstionUser);
            
                     $chack = checkOrder($user) ;
            
                     if(!$chack){
                         
                         $stmt= $con->prepare("INSERT INTO orders (user_id , order_date , total_amount , items_number ) VALUES (:zuser , now() ,0 , 1)");
            
                         $stmt->execute(array(
                        'zuser' =>  $user 
                        ));
                     }
                      $order_id = getOrder($user);
                    //---------------------------insert Query-----------------------------
                    $item = $_GET['itemid'] ;
                    $price = getPrice($item);
                    $user = getUser($sesstionUser);
                    $stmt= $con->prepare("INSERT INTO  order_details (item_id , qty , amount  , order_id)  VALUES (:zitem , 1 ,:zamount , :order)");
                    $stmt->execute(array(
                        'zitem' => $item ,
                        'zamount'=> $price ,
                        'order' => $order_id
                    ));
                    
                    $theMsg = '<div class="alert alert-danger ">Done Will </div>' ;
                    redirectHome($theMsg , 'back' , 3 );
                }

    /*        $items .= "," . $_GET['itemid'];
            $_SESSION['cart'] = $items;
            
            $theMsg = '<div class="alert alert-danger ">Done Will </div>' ;
            redirectHome($theMsg , 'back');*/
        }else{

            $items = $_GET['itemid'];
            $_SESSION['cart'] = $items;
        
            
            
            //--------------------------add order---------------------------------
                     $user = getUser($sesstionUser);
            
                     $chack = checkOrder($user) ;
                    
                     if(!$chack){
                         
                         $stmt= $con->prepare("INSERT INTO orders (user_id , order_date , total_amount , items_number ) VALUES (:zuser , now() ,0 , 1)");
            
                         $stmt->execute(array(
                        'zuser' =>  $user 
                        ));
                     }
                      $order_id = getOrder($user);
                    
            //---------------------------insert Query-----------------------------
                    $item = $_GET['itemid'] ;
                    $price = getPrice($item);
                    
                    $stmt= $con->prepare("INSERT INTO order_details (item_id , qty , amount , order_id ) VALUES (:zitem , 1 ,:zamount , :order)");
                    $stmt->execute(array(
                        'zitem'  =>  $items ,
                        'zamount'=> $price ,
                        'order' => $order_id
                    ));
            
                      $theMsg = '<div class="alert alert-danger ">Done Will </div>' ;
                      redirectHome($theMsg , 'back' , 3);
                }
        
        $cartitems = explode(",", $items);
        
}
else
{
    echo 'No Cart';
}




