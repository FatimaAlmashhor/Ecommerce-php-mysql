<?php
		/*
			Manage Member Page 
			You can Add Delete or Edit Member From Here
		*/
		ob_start();
	    $pageTitle = 'orders';
          session_start();
          if(isset($_SESSION['Username']))
          {
			  
                include 'init.php';
			  
			  
			  //start manage Page
			  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
			   if ($do == 'Manage')
			   {
				   
				  
				   //select all usere except admin
				   
				   $stmt = $con->prepare("SELECT * FROM orders ");
				   
				   $stmt->execute();
				   
				   $rows = $stmt->fetchAll();
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
                                <a class="nav-link waves-effect waves-dark" href="#"><img src="../../../images/personIcon.png" alt="user" class="profile-pic" /></a>
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
                            <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">Order</span></a></li>
                            <li> <a class="waves-effect waves-dark" href="../home.php" aria-expanded="false"><i class="fa fa-group"></i><span class="hide-menu">Websit</span></a></li>
                            <li> <a class="waves-effect waves-dark" href="pages-error-404.html" aria-expanded="false"><i class="fa fa-sort-down"></i><span class="hide-menu">404</span></a></li>
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
                            <h3 class="text-themecolor">Orders</h3>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="table-responsive">
					   		<table class= "main-table text-center table table-bordered">
						   		 <tr>
									 <td>#ID</td>
									 <td>User</td>
									 <td>Date</td>
									 <td>Quentity</td>
                                     <td>Total</td>
								</tr>
								
								
								<?php
									
									foreach($rows as $row)
									{
                                        $user = $row['user_id'];
                                         $stmt2 = $con->prepare("SELECT UserName FROM users WHERE UserID = ?  ");

                                           $stmt2->execute(array($user));

                                           $username = $stmt2->fetch();
                                        
										echo "<tr>";
											echo "<td>" . $row['order_id'] ."</td>";
											echo"<td>" . $username['UserName'] ."</td>";
											echo "<td>" . $row['order_date'] ."</td>";
											echo "<td>" . $row['items_number'] ."</td>";
											echo "<td>$". $row['total_amount']. "</td>";
										echo "</tr>";
											
										
									}

								
								?>

						   </table>
					   </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
	  <?php
			   }
			  
				  	 else
					{
						$theMsg = "<div class ='alert alert-		danger'> this page is not exit </div>";
						 redirectHome($theMsg);
						 
					}

			  
			  
                include $tpl . 'footer.php';
			  
			  
      }//end if frist if 

	  else 
	  {
		  header('location:home.php');
		  exit();
	  }




	ob_end_flush();



?>