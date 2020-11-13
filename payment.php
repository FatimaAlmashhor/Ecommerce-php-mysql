<?php 
    session_start();
    $pageTitle = 'Payment';
    include 'init.php' ;
    

    if(isset($_SESSION['User']))
    {
           
        if($_GET['action'] == 'insert'){
            
                     $user = getUser($sesstionUser);

                 if($chack = checkOrder($user)) 
                {
                    
                }
                else
                {
                     $theMsg = '<div class="alert alert-danger "> Same Think Gose Wrong </div>' ;
                    redirectHome($theMsg , 'back');
                }
                 $order_id = getOrder($user);
            $ID = getUser($sesstionUser);
            $stmt = $con->prepare("SELECT SUM(amount) as sum , COUNT(item_id) as count FROM order_details WHERE order_id = ? ");
            $stmt->execute(array($order_id));
            $rows = $stmt->fetch();
         
            
            if($rows['sum'] > 0)
            {
                
                $total = $rows['sum'] ;
                $item_number = $rows['count'];
               $stmt = $con->prepare("UPDATE  orders SET user_id = ? , order_date = now() , total_amount = ?  , chack = 1 , items_number = ? WHERE order_id = ?");
                $stmt->execute(array(
                     $ID ,
                     $total ,
                     $item_number , 
                     $order_id
                ));
                $items = $_SESSION['cart'];
                $cartitems = explode(",", $items);
                $i = $rows['count']  - 1 ;
                
                while( $i >= 0 ){
                    
                
                    unset($cartitems[$i]);

                   $itemids = implode(",", $cartitems);
                   $_SESSION['cart'] = $itemids;
                    $i-- ;
                }
                
        
            }else{
               $total = 0 ; 
            }
               ?>

 <div class="container items-page">
        <h1 class ="text-right item-title ">Payment</h1>
        <div class="row">
            <div class="col-md-8 col-xs-12 info-panel">
               <div class="panel panel-primary ">
                    <div class="panel-heading">
                        END CHOP    
                    </div>
                    <div class="panel-body info-item-det">
                        <div class="container" >
                            <h6 class="text-center " >How The Way That You Want To Pay </h6>
                            <div class="row">
                                <div class=" col-lg-6 paybal">
                                    <img src="images/download.png" width="200px">
                                </div>
                                <div clas=" col-lg-4 others">
                                
                                </div>
                            </div>
                        </div>
                   </div>
                   <a href="payment.php?action=continue" class="btn btn-primary btn-sm">Continue</a>
                </div>
            </div>
         <div class="col-md-4 col-xs-12 info-panel">
               <div class="panel panel-primary ">
                    <div class="panel-heading">
                       TOTAL  
                    </div>
                    <div class="panel-body info-item-det">
                        <h3>$<?php echo $total ?></h3>
                   </div>
                </div>
            </div>
     </div>
</div>

<?php
            
        }
        elseif($_GET['action'] == 'continue')
        {
           /* $items = $_SESSION['cart'];
            $cartitems = explode(",", $items);
            unset($cartitems[$item['itemID']]);
            
            print($cartitems);
            $user =  getUser($sesstionUser);
            $items = checkOrderDatails($user);
            print_r($items);
            if(empty($items))
            {
                
            }
            else{
                  foreach($items as $item){
                
                unset($cartitems[$item['itemID']]);
                  }
            }
          
                
                $ID = getUser($sesstionUser);
                $stmt = $con->prepare("DELETE  FROM order_details  WHERE user_id = :zitem ");
                $stmt->bindParam(
                    ":zitem" , $ID 
                );
            $stmt->execute();
            $i = 0 ;
            
            
            $theMsg = "<div class ='alert alert-success'>'Successful</div>";
							  
							  redirectHome($theMsg , 'back');
            */
        }
 
    }
else
{
              $theMsg = "<div class ='alert alert-danger'>'ERROR CANT DO THAT</div>";
							  
							  redirectHome($theMsg , 'back');
    
    
}
include $tpl . 'footer.php' ;
?>