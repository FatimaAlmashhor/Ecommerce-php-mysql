<?php 
        session_start();
        $pageTitle = 'Home page';
           
        include 'init.php';
        
       /* $items = getLatest("*" , "items" ,"itemID", $number = 4 );*/
                
        // this is for search from the database 

        $submit = 0 ;
        if(isset($_POST['search']))
        {
            $getStmt = $con->prepare("SELECT * FROM items  WHERE  item_name LIKE '%$name%' OR Price = ? OR state  = ? ORDER BY itemID DESC ");

            $getStmt->execute(array(
              $price ,  $state
             ));

            $row = $getStmt->fetchAll();
            $submit = 1 ;
            
        }
        else
        {
            $submit = 0 ;
        }



                ?>
        <!---------------------------------Main Banner--------------------------------------->
                    <section class = "home_banner_area p-120">
                        <div class="banner_inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="banner_content">
                                            <h2> TRUEMAX </h2>
                                            <p>
                                                If you are looking at blank cassettes on
                                                the web, you may be veryconfused at the
                                                difference in price.You may see some for 
                                                as low as $.17 each
                                            </p>
                                            <a class="banner_btn" href="#here">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        
                        </div>

                    </section>
        <!----------------------------------Project Area-------------------------------------------->
                    <section class="prodact-eara p-120" id="here">
                        <div class="sec-title">
                            <h2 >MOST POPULAR PROJECT</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                        </div>
                        
                        <div class="row m0">
                            <div class="prodact-item wd-18">
                                <img src="images/product1%20(1).jpg"/>
                                <div class="hover"><a href="item_detail.php?itemid=">
                                    <h4></h4>
                                    <p>LCD screens are uniquely modern in style, and the liquid crystals that make them work have allowed humanity to create slimmer.</p>
                                </a></div>
                            </div>
                             
                            <div class="prodact-item wd-18">
                                <img src="images/product1%20(2).jpg"/>
                                <div class="hover">
                                    <h4></h4>
                                    <p>LCD screens are uniquely modern in style, and the liquid crystals that make them work have allowed humanity to create slimmer.</p>
                                </div>
                            </div>
                            <div class="prodact-item wd-44">
                                <img src="images/product1%20(4).jpg"/>
                                <div class="hover">
                                    <h4>TRUEMAX OMPLEX FOR ESIDENCE</h4>
                                    <p>LCD screens are uniquely modern in style, and the liquid crystals that make them work have allowed humanity to create slimmer.</p>
                                </div>
                            </div>
                            <div class="prodact-item wd-18">
                                <img src="images/product1%20(3).jpg"/>
                                <div class="hover">
                                    <h4>TRUEMAX OMPLEX FOR ESIDENCE</h4>
                                    <p>LCD screens are uniquely modern in style, and the liquid crystals that make them work have allowed humanity to create slimmer.</p>
                                </div>
                            </div>
                        </div>
                    </section>
        <!----------------------------------Advertasing Area-------------------------------------->
                    <section class="adver-eara p-120">
                        <div class="container con">
                            <div class="adver_inner text-center">
                                <h2>LOOKING FOR A <br />
                                    QUALITY AND AFFORDABLE FURNITURE?
                                </h2>
                                <p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace.</p>
                                <a href="#">READ DETAILS</a>
                            </div>
                        </div>
                    </section>
       <!---------------------------------- show and search about items----------------------------->
                    <section class="search-items">
                        <div class="container p-120">
                            <div class="sec-title text-center">
                                <h2 >HERE IS THE BSET PLACE FOR YOU</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-xsm-12 info-panel">
                                    
                                    <div class="panel panel-primary ">
                                        <div class="panel-heading">
                                            Our trast User    
                                        </div>
                                        <div class="panel-body info-item-det">
                                            <table class="table-user" >
                                                <tr>
                                                    <td>Name</td>
                                                    <td>Avatar</td>
                                                </tr>
                                                <?php 
                                                $getStmt = $con->prepare("SELECT * FROM users LIMIT 5 ");

                                                $getStmt->execute();

                                                $rows = $getStmt->fetchAll(); 
                                                foreach($rows as $user)
                                                {
                                                    echo '<tr class="user-tr">';
                                                   
                                                    echo '<td>';
                                                    echo $user['FullName'];
                                                    echo '</td>';
                                                    if($user['image'] == 'test')
                                                    {
                                                         echo '<td>';
                                                         echo "<img src='images/personIcon.png'class='user-img'style='width:70px;height:70px;border-radius:50%;' alt=''>" ;
                                                         echo '</td>';
                                                    }
                                                    else
                                                    {
                                                         echo '<td>';
                                                         echo "<img src='admin/upload/avatar/".$user['image']."' style='width:70px;height:70px;border-radius:50%;' class='user-img'  alt=''>" ;
                                                         echo '</td>';
                                                    }
                                                    echo '</tr>';
                                                }
                                                    
                                                ?>
                                            </table>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-9 col-xsm-12 info-panel">
                                    <div class="panel panel-primary ">
                                        <div class="panel-heading">
                                            Best Project    
                                        </div>
                                        <div class="panel-body info-item-det">
                                            <table class="table-item" >
                                                <tr>
                                                    <td>Name</td>
                                                    <td>Price</td>
                                                    <td>Quentity</td>
                                                    <td>Picture</td>
                                                </tr>
                                                <?php 
                                                $getStmt = $con->prepare("SELECT * FROM items  LIMIT 5 ");

                                                $getStmt->execute();

                                                $rows = $getStmt->fetchAll(); 
                                                foreach($rows as $user)
                                                {
                                                    echo '<a href="item_detail.php?itemid='.$user['itemID'].'">';
                                                    echo '<tr class="user-tr">';
                                                    
                                                    echo '<td>';
                                                    echo $user['item_name'];
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '$' . $user['Price'];
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo $user['item_qty'];
                                                    echo '</td>';
                                                    if($user['item_image'] == 'test' || empty($user['item_image']))
                                                    {
                                                         echo '<td>';
                                                         echo "<img src='images/ItemBox.svg'class='user-img'style='width:70px;height:70px;border-radius:50%;' alt=''>" ;
                                                         echo '</td>';
                                                    }
                                                    else
                                                    {
                                                         echo '<td>';
                                                         echo "<img src='admin/upload/avatar/".$user['item_image']."' style='width:70px;height:70px;border-radius:50%;' class='user-img'  alt=''>" ;
                                                         echo '</td>';
                                                    }
                                                    
                                                    echo '</tr>';
                                                    echo '</a>';    
                                                }
                                            
                                                    
                                                    
                                                ?>
                                            </table>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
         <!------------------------------------Feature Area ---------------------------=-->
        <section class="feature_area p-120">
        	<div class="container">
        		<div class="sec-title text-center">
        			<h2>Some Features that Made us Unique</h2>
        			<p >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
        		</div>
        		<div class="row feature_inner">
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
        					<h4><i class="fa fa-user"></i>Expert Technicians</h4>
        					<p>Usage of the Internet is becoming more common due to rapid advancement of technology and power.</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
        					<h4><i class="fa fa-news"></i>Professional Service</h4>
        					<p>Usage of the Internet is becoming more common due to rapid advancement of technology and power.</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
        					<h4><i class="fa fa-phone"></i>Great Support</h4>
        					<p>Usage of the Internet is becoming more common due to rapid advancement of technology and power.</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
        					<h4><i class="fa fa-rocket"></i>Technical Skills</h4>
        					<p>Usage of the Internet is becoming more common due to rapid advancement of technology and power.</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
        					<h4><i class="fa fa-diamond"></i>Highly Recomended</h4>
        					<p>Usage of the Internet is becoming more common due to rapid advancement of technology and power.</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
        					<h4><i class=" lnr lnr-bubble"></i>Positive Reviews</h4>
        					<p>Usage of the Internet is becoming more common due to rapid advancement of technology and power.</p>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        
<?php
        include $tpl . 'footer.php';


?>