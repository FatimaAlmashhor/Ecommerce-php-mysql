<?php
        session_start();
     include 'init.php' ;
    if(empty($_GET['itemid']))
    {
           $theMsg = "<div class ='alert alert-denger'>Error </div>";
            redirectHome($theMsg , 'back' ,3 );
    }
    else
    {
        
    
    $itemid = $_GET['itemid'] ;
    $getStmt = $con->prepare("SELECT * FROM items WHERE itemID = $itemid LIMIT 1 ");
    $getStmt->execute();
    $items = $getStmt->fetch();

 ?>
    <div class="container items-page">
        <h1 class ="text-right item-title "><?php echo $items['item_name'] ; ?></h1>
        <div class="row">
            <div class="col-md-4 col-xs-12 pic-panel">
                <div class="panel panel-primary  ">
                    <div class="panel-heading">
                        Picture
                    </div>
                    <div class="panel-body">
                        <div class="my-item-pic">
                           
                            <?php 
                        if($items['item_image'] == 'test' || empty($items['item_image'])){
                           echo  "<img src='images/ItemBox.svg' alt='item'/>";
                        }
                        else
                        {
                             echo "<img src='admin/upload/items/".$items['item_image']."'class='user-img' alt=''>" ;
                        }
?>
                        </div>
                    </div>
                </div >
            </div>
            <div class="col-md-8 col-xs-12 info-panel">
               <div class="panel panel-primary ">
                    <div class="panel-heading">
                        Information
                        
                    </div>
                    <div class="panel-body info-item-det">
                    
                        <label class="item-info" >Price: </label>$<?php echo $items['Price'];?><br/>
                        <label class="item-info">Date: </label>
                        <?php echo $items['item_date'];?><br/>
                        <label class="item-info">Country Made: </label>
                        <?php echo $items['country_made'];?><br/>
                        <label class="item-info"> State: </label>
                        <?php if($items['state'] == 0 )
                              {
                                echo '...';
                              }
                                else if($items['state'] == 1)
                                {
                                    echo 'New';
                                }
                                  else if($items['state'] == 2)
                                {
                                    echo 'NOT Very';
                                }
                                else if($items['state'] == 3)
                                {
                                    echo 'Old';
                                }
                        ?>
                        <br>
                        <label class="item-info"> Description: </label>
                        <?php echo $items['Description'];?><br/>
                        <form method="post" action="shopCart.php?itemid=<?php echo $items['itemID'];?>"      >
                            <input type="submit" value="To Cart" name="Save" class="to-cart-item-det">
                        </form>
                        
                    </div>
                </div >
            </div>
            <h1 class ="text-right item-title "> Comments </h1>
            <div class="col-md-8 col-xs-12 comm-panel">
               <div class="panel panel-primary ">
                    <div class="panel-heading">
                        Comments
                    <!--Inter new Comment-->
                    </div>
                    <div class="panel-body comm-temp">
                        <div class="inter-comment">
                            <form method="post" action="comments.php?itemid=<?php echo $itemid ;?>" >
                                <textarea type="text" name="comm"  placeholder="Write your Comment Here" rows="5"  cols="80" class="form-control">
                                </textarea>
                                <br>
                                <input type="submit" value ="Add comment" class="btn btn-success">
                            </form>
                        </div>
                                     <?php
                            foreach(getComment($itemid) as $comms){
                            $user = getUserName($comms['user_id']);
                               
                        ?>
                        <!--Show all the Comment-->
                        <div class="show-comm">
                            <div class="name-user-comm">
                                <div class="fro-info">
                                    <?php 
                                        if($user['image'] == 'test')
                                        {
                                             echo "<img src='images/personIcon.png'class='user-img' alt=''>" ;
                                        }
                                        else
                                        {
                                             echo "<img src='admin/upload/avatar/".$user['image']."'class='user-img' style='width:150%;' alt=''>" ;
                                        }
                                           
                                        
                                    ?>
                                    
                                     
                                </div>
                                <h4 class="user-name">
                                        <?php echo $user['UserName'];?>
                                </h4>
                                <p class="time-date"><?php echo $comms['comm_date']; ?>
                                </p>
                            </div>
                         <div class="content-of-comment">
                                <p><?php echo $comms['containt'];?></p>
                            </div>
                        </div>
                        <?php } ?>
                   </div>
              </div>
            </div>
           
        </div>
    </div>
<script type="text/javascript">
$("img").click(function() {
   $(this).attr('width', '400');
    $(this).attr('height', '300');
});
</script>
<?php 
    }
    include $tpl . 'footer.php' ;
?>

