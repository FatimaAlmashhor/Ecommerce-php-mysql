<?php
    ob_start();
    $pageTitle = 'Cart';
    session_start();

   
    include 'init.php';
    if(isset($_SESSION['User']))
     {
    
         $user = getUser($sesstionUser);
            

         $order_id = getOrder($user);
        
        $qty = array() ;
        $qty[] = 1 ;
 ?>
    <div class="container items-page">
        <h1 class ="text-right item-title ">MY CART</h1>
        <div class="row">
            <div class="col-md-8 col-xs-12 info-panel">
               <div class="panel panel-primary ">
                    <div class="panel-heading">
                        Information    
                    </div>
                    <div class="panel-body info-item-det">
                        
                        <div class="container">
                            <div class="row">
                              <table class="table">
                                  <form action="cart.php" method="post">
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Item Name</th>
                                            <th>Quentity</th>
                                            <th>Price</th>
                                        </tr>
                                 <?php 

                                    $total = '';
                                    $i=1;
                                    if(isset($_SESSION['cart']))
                                    {
                                        
                                    $items = $_SESSION['cart'];
                                    $cartitems = explode(",", $items);
                                        
                                        
                                     foreach ($cartitems as $key=>$id) {
                                         $tem = $con->prepare("SELECT * FROM items WHERE itemID = ?");
                                         $tem->execute(array($id));
                                         $rows= $tem->fetch();
                                        
                                        
                                         $userid = getUser($sesstionUser);
                                         $stmt = $con->prepare("SELECT * From order_details WHERE item_id = :item AND order_id = :order  ");
                                         $stmt->execute(array(
                                             'item' => $id ,
                                             'order' => $order_id
                                         ));
                                         $res= $stmt->fetch();
                                      
                                         //for Quientity 
                                        
                                         
                                             if(!isset($_SESSION['qty']))
                                         {
                                             if(empty($res)){
                                                 
                                             }
                                             else
                                             {
                                                $_SESSION['qty'] = array();
                                                $_SESSION['qty'][$key] = $res['qty'] ;
                                                $qty[$key] = $_SESSION['qty'][$key]; 
                                                 
                                             }
                                         }
                                         
                                         else
                                         {
                                              
                                             
                                             if(isset($_POST['refresh']))
                                             {
                                                $new = $_POST[$key] ;
                                                 $maount =  $new * $rows['Price']; 
                                                  $st = $con->prepare("UPDATE order_details SET  qty = ? , amount = ? WHERE item_id = ? ");

                                                  $st->execute(array(  	
                                                              $new ,
                                                              $maount , 
                                                                $id
                                                  ));
                                                $_SESSION['qty'] =$new;
                                                $qty[$key] = $_SESSION['qty']; 
                                                
                                                 header('location:cart.php');
                                             }else
                                             {    $_SESSION['qty'] = $res['qty'];
                                                 
                                                  $qty[$key] = $_SESSION['qty']; 
                                             }
                                             
                                         }    
                                          
                                         if( $rows)
                                         {
                                            
                                    ?>	  	
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><a  class="btn btn-danger btn-sm "href="delCart.php?remove=<?php echo $key; ?>">Remove</a> <?php echo $rows['item_name']; ?></td>
                                            <td>

                                                     <input type=number class="form-control" name="<?php echo $key ;?>"
                                                    size = 2 max=10 min = 1 step=1 value ="<?php if(!empty($qty[$key])){ echo  $qty[$key]; } ?>" >
                                                
                                                   
                                             </td>
                                            <td>$<?php echo $rows['Price']; ?></td>
                                        </tr>
                                    <?php 
                                             if(empty($qty[$key]))
                                             {
                                                 $total = $total + ($rows['Price'] * 1);
                                             }
                                             else
                                             {
                                                  $total = $total + ($rows['Price'] * $qty[$key]);
                                             }
                                       
                                        $i++; 
                                       
                                         }else{}
                                        } 
                                        
                                         
                                    }else{}


                                    ?>

                                    <tr>
                                        <td><strong></strong></td>
                                        <td><strong></strong></td>
                                        <td><input type="submit" value="refresh" name="refresh" class="btn btn-info"></td>
                                        
                                        <td><a href="payment.php?action=insert" class="btn btn-info">Checkout</a></td>
                                    </tr>
                                      </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div >
            </div>
             <div class="col-md-4 col-xs-12 pic-panel">
                <div class="panel panel-primary  ">
                    <div class="panel-heading">
                        Totals
                    </div>
                    <div class="panel-body">
                        <div class="my-item-pic">
                            <h2 id="total"> $<?php echo $total ;?></h2>
                        </div>
                    </div>
                </div >
            </div>
        </div>
    </div>


<?php
    }else
{
    echo ' NO Cart';
}
        include $tpl . 'footer.php' ;
ob_end_flush();
?>