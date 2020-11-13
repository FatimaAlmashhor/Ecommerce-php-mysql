<?php
	/*
		Items page 
		You can Add Delete or Edit Categories From Here
	*/


	ob_start(); 

	 $pageTitle = 'Items';

	 session_start();

     if(isset($_SESSION['Username']))
	  {
		  include 'init.php';


		  //start manage Page
		  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
		   if ($do == 'Manage')
		   {

               $stmt = $con->prepare("SELECT * FROM items");

               $stmt->execute();

               $items = $stmt->fetchAll();
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
                            <h3 class="text-themecolor">Products</h3>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-lg-12 col-sm-12">
                            <div class="table-responsive">
                            <table class= "main-table text-center table table-bordered">
                                 <tr>
                                    <td>#ID</td>
                                    <td>Image</td>
                                     <td>name</td>
                                     <td>Description</td>
                                     <td>Price</td>
                                     <td>Date</td>
                                     <td>Control</td>
                                </tr>


                                <?php

                                    foreach($items as $item)
                                    {
                                        echo "<tr>";
                                            echo "<td>" . $item['itemID']      ."</td>";
                                            echo "<td>";

                                                if(empty($item['item_image']))
                                                {

                                                    echo 'No Image';

                                                }
                                               else
                                                {
                                                 echo "<img src='admin/upload/items/".$item['item_image']."'style='width:100px' alt=''>" ;
                                                }

                                                echo '</td>';
                                            echo "<td>" . $item['item_name']   ."</td>";
                                            echo "<td>" . $item['Description'] ."</td>";
                                            echo "<td>" . $item['Price']       ."</td>";
                                            echo "<td>" . $item['item_date']   . "</td>";
                                            echo "<td>
                                                <a href ='items.php?do=Edit&itemid="   . $item['itemID']   . "' class='btn btn-success btn-sm '><i class ='fa fa-edit'></i>Edit</a>
                                                <a href ='items.php?do=Delete&itemid="   . $item['itemID']   . "' class='btn btn-danger btn-sm confirm '><i class ='fa fa-delete'></i>Delete</a> ";

                                            echo "</td>";
                                        echo "</tr>";


                                    }


                                ?>

                           </table>
                       </div>

                     <a href ="items.php?do=Add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add New Item</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
               
                   
          <?php
		   }elseif($do == 'Add')
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
                            <h3 class="text-themecolor">Insert Product</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <!--END inter image Filed-->
                          <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                               <!--Start Name Filed-->

                              <div class="form-group  from-group-lg">
                                 <label class="col-sm-2 control-label">Name</label>
                                  <div class="col-sm-10">
                                        <input type ="text" name="name"  placeholder="Name of the Item" class="form-control" />
                                  </div>
                              </div>

                              <!--END Name Filed-->
                             <!--Start Description Filed-->

                              <div class="form-group  from-group-lg">
                                 <label class="col-sm-2 control-label">Description</label>
                                  <div class="col-sm-10">
                                        <input type ="text" name="Des"  placeholder="Description" class="form-control"  />
                                  </div>
                              </div>

                              <!--END Description Filed-->
                             <!--Start Price Filed-->

                              <div class="form-group  from-group-lg">
                                 <label class="col-sm-2 control-label">Price</label>
                                  <div class="col-sm-10">
                                        <input type ="text" name="price"  placeholder="add your price" class="form-control"  />
                                  </div>
                              </div>

                              <!--END Price Filed-->
                            <!--Start country_made Filed-->

                              <div class="form-group  from-group-lg">
                                 <label class="col-sm-2 control-label">country </label>
                                  <div class="col-sm-10">
                                        <input type ="text" name="con_made"  placeholder="Country of made" class="form-control" />
                                  </div>
                              </div>

                              <!--END country_made Filed-->
                              <!--Start Stats Filed-->

                              <div class="form-group  from-group-lg">
                                 <label class="col-sm-2 control-label">Status </label>
                                  <div class="col-sm-10">
                                      <select class="form-control" name="stats">
                                          <option value = "0">...</option>
                                          <option value = "1">New</option>
                                          <option value = "2">NOT Very New</option>
                                          <option value = "3">Old</option>
                                      </select>
                                  </div>
                              </div>

                              <!--END Stats Filed-->
                              <!--Start inter image Filed-->

                             <!--Start Members Filed-->
                                <!--Start File Filed-->

                                          <div class="form-group  from-group-lg">
                                             <label class="col-sm-2 control-label">Add Image</label>
                                              <div class="col-sm-10">
                                                    <input type ="file" name="file" class="form-control"/>
                                              </div>
                                          </div>

                                          <!--END file Filed-->
                               <!--Start Catogray Filed-->

                              <div class="form-group  from-group-lg">
                                 <label class="col-sm-2 control-label">Gategory </label>
                                      <div class="col-sm-10">
                                          <select class="form-control" name="category" >
                                              <option value = "0">...</option>
                                                    <?php
                                                        $stmt2= $con->prepare("SELECT * FROM category");
                                                        $stmt2->execute();
                                                        $cats = $stmt2->fetchAll();

                                                        foreach($cats as $cat)
                                                        {
                                                            echo "<option value = '".$cat["ID"]."'>".$cat["Name"] ."</option>";
                                                        }
                                                    ?>
                                          </select>
                                      </div>
                                  </div>

                                  <!--END Catogray Filed--> 


                                  <!--Start Sumbit Filed-->

                                  <div class="form-group">
                                      <div class=" col-sm-offset-2 col-sm-10">
                                            <input type ="submit" value="Add Item" class="btn btn-primary btn-sm"/> 
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
			   
		   }elseif($do == 'Insert')
		   {
			   //Insert Page
				  
				  
					  echo "<h1 class='text-center' >Insert page </h1>";
				      echo "<div class ='container'>";

					  if($_SERVER['REQUEST_METHOD'] == 'POST')
					  {
						  //get the varibles from the form
						  
                          
                          $avatarName = $_FILES['file']['name'];
                          $avatarSize = $_FILES['file']['size'];
                          $avatarTmp  = $_FILES['file']['tmp_name'];
                          $avatarType = $_FILES['file']['type'];
                          
                           
						  
                          $avatarExtension = array("jpeg" , "jpg" , "png" , "gif" , "svg");
                          // to know the kind of image
                          $avatarEx =strtolower( end(explode('.' ,  $avatarName)));
                           
                          
						  $name        = $_POST['name'];
						  $des         = $_POST['Des'];
						  $price       = $_POST['price'];
						  $con_made    = $_POST['con_made'];
                          $stats       = $_POST['stats'];
                          $cates       =  $_POST['category'];

						   //get the varibles from the form
                          
                         
                          
                          $formError = array();
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
                              
                              move_uploaded_file($avatarTmp ,"upload\items\\".$avatar );
								   $check = checkItem("UserName","users", $user);

							 //Updata the database with this info
								$stmt = $con->prepare("INSERT INTO items ( item_name , 	Description , Price , 	country_made , state , item_date,Cat_ID , item_image) VALUES (:zname , :zdce , :zprice , :zcontry , :zstats, now()  , :zcats ,:Fimage)");

								$stmt->execute(array(
									'zname'   =>$name       ,   
									'zdce'    =>$des        ,    
									'zprice'  =>$price      ,   
									'zcontry' =>$con_made   ,
									'zstats'  =>$stats      ,  
									'zcats'   =>$cates         ,
                                    'Fimage'  =>$avatar 
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
				  $itemid = (isset($_GET['itemid']) && is_numeric($_GET['itemid']) ) ?  intval($_GET['itemid'])  /*print integer value */ : 0 ;
				  
				  //select all data that depandent of Id
					$stmt = $con->prepare("SELECT  * FROM items WHERE itemID = ? ");
                 //Execute the Query 
					 $stmt->execute(array($itemid)); 
				  
				  //Frtch all the data
					 $item =  $stmt->fetch();      //جلب للبياات
				  
				  
				  //number of rows
				  
				  $count = $stmt->rowCount();
				  
				  
				  
				    if( $stmt->rowCount() > 0)
					{		
				?>
						<h1 class="text-center">Edit Item</h1>
					  <div class ="container">
						  <form class="form-horizontal" action="?do=Updata" method="POST">
							  <input type ="hidden" name="itemid" value ="<?php echo $itemid ;?>"/>
							   <!--Start Name Filed-->

							  <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">Name</label>
								  <div class="col-sm-10">
										<input type ="text" name="name" value ="<?php echo $item['item_name'] ;?>" placeholder="" class="form-control" required="required"/>
								  </div>
							  </div>

							  <!--END Name Filed-->

							  <!--Start Description Filed-->

							  <div class="form-group from-group-lg">
								 <label class="col-sm-2 control-label">Description</label>
								  <div class="col-sm-10 ">

										<input type ="text" name="des"  value ="<?php echo $item['Description'] ;?>" placeholder="" class="form-control"  />
								  </div>
							  </div>

							  <!--END Description Filed-->

							  <!--Start Price Filed-->

							  <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">Price</label>
								  <div class="col-sm-10">
										<input type ="text"  value ="<?php echo $item['Price'] ;?>" name="price"  placeholder="" class="form-control" />
								  </div>
							  </div>

							  <!--END Price Filed-->

							  <!--Start country_made  Filed-->

							  <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">Country</label>
								  <div class="col-sm-10">
                                      <input type ="text"  value ="<?php echo $item['country_made'] ;?>" name="country"  placeholder="" class="form-control" />
								  </div>
							  </div>

							  <!--END country_made  Filed-->
                              
                              <!--Start state  Filed-->
                              <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">State</label>
								  <div class="col-sm-10">
                                      <input type ="text"  value ="<?php echo $item['state'] ;?>" name="state"  placeholder="" class="form-control" />
								  </div>
							  </div>

							  <!--END state Filed-->
                              
                               <!--Start Cat_ID  Filed-->
                              <div class="form-group  from-group-lg">
								 <label class="col-sm-2 control-label">Category</label>
								  <div class="col-sm-10">
                                      <input type ="text"  value ="<?php echo $item['Cat_ID'] ;?>" name="cat"  placeholder="" class="form-control" />
								  </div>
							  </div>

							  <!--END Cat_ID Filed-->



							  <!--Start Sumbit Filed-->

							  <div class="form-group">
								  <div class=" col-sm-offset-2 col-sm-10">
										<input type ="submit" value="Updata Item" class="btn btn-primary btn-sm"/>
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
			   
			   echo "<h1 class='text-center'>Delete item</h1>";
			   echo "<div class='container'>";
			   
			  $itemid = (isset($_GET['itemid']) && is_numeric($_GET['itemid']) ) ?  intval($_GET['itemid'])  /*print integer value */ : 0 ;

			  //select all data that depandent of Id

				$check = checkItem('itemID' , 'items' , $itemid);


				if( $check  > 0)
				{
					$stmt = $con->prepare("DELETE FROM items WHERE itemID = :zitem");

					// link 
					$stmt->bindParam(":zitem" , $itemid);

					$stmt->execute();

					//echo success massage 

					$Themsg = '<div class ="alert alert-success">' .$stmt->rowCount() . 'Record Delete</div>';

					redirectHome($Themsg , 'back');

				}
				else
				{
					$theMsg = "<div class ='alert alert-danger'> this page is not exit </div>";
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

						  $id 	  	   = $_POST['itemid'];
						  $name   	   = $_POST['name'];
						  $des    	   = $_POST['des'];
						  $price   	   = $_POST['price'];
                          $country     = $_POST['country'];
						  $state       = $_POST['state'];
						  $cat    	   = $_POST['cat'];
						 
					  //Updata the database with this info

						  $stmt = $con->prepare("UPDATE items SET  item_name = ? , Description = ? ,Price = ? ,country_made = ? , state = ? , Cat_ID = ? WHEREitemID = ? ");

						  $stmt->execute(array(  	
												 $name    ,
												 $des     ,
												 $price   ,
												 $country ,
												 $state   ,
							  					 $cat     ,
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