<?php
          $pageTitle = 'DashBoard';
          session_start();

          if(isset($_SESSION['Username']))
          {
                include 'init.php';
			  
			    $latestUser = 5;
			  	$Latest = getLatest("*" , "users" , "UserID", $latestUser ) ;
			    $lates2 =  getLatest("*" , "items" , "itemID", $latestUser ) 
 
			  ?>


<body class="fix-header fix-sidebar card-no-border">

    <div class="main-wrapper">
        <header class="top-bar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a  class="navbar-brand" href="../../home.php">
                        TrueMax
                    </a>
                </div>
                <div class="navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" ><i class="ti-menu"></i></a> </li>
                        </ul>

                        <ul class="navbar-nav my-lg-0">
                            <li class="nav-item">
                                <a class="nav-link waves-effect waves-dark" href="logout.php"> Admin <img src="images/adver.jpeg" style="width:100px" alt="user" class="profile-pic" /></a>
                            </li>
                        </ul>
                    </div>
            </nav>
        </header>
         <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li> <a class="waves-effect waves-dark" href="dashboard.php" aria-expanded="false"><i class="fa fa-cloud"></i><span class="hide-menu">Dashboard</span></a></li>
                            <li> <a class="waves-effect waves-dark" href="members.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Users</span></a></li>
                            <li> <a class="waves-effect waves-dark" href="items.php" aria-expanded="false"><i class="fa fa-edit"></i><span class="hide-menu">Product</span></a></li>
                            <li> <a class="waves-effect waves-dark" href="categories.php" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Category</span></a></li>
                            <li> <a class="waves-effect waves-dark" href="orders.php" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">Order</span></a></li>
                            <li> <a class="waves-effect waves-dark" href="../home.php" aria-expanded="false"><i class="fa fa-group"></i><span class="hide-menu">Websit</span></a></li>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <div class="page-wrapper">
                <div class="container-fluid">
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-themecolor">Dashboard</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <a href="members.php">
                                <div class="stat">
                                    <span><i class="fa fa-user"></i><p>Total Member</p>
                                    <?php echo countItem('UserId' , 'users') ;?></span>
                                </div>
                            </a>
						</div>
						<div class="col-md-3 col-sm-6">
							<a href ="members.php?do=Manage&page=panding">
                                <div class="stat">
                                   <span><i class="fa fa-user"></i><p>Panding Member</p> 
                                    <?php echo  checkItem('RegState' , 'users' , '0') ;?></span>
                                </div>
                            </a>
						</div>
						<div class="col-md-3 col-sm-6">
                            <a href="items.php">
                                <div class="stat">
                                    <span ><i class="fa fa-tags"></i><p>Total Item</p>
                                    <?php echo countItem('itemID' , 'items') ;?></span>
                                </div>
                            </a>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="stat">
								<span><i class="fa fa-edit"></i><p>Total Comments</p>
								<?php echo countItem('com_ID' , ' comment') ;?></span>
							</div>
						</div>
                    </div>
                   <section class="search-items">
                        <div class="container p-120">
                            <div class="row">
                                <div class="col-md-5 align-self-center">
                                        <h3 class="text-themecolor">Users And Items</h3>
                                </div>
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
                                                         echo "<img src='../images/personIcon.png'class='user-img'style='width:70px;height:70px;border-radius:50%;' alt=''>" ;
                                                         echo '</td>';
                                                    }
                                                    else
                                                    {
                                                         echo '<td>';
                                                         echo "<img src='upload/avatar/".$user['image']."' style='width:70px;height:70px;border-radius:50%;' class='user-img'  alt=''>" ;
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
                                                         echo "<img src='../images/ItemBox.svg'class='user-img'style='width:70px;height:70px;border-radius:50%;' alt=''>" ;
                                                         echo '</td>';
                                                    }
                                                    else
                                                    {
                                                         echo '<td>';
                                                         echo "<img src='upload/avatar/".$user['item_image']."' style='width:70px;height:70px;border-radius:50%;' class='user-img'  alt=''>" ;
                                                         echo '</td>';
                                                    }
                                                    
                                                    echo '</tr>';
                   
                                                }
                                            
                                                    
                                                    
                                                ?>
                                            </table>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
    </div>

				<!--  
				<div class="container home-stats text-center">
					<h1>Dashboard</h1>
					<div class="row">
						<div class="col-md-3 col-sm-6">
                            <a href="members.php">
                                <div class="stat">
                                    <span><i class="fa fa-user"></i><p>Total Member</p>
                                    <?php echo countItem('UserId' , 'users') ;?></span>
                                </div>
                            </a>
						</div>
						<div class="col-md-3 col-sm-6">
							<a href ="members.php?do=Manage&page=panding">
                                <div class="stat">
                                   <span><i class="fa fa-user"></i> Panding Member
                                    <?php echo  checkItem('RegState' , 'users' , '0') ;?></span>
                                </div>
                            </a>
						</div>
						<div class="col-md-3 col-sm-6">
                            <a href="items.php">
                                <div class="stat">
                                    <span ><i class="fa fa-tags"></i>Total Item
                                    <?php echo countItem('itemID' , 'items') ;?></span>
                                </div>
                            </a>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="stat">
								<span><i class="fa fa-edit"></i>Total Comments
								<?php echo countItem('com_ID' , ' comment') ;?></span>
							</div>
						</div>
					</div>
				</div> 
				<div class="container latest">
					<div class="row">
						<div class=" col-lg-6 col-md-6">
							<div class="panel panel-default">
								<div class="panel panel-heading ">
									<i class="fa fa-users"></i>
									Latest <?php $latestUser ;?> Registerd Users
								</div>
								<div class="panel-body">
									<ul class="list-unstyled latest-users">
									<?php
										//loop for panel
			  
										foreach($Latest as $user)
										{
											echo '<li>';
												echo $user['UserName'] ;
													echo '<span class="btn btn-success pull-right">';
													echo '<i class="fa fa-edit"></i><a href="members.php?do=Edit&userid='.$user['UserID'] .'">Edit</a>';
													echo '</span>';
											echo'</li>';			
										}

									?>
									</ul>
								</div>
							</div>
						</div>
                        <div class=" col-lg-6 col-md-6">
							<div class="panel panel-default">
								<div class="panel panel-heading ">
									<i class="fa fa-tag"></i>
									Latest Items
								</div>
								<div class="panel-body">
									<ul class="list-unstyled latest-users">
									<?php
										//loop for panel
			  
										foreach($lates2 as $item)
										{
											echo '<li>';
												echo $item['item_name'] ;
													echo '<span class="btn btn-success pull-right">';
													echo '<i class="fa fa-edit"></i><a href="items.php?do=Edit&itemid='.$item['itemID'] .'">Edit</a>';
													echo '</span>';
											echo'</li>';			
										}

									?>
									</ul>
								</div>
							</div>
						</div>

					</div>
                 </div>
					-->	
				  
				  
				  
				  <?php
				  
			
                include $tpl . 'footer.php';
          } 
          else 
          {
              header('location:../home.php');
              exit();
          }





?>