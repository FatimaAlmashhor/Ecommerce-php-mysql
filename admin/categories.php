<?php
	/*
		Category page 
		You can Add Delete or Edit Categories From Here
	*/


	ob_start(); 

	 $pageTitle = 'Categories';

	 session_start();

     if(isset($_SESSION['Username']))
	  {
		  include 'init.php';


		  //start manage Page
		  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
		   if ($do == 'Manage')
		   {
			   //manage page
			   
			   //for ordering the items 
			   $sort = 'ASC' ;
			   
			   $sort_array = array('ASC' , 'DESC');
			   
			   if(isset($_GET['sort']) && in_array($_GET['sort'] ,$sort_array ))
			   {
				    $sort = $_GET['sort'];
			   }
			   
			   $stmt = $con->prepare("SELECT * FROM  category ORDER BY ordering $sort");
			   
			   $stmt->execute();
			   
			   $cats = $stmt->fetchAll();?>
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
                <div class="container-fluid category">
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-themecolor">Categories</h3>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-lg-12 col-sm-12">
                            <div class="panel-heading">Mange Caregories
					
						<div class="ordering pull-right">
							Ordering :
							<a class="<?php if($sort == 'ASC'){ echo 'active' ;}?>" href="?sort=ASC">ASC</a> |
							<a class="<?php if($sort == 'DESC'){ echo 'active' ;}?>" href="?sort=DESC">DESC</a>
						</div>
					</div>
					<div class="panel-body">
						<?php
							foreach($cats as $cat)
							{
								echo "<div class='cat'>";
									echo "<div class='hidden-buttons'>";
										echo "<a href='categories.php?do=Edit&catid=". $cat['ID'] . "' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i>Edit</a> ";
										echo "<a href='categories.php?do=Delete&catid=". $cat['ID'] . "' class=' confirm btn btn-xs btn-danger'><i class='fa fa-close'></i>Delete</a>";
									echo"</div>";
									echo "<h3>" . $cat['Name'] . '</h3>';	
									echo "<p>";  if($cat['Description']== ''){echo 'this is empty Decription' ; }else{
										echo $cat['Description'];}
									echo "</p>";
									 if($cat['visibility'] == 1){echo '<span class="visibilty">Hidden</span> '; }else{
									 echo '<span class="visibilty">Visible</span> ';} 
									if($cat['allow_comment'] == 1){echo '<span class="comment">disble comments</span> '; }else{
									 echo '<span class="comment">Visible comments</span> ';} 
									if($cat['allow_ads'] == 1){echo '<span class="ads">disble Ads</span> '; }else{
									 echo '<span class="ads">Visible Ads</span> ';} 
								echo "</div>";
								echo "<hr/>";
							}
						
						?>
					</div>
					<a class="btn btn-primary add-btn" href ="categories.php?do=Add"><i class="fa fa-plus"></i>Add New Category</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>

				

				   
			<?php   
		   }elseif($do == 'Add')
		   {
			   ?>
			   <h1 class="text-center">Add New Category</h1>
			  <div class ="container">
				  <form class="form-horizontal" action="?do=Insert" method="POST">
					   <!--Start Name Filed-->

					  <div class="form-group  from-group-lg">
						 <label class="col-sm-2 control-label">Name</label>
						  <div class="col-sm-10">
								<input type ="text" name="name"  placeholder="" class="form-control" autocomplete="off" required="required"/>
						  </div>
					  </div>

					  <!--END Name Filed-->

					  <!--Start Description Filed-->

					  <div class="form-group from-group-lg">
						 <label class="col-sm-2 control-label">Description</label>
						  <div class="col-sm-10 ">

								<input type ="text" name="des"  placeholder="" class="form-control"  />
						  </div>
					  </div>

					  <!--END Description Filed-->

					  <!--Start ordering Filed-->

					  <div class="form-group  from-group-lg">
						 <label class="col-sm-2 control-label">Ordering</label>
						  <div class="col-sm-10">
								<input type ="text" name="ordering"  placeholder="" class="form-control" />
						  </div>
					  </div>

					  <!--END ordering Filed-->

					  <!--Start Visiblity Name Filed-->

					  <div class="form-group  from-group-lg">
						 <label class="col-sm-2 control-label">Visible</label>
						  <div class="col-sm-10">
							<div>
								<input id ="vis-yes" type="radio" name="visible" value="0" checked/>
								<label for="vis-yes">Yes</label>
							</div>
							  <div>
								<input id ="vis-no" type="radio" name="visible" value="1" />
								<label for="vis-no">No</label>
							</div>
						  </div>
					  </div>

					  <!--END Visiblity Name Filed-->
					  
					  <!--Start commenting Name 	Filed-->

					  <div class="form-group  from-group-lg">
						 <label class="col-sm-2 control-label">Allow Commenting</label>
						  <div class="col-sm-10">
							<div>
								<input id ="com-yes" type="radio" name="com" value="0" checked/>
								<label for="com-yes">Yes</label>
							</div>
							  <div>
								<input id ="com-no" type="radio" name="com" value="1" />
								<label for="com-no">No</label>
							</div>
						  </div>
					  </div>

					  <!--END commenting Name Filed-->
					  
					   <!--Start Ads Name 	Filed-->

					  <div class="form-group  from-group-lg">
						 <label class="col-sm-2 control-label">Allow Ads</label>
						  <div class="col-sm-10">
							<div>
								<input id ="ads-yes" type="radio" name="ads" value="0" checked/>
								<label for="ads-yes">Yes</label>
							</div>
							  <div>
								<input id ="ads-no" type="radio" name="ads" value="1" />
								<label for="ads-no">No</label>
							</div>
						  </div>
					  </div>

					  <!--END Ads Name Filed-->
					  
					  

					  <!--Start Sumbit Filed-->

					  <div class="form-group">
						  <div class=" col-sm-offset-2 col-sm-10">
								<input type ="submit" value="Add Category" class="btn btn-primary"/>
						  </div>
					  </div>

					  <!--END Sumbit Filed-->
				  </form>
			  </div>

			<?php
			   
		   }elseif($do == 'Insert')
		   {
			   //Insert Page
				  
				  
					  echo "<h1 class='text-center' >Insert page </h1>";
				      echo "<div class ='container'>";

					  if($_SERVER['REQUEST_METHOD'] == 'POST')
					  {
						  //get the varibles from the form
						  
						  $name       = $_POST['name'];
						  $des        = $_POST['des'];
						  $visi       = $_POST['visible'];
						  $ordering   = $_POST['ordering'];
						  $com        = $_POST['com'];
						  $ads        = $_POST['ads'];

						  
						  //Validate the Form 
						 
						  
						  if (empty($name))
						  {
							  $formError[] = '<div class="alert alert-danger">Username cant Be Empty</div>';
						  }


						   $check = checkItem("Name","category", $name);

						  if($check == 1)
						  {
							  $theMsg = '<div class="alert alert-danger ">The is some things wrongs </div>' ;
							  redirectHome($theMsg  , 'back');
						  }
						  else
						  {
							 //Updata the database with this info
								$stmt = $con->prepare("INSERT INTO category ( Name , 	Description , visibility , 	allow_comment , allow_ads , ordering) VALUES (:zname , :zdce , :zvisi , :zcom , :zads , :zord)");

								$stmt->execute(array(
									'zname' =>$name ,   
									'zdce' => $des  ,    
									'zvisi' =>$visi ,   
									'zcom' => $com ,
									'zads' =>  $ads,     
									'zord' => $ordering      
								));

						  //echo success massage 

						  $theMsg = "<div class ='alert alert-success'>" .$stmt->rowCount() . 'record Updata</div>';
							  
							  redirectHome($theMsg , 'back');
						 }

							  

					  }else
					  {
						  $theMsg = '<div class="alert alert-danger ">Sorry You Cant Browse This Pages </div>' ;
						  redirectHome($theMsg  , 'back');
					  }
	
		   } elseif($do == 'Edit')
		   {
			   //Edit Page
				  //Chick if the Get requst is numberical and Get the Intgar value of it 
				  $catid = (isset($_GET['catid']) && is_numeric($_GET['catid']) ) ?  intval($_GET['catid'])  /*print integer value */ : 0 ;
				  
				  //select all data that depandent of Id
					$stmt = $con->prepare("SELECT  * FROM category WHERE ID = ? ");
                 //Execute the Query 
					 $stmt->execute(array($catid)); 
				  
				  //Frtch all the data
					 $cat =  $stmt->fetch();      //جلب للبياات
				  
				  
				  //number of rows
				  
				  $count = $stmt->rowCount();
				  
				  
				  
				    if( $stmt->rowCount() > 0)
					{		
				?>
						<h1 class="text-center">Edit Category</h1>
					  <div class ="container">
						  <form class="form-horizontal" action="?do=Updata" method="POST">
							  <input type ="hidden" name="catid" value ="<?php echo $catid ;?>"/>
							   <!--Start Name Filed-->

							  <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">Name</label>
								  <div class="col-sm-10">
										<input type ="text" name="name" value ="<?php echo $cat['Name'] ;?>" placeholder="" class="form-control" required="required"/>
								  </div>
							  </div>

							  <!--END Name Filed-->

							  <!--Start Description Filed-->

							  <div class="form-group from-group-lg">
								 <label class="col-sm-2 control-label">Description</label>
								  <div class="col-sm-10 ">

										<input type ="text" name="des"  value ="<?php echo $cat['Description'] ;?>" placeholder="" class="form-control"  />
								  </div>
							  </div>

							  <!--END Description Filed-->

							  <!--Start ordering Filed-->

							  <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">Ordering</label>
								  <div class="col-sm-10">
										<input type ="text"  value ="<?php echo $cat['ordering'] ;?>" name="ordering"  placeholder="" class="form-control" />
								  </div>
							  </div>

							  <!--END ordering Filed-->

							  <!--Start Visiblity Name Filed-->

							  <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">Visible</label>
								  <div class="col-sm-10">
									<div>
										<input id ="vis-yes" type="radio" name="visible" value="0" <?php if($cat['visibility'] == 0){ echo 'checked' ;}?> />
										<label for="vis-yes">Yes</label>
									</div>
									  <div>
										<input id ="vis-no" type="radio" name="visible" value="1" <?php if($cat['visibility'] == 1 ){ echo 'checked' ;}?>/>
										<label for="vis-no">No</label>
									</div>
								  </div>
							  </div>

							  <!--END Visiblity Name Filed-->

							  <!--Start commenting Name 	Filed-->

							  <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">Allow Commenting</label>
								  <div class="col-sm-10">
									<div>
										<input id ="com-yes" type="radio" name="com" value="0"  <?php if($cat['allow_comment'] == 0){ echo 'checked' ;}?> />
										<label for="com-yes">Yes</label>
									</div>
									  <div>
										<input id ="com-no" type="radio" name="com" value="1" <?php if($cat['allow_comment'] == 1){ echo 'checked' ;}?> />
										<label for="com-no">No</label>
									</div>
								  </div>
							  </div>

							  <!--END commenting Name Filed-->

							   <!--Start Ads Name 	Filed-->

							  <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">Allow Ads</label>
								  <div class="col-sm-10">
									<div>
										<input id ="ads-yes" type="radio" name="ads" value="0" <?php if($cat['allow_ads'] == 0){ echo 'checked' ;}?>/>
										<label for="ads-yes">Yes</label>
									</div>
									  <div>
										<input id ="ads-no" type="radio" name="ads" value="1" <?php if($cat['allow_ads'] == 1){ echo 'checked' ;}?> />
										<label for="ads-no">No</label>
									</div>
								  </div>
							  </div>

							  <!--END Ads Name Filed-->



							  <!--Start Sumbit Filed-->

							  <div class="form-group">
								  <div class=" col-sm-offset-2 col-sm-10">
										<input type ="submit" value="Updata Category" class="btn btn-primary"/>
								  </div>
							  </div>

							  <!--END Sumbit Filed-->
						  </form>
					  </div>



			    <?php
					}
				    else 
					  {
						  echo "<div class='container'>";
							$themsg = '<div class= "alert alert-danger">There is no Sunch id </div>';
							
							redirectHome($themsg);
							echo"</div>";
					  }
			   
		   }elseif($do == 'Delete')
		   {
			   //detete page 
			  //Chick if the Get requst is numberical and Get the Intgar value of it 
			   
			   echo "<h1 class='text-center'>Delete Category</h1>";
			   echo "<div class='container'>";
			   
			  $catid = (isset($_GET['catid']) && is_numeric($_GET['catid']) ) ?  intval($_GET['catid'])  /*print integer value */ : 0 ;

			  //select all data that depandent of Id

				$check = checkItem('ID' , 'category' , $catid);


				if( $check  > 0)
				{
					$stmt = $con->prepare("DELETE FROM category WHERE ID = :zcat");

					// link 
					$stmt->bindParam(":zcat" , $catid);

					$stmt->execute();

					//echo success massage 

					$Themsg = '<div class ="alert alert-		success">' .$stmt->rowCount() . 'Record Delete</div>';

					redirectHome($Themsg , 'back');

				}
				else
				{
					$theMsg = "<div class ='alert alert-		danger'> this page is not exit </div>";
					 redirectHome($theMsg);
				}

		   }elseif($do == 'Updata')
		   {
			    //updata page
					  echo "<h1 class='text-center' >Updata page </h1>";
				      echo "<div class ='container'>";

					  if($_SERVER['REQUEST_METHOD'] == 'POST')
					  {
						  //get the varibles from the form

						  $id 	  	   = $_POST['catid'];
						  $name   	   = $_POST['name'];
						  $des    	   = $_POST['des'];
						  $visi   	   = $_POST['visible'];
						  $com    	   = $_POST['com'];
						  $ads    	   = $_POST['ads'];
						  $ordering    = $_POST['ordering'];

						 
					  //Updata the database with this info

						  $stmt = $con->prepare("UPDATE category SET  Name = ? , Description = ? ,visibility = ? ,allow_comment = ? , allow_ads = ? , ordering = ? WHERE ID = ? ");

						  $stmt->execute(array(  	
												 $name,
												 $des ,
												 $visi,
												 $com ,
												 $ads  ,
							  					 $ordering ,
						  						 $id
						  ));

						  //echo success massage 

						  $theMsg = "<div class ='alert alert-success'>" .$stmt->rowCount() . 'record Updata</div>';
						  
						  redirectHome($theMsg , 'back');
					  }
					  else
					  {
						  $theMsg = "<div class ='alert alert-		danger'> this page is not exit </div>";
						 redirectHome($theMsg);
					  }
				  
				  
				  	echo "</div>" ;
				  
				  
		   }elseif($do == 'Activate')
		   {
			   
		   }
		   
		 
		 
		 include $tpl . 'footer.php';
		 
	 }else
	 {
		
	  header('location:home.php');
	  exit();
	  
	 }

  ob_end_flush();

?>