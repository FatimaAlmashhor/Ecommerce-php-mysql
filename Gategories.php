<?php

    session_start();
     include 'init.php' ;
         
         
         if(!$_GET['pageid'])
         {
             header('location:home.php');
         }
        else
        {
            
            
    
             ;?>
        

    <div class="container">
        <h1 class="text-center"><?php echo str_replace('-' , ' ', $_GET['pagename']);?> </h1>
        <div class="row">
            <div class="col-lg-12">
                <!-- Search form -->
                    <form class="form-inline text-center " action="" method ="post">
                      <input class="form-control form-control-sm mr-3 w-75 "name="value" type="text" placeholder="Search" aria-label="Search">
                      <input type="submit"  vlaue ="search" name="search" class="btn btn-primary btn-sm">
                     
                    </form>
            </div>
            <?php
                if(isset($_POST['search']))
                {
                    $name=$_POST['value'];
                    $catId=  $_GET['pageid'] ;
                    $statment = $con->prepare("SELECT * FROM items WHERE Cat_ID	 = ? AND item_name LIKE '%$name%' ");
			  
                      $statment->execute(array($catId));
                      $count = $statment->fetchAll();
                     foreach($count as $item)
                   {
                    echo '<div class="col-sm-12 col-lg-4">';
                        echo '<div class=" thumbnail itemBox">';
                    
                            echo '<span class="price">$'.$item['Price'].'</span>';
                            if($item['item_image'] == 'test' || empty($item['item_image']))
                            {
                                 echo'<img class="img-responsive" src = "images/ItemBox.svg" alt=""/>';
                            }
                           else
                           {
                              
                               echo "<img src='admin/upload/items/".$item['item_image']."' style='width:100%;' class='img-responsive'alt='item'>" ;
                           }
                            
                            echo '<div class="caption  hover">
                                <a href="item_detail.php?itemid='.$item['itemID'].'">
                                   <h3>'.$item['item_name'].'</h3>
                                </a>
                                <p>'.$item['Description'].' </p>
                                <p class ="itemDate">'.$item['item_date'].' </p>
                            </div>';
                     echo '</div>';
                        echo '<a href="shopCart.php?action=add&itemid='.$item['itemID'].'&qty=1" class="to-cart">To Cart</a>';
                     echo '</div>';

                }
                }
            else
            {
                
            
            ?>
        </div>
        <div class="row">
            
            <?php
                foreach(getItems('Cat_ID' ,  $_GET['pageid']) as $item)
                {
                    echo '<div class="col-sm-12 col-lg-4">';
                        echo '<div class=" thumbnail itemBox">';
                    
                            echo '<span class="price">$'.$item['Price'].'</span>';
                            if($item['item_image'] == 'test' || empty($item['item_image']))
                            {
                                 echo'<img class="img-responsive" src = "images/ItemBox.svg" alt=""/>';
                            }
                           else
                           {
                              
                               echo "<img src='admin/upload/items/".$item['item_image']."' style='width:100%;' class='img-responsive'alt='item'>" ;
                           }
                            
                            echo '<div class="caption  hover">
                                <a href="item_detail.php?itemid='.$item['itemID'].'">
                                   <h3>'.$item['item_name'].'</h3>
                                </a>
                                <p>'.$item['Description'].' </p>
                                <p class ="itemDate">'.$item['item_date'].' </p>
                            </div>';
                     echo '</div>';
                        echo '<a href="shopCart.php?action=add&itemid='.$item['itemID'].'&qty=1" class="to-cart">To Cart</a>';
                     echo '</div>';

                }
            }?>
    </div>
</div>
<?php include $tpl.'footer.php' ; }?>