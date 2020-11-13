<?php
		/*
			Manage Member Page 
			You can Add Delete or Edit Member From Here
		*/
		ob_start();
	    $pageTitle = 'Manage';
          session_start();
          if(isset($_SESSION['Username']))
          {
			  
                include 'init.php';
			  
			  
			  //start manage Page
			  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
			   if ($do == 'Manage')
			   {
				   
				   //this is for show the member that not activate yet 
				   
				   $query = '';
				   
				   if(isset($_GET['page'] ) && $_GET['page'] =='panding')
				   {
					   $query ='AND RegState = 0';
				   }
				   //select all usere except admin
				   
				   $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query");
				   
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
                            <li> <a class="waves-effect waves-dark" href="orders.php" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">Order</span></a></li>
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
                            <h3 class="text-themecolor">Users</h3>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="table-responsive">
					   		<table class= "main-table text-center table table-bordered">
						   		 <tr>
									 <td>#ID</td>
									 <td>Avatar</td>
									 <td>Username</td>
									 <td>Email</td>
									 <td>Full Name</td>
									 <td>Register Data</td>
									 <td>Control</td>
								</tr>
								
								
								<?php
									
									foreach($rows as $row)
									{
										echo "<tr>";
											echo "<td>" . $row['UserID'] ."</td>";
											echo "<td>";
                                        
                                            if($row['image'] == 'test')
                                            {
                                                
                                                echo 'No Image';
                                                
                                            }
                                           else
                                            {
                                             echo "<img src='upload/avatar/".$row['image']."'style='width:80px ; height:80px;border-radius:50%;' alt=''>" ;
                                            }
                                               
                                            echo '</td>';
											echo"<td>" . $row['UserName'] ."</td>";
											echo "<td>" . $row['Email'] ."</td>";
											echo "<td>" . $row['FullName'] ."</td>";
											echo "<td>". $row['Date']. "</td>";
											echo "<td>
												<a href ='members.php?do=Edit&userid="   . $row['UserID']   . "' class='btn btn-success'><i class ='fa fa-edit'></i>Edit</a>
												<a href ='members.php?do=Delete&userid="   . $row['UserID']   . "' class='btn btn-danger confirm '><i class ='fa fa-delete'></i>Delete</a> ";
													if($row['RegState'] == 0 )
													{
														echo "<a href ='members.php?do=Activate&userid="   . $row['UserID']   . "' class='btn btn-info '><i class ='fa fa-'></i>Activate</a>";
													}
										
											echo "</td>";
										echo "</tr>";
											
										
									}

								
								?>

						   </table>
					   </div>
		
				   <a href ="members.php?do=Add" class="btn btn-primary  btn-sm"><i class="fa fa-plus"></i>Add New Member</a>
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
	  <?php
			   }
			  elseif ($do == 'Add')
				  //Add New Member page
			  {
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
                            <li> <a class="waves-effect waves-dark" href="orders.php" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">Order</span></a></li>
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
                            <h3 class="text-themecolor">Insert User</h3>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-lg-12 col-sm-12">
                             
							  <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
								   <!--Start Username Filed-->

								  <div class="form-group  from-group-lg">
									 <label class="col-sm-2 control-label">Username</label>
									  <div class="col-sm-10">
											<input type ="text" name="username"  placeholder="" class="form-control" autocomplete="off" required="required"/>
									  </div>
								  </div>

								  <!--END Username Filed-->

								  <!--Start Password Filed-->

								  <div class="form-group from-group-lg">
									 <label class="col-sm-2 control-label">Password</label>
									  <div class="col-sm-10 ">
										    
											<input type ="password" name="password"  placeholder="" class="form-control" autocomplate="new-password" required="required"/>
									  </div>
								  </div>

								  <!--END Password Filed-->

								  <!--Start Email Filed-->

								  <div class="form-group  from-group-lg">
									 <label class="col-sm-2 control-label">Email</label>
									  <div class="col-sm-10">
											<input type ="email" name="email"  placeholder="" class="form-control" required="required"/>
									  </div>
								  </div>

								  <!--END Email Filed-->

								  <!--Start Full Name Filed-->

								  <div class="form-group  from-group-lg">
									 <label class="col-sm-2 control-label">Full Name</label>
									  <div class="col-sm-10">
											<input type ="text" name="fullName" class="form-control"/>
									  </div>
								  </div>

								  <!--END Full Name Filed-->
                                  <!--Start File Filed-->

								  <div class="form-group  from-group-lg">
									 <label class="col-sm-2 control-label">Add Image</label>
									  <div class="col-sm-10">
											<input type ="file" name="file" class="form-control"/>
									  </div>
								  </div>

								  <!--END file Filed-->

								  <!--Start Sumbit Filed-->

								  <div class="form-group">
									  <div class=" col-sm-offset-2 col-sm-10">
											<input type ="submit" value="Add Member" class="btn btn-primary btn-sm"/>
									  </div>
								  </div>

								  <!--END Sumbit Filed-->
							  </form>
						  </div>
                        </div>
                    </div>
            </div>
    </div>
          <?php
			  }
			  elseif ($do == 'Insert')
			  {
				  //Insert Page
				  
				  
					  echo "<h1 class='text-center' >Insert page </h1>";
				      echo "<div class ='container'>";

					  if($_SERVER['REQUEST_METHOD'] == 'POST')
					  {
                          
                          //get the data form file 
						  //get the varibles from the form
                          
                          $avatarName = $_FILES['file']['name'];
                          $avatarSize = $_FILES['file']['size'];
                          $avatarTmp= $_FILES['file']['tmp_name'];
                          $avatarType = $_FILES['file']['type'];
						  
                          $avatarExtension = array("jpeg" , "jpg" , "png" , "gif");
                          // to know the kind of image
                          $avatarEx =strtolower( end(explode('.' ,  $avatarName)));
                          
                          
						  $user   = $_POST['username'];
						  $pass   = $_POST['password'];
						  $email  = $_POST['email'];
						  $name   = $_POST['fullName'];

						 $hasdpass = sha1($_POST['password']);
						  
						  //Validate the Form 
						  
						  $formError = array();
						  
						  if(strlen($user) < 4 )
						  {
							  $formError[] = '<div class="alert alert-danger">Username cant be small than 4 charicters</div>';
						  }
						  
						  if (empty($user))
						  {
							  $formError[] = '<div class="alert alert-danger">Username cant Be Empty</div>';
						  }
						  
						  if (empty($hasdpass))
						  {
							  $formError[] = '<div class="alert alert-danger">passwoed cant Be Empty</div>';
						  }
						  
						  if (empty($pass))
						  {
							  $formError[] = '<div class="alert alert-danger">Password cant Be Empty</div>';
						  }
						  
						  if (empty($email))
						  {
							  $formError[] = '<div class="alert alert-danger">Email cant Be Empty</div>';
						  }
						  
						  if (empty($name))
						  {
							  $formError[] = '<div class="alert alert-danger">Name cant Be Empty</div>';
						  }
                          if(! !empty($avatarName) && ! in_array( $avatarEx , $avatarExtension ))
                          {
                              $formError[] = '<div class="alert alert-danger">This Extension Is Not Allow</div>';
                          }
                          if($avatarSize > 4194304){
                              $formError[] = '<div class="alert alert-danger">this is size so big </div>';
                          }
						  
						  //loop for all the error 
						
						  foreach ($formError as $error)
						  {
							  echo '<div class="alert alert-danger">'.$error .'</div>';;
						  }
						  
                    
						  if(empty($formError))
						  {
							  
                              $avatar = rand(0 , 10000000000000).'_' .$avatarName ;
                              
                              move_uploaded_file($avatarTmp ,"upload\avatar\\".$avatar );
								   $check = checkItem("UserName","users", $user);

								  if($check == 1)
								  {
									  $theMsg = '<div class="alert alert-danger ">The is some things wrongs </div>' ;
									  redirectHome($theMsg  , 'back');
								  }
								  else
								  {
									 //Updata the database with this info
										$stmt = $con->prepare("INSERT INTO users ( Date , UserName , Password , Email , FullName , RegState , image ) VALUES (now() , :Fuser , :Fpass , :Fmail , :Fname , 1 ,:Favatar )");

										$stmt->execute(array(
											'Fuser' => $user ,
											'Fpass' => $hasdpass ,
											'Fmail' => $email ,
											'Fname' => $name ,
                                            'Favatar'=>$avatar

										));

								  //echo success massage 
                                       $theMsg = '<div class="alert alert-success ">'.$stmt->rowCount() . 'record Updata </div>' ;


                                      redirectHome($theMsg  , 'back');
								 }
						 }
							  
						  
					  }else
					  {
						  $theMsg = '<div class="alert alert-danger ">Sorry You Cant Browse This Pages </div>' ;
						  redirectHome($theMsg  , 'back');
					  }
                
			  }
			  elseif($do == 'Edit')
			  {
				  //Edit Page
				  //Chick if the Get requst is numberical and Get the Intgar value of it 
				  $userid = (isset($_GET['userid']) && is_numeric($_GET['userid']) ) ?  intval($_GET['userid'])  /*print integer value */ : 0 ;
				  
				  //select all data that depandent of Id
					$stmt = $con->prepare("SELECT  * FROM Users WHERE UserID = ? LIMIT 1");
                 //Execute the Query 
					 $stmt->execute(array($userid)); 
				  
				  //Frtch all the data
					 $row =  $stmt->fetch();      //جلب للبياات
				  
				  
				  //number of rows
				  
				  $count = $stmt->rowCount();
				  
				  
				  
				    if( $stmt->rowCount() > 0)
					{		?>

						  <h1 class="text-center">Edit Members</h1>
						  <div class ="container">
							  <form class="form-horizontal" action="?do=Updata" method="POST">
								  <input type ="hidden" name="UserId" value ="<?php echo $userid ; ?>" />
								   <!--Start Username Filed-->

								  <div class="form-group  from-group-lg">
									 <label class="col-sm-2 control-label">Username</label>
									  <div class="col-sm-10">
											<input type ="text" name="username" value = "<?php echo $row['UserName'] ;?> "class="form-control"/ autocomplete="off" required="required">
									  </div>
								  </div>

								  <!--END Username Filed-->

								  <!--Start Password Filed-->

								  <div class="form-group from-group-lg">
									 <label class="col-sm-2 control-label">Password</label>
									  <div class="col-sm-10 col-md-4">
										    <input type ="hidden" name="oldpassword" value ="<?php echo $row['Password'] ; ?>" />
											<input type ="password" name="newpassword"  class="form-control" autocomplate="new-password"/>
									  </div>
								  </div>

								  <!--END Password Filed-->

								  <!--Start Email Filed-->

								  <div class="form-group  from-group-lg">
									 <label class="col-sm-2 control-label">Email</label>
									  <div class="col-sm-10">
											<input type ="email" name="email" value = "<?php echo $row['Email'] ;?>" class="form-control" required="required"/>
									  </div>
								  </div>

								  <!--END Email Filed-->

								  <!--Start Full Name Filed-->

								  <div class="form-group  from-group-lg">
									 <label class="col-sm-2 control-label">Full Name</label>
									  <div class="col-sm-10">
											<input type ="text" name="fullName" value =" <?php echo $row['FullName'] ;?> "class="form-control"/>
									  </div>
								  </div>

								  <!--END Full Name Filed-->

								  <!--Start Sumbit Filed-->

								  <div class="form-group">
									  <div class=" col-sm-offset-2 col-sm-10">
											<input type ="submit" value="Save" class="btn btn-primary"/>
									  </div>
								  </div>

								  <!--END Sumbit Filed-->
							  </form>
						  </div>




			  <?php
					}
				  else 
				  {
					  echo 'Error this is no such member in this id' ;
				  }
			  }elseif($do == 'Updata')
			  {
					   //updata page
					  echo "<h1 class='text-center' >Updata page </h1>";
				      echo "<div class ='container'>";

					  if($_SERVER['REQUEST_METHOD'] == 'POST')
					  {
						  //get the varibles from the form

						  $id 	  = $_POST['UserId'];
						  $user   = $_POST['username'];
						  $email  = $_POST['email'];
						  $name   = $_POST['fullName'];

						  
						  // Password trick
						  $pass   = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
						  
						  //Validate the Form 
						  
						  $formError = array();
						  
						  if(strlen($user) < 4 )
						  {
							  $formError[] = '<div class="alert alert-danger">Username cant be small than 4 charicters</div>';
						  }
						  
						  if (empty($user))
						  {
							  $formError[] = '<div class="alert alert-danger">Username cant Be Empty</div>';
						  }
						  
						  if (empty($pass))
						  {
							  $formError[] = '<div class="alert alert-danger">Password cant Be Empty</div>';
						  }
						  
						  if (empty($email))
						  {
							  $formError[] = '<div class="alert alert-danger">Email cant Be Empty</div>';
						  }
						  
						  if (empty($name))
						  {
							  $formError[] = '<div class="alert alert-danger">Name cant Be Empty</div>';
						  }
						  
						  //loop for all the error 
						
						  foreach ($formError as $error)
						  {
							  echo $error ;
						  }
						  
						  if(empty($formError))
						  {
								 //Updata the database with this info
	
							  $stmt = $con->prepare("UPDATE users SET UserName = ? , Email = ? ,FullName = ? ,Password = ? WHERE UserID = ?");

							  $stmt->execute(array($user , $email , $name, $pass , $id  ));

							  //echo success massage 

							  echo "<div class ='alert alert-success'>" .$stmt->rowCount() . 'record Updata</div>';
 
						  }
							  
						  
					  }else
					  {
						  $theMsg = "<div class ='alert alert-		danger'> this page is not exit </div>";
						 redirectHome($theMsg);
					  }
				  
				  
				  	echo "</div>" ;
				  
				  
		  }elseif($do == 'Delete')
		  {
			  	//detete page 
			  //Chick if the Get requst is numberical and Get the Intgar value of it 
				  $userid = (isset($_GET['userid']) && is_numeric($_GET['userid']) ) ?  intval($_GET['userid'])  /*print integer value */ : 0 ;

				  //select all data that depandent of Id

					$stmt = $con->prepare("SELECT  * FROM Users WHERE UserID = ? LIMIT 1");

				  //Execute the Query 
					 $stmt->execute(array($userid)); 

				  //number of rows

				  	$count = $stmt->rowCount();

				  
				 
				    if( $stmt->rowCount() > 0)
					{
						$stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
						
						// link 
						$stmt->bindParam(":zuser" , $userid);
						
						$stmt->execute();
						
						//echo success massage 

					  	$Themsg = "<div class ='alert alert-		success'>" .$stmt->rowCount() . "Record Delete</div>";
						
						redirectHome($Themsg);
						
					}
				    else
					{
						$theMsg = "<div class ='alert alert-		danger'> this page is not exit </div>";
						 redirectHome($theMsg);
					}
			  
			  
			  
	          }//end if delete member
			  elseif($do == 'Activate')
			  {
				  //detete page 
			  //Chick if the Get requst is numberical and Get the Intgar value of it 
				  $userid = (isset($_GET['userid']) && is_numeric($_GET['userid']) ) ?  intval($_GET['userid'])  /*print integer value */ : 0 ;

				  //select all data that depandent of Id

					$stmt = $con->prepare("SELECT  * FROM Users WHERE UserID = ? LIMIT 1");

				  //Execute the Query 
					 $stmt->execute(array($userid)); 

				  //number of rows

				  	$count = $stmt->rowCount();
				  
				  
				  	if( $stmt->rowCount() > 0)
					{
						$stmt = $con->prepare("UPDATE users SET RegState = 1 WHERE UserID = ?");

						
						$stmt->execute(array($userid));
						
						//echo success massage 
						
					  	$Themsg = "<div class ='alert alert-		success'>" .$stmt->rowCount() . "Record Updated</div>";
						
						redirectHome($Themsg);
						
					}
				  	 else
					{
						$theMsg = "<div class ='alert alert-		danger'> this page is not exit </div>";
						 redirectHome($theMsg);
						 
					}
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