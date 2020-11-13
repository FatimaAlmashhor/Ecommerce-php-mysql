<?php
    session_start();

    $pageTitle = 'Profile';
    
    include 'init.php';

    if(isset($_SESSION['User']))
    {
       $getUser = $con->prepare("SELECT * FROM users WHERE UserName = ?") ;
        
        $getUser->execute(array($sesstionUser));
        $info = $getUser->fetch();
        if($_GET['do'] == 'edit' && isset($_GET['do']))
        {
            ?>

            <div class="container m-50">
                <div class="row">
                    <div class="col-lg-12">
                         <form class="form-horizontal" action="?do=Updata" method="POST"  enctype="multipart/form-data">
                              <input type ="hidden" name="UserId" value ="<?php echo $info['UserID'] ; ?>" />
                               <!--Start Username Filed-->

                              <div class="form-group  from-group-lg">
                                 <label class="col-sm-2 control-label">Username</label>
                                  <div class="col-sm-10">
                                        <input type ="text" name="username" value = "<?php echo $info['UserName'] ;?> "class="form-control"/ autocomplete="off" required="required">
                                  </div>
                              </div>

                              <!--END Username Filed-->

                              <!--Start Password Filed-->

                              <div class="form-group from-group-lg">
                                 <label class="col-sm-2 control-label">Password</label>
                                  <div class="col-sm-10 ">
                                        <input type ="hidden" name="oldpassword" value ="<?php echo $info['Password'] ; ?>" />
                                        <input type ="password" name="newpassword"  class="form-control" autocomplate="new-password"/>
                                  </div>
                              </div>

                              <!--END Password Filed-->

                              <!--Start Email Filed-->

                              <div class="form-group  from-group-lg">
                                 <label class="col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                        <input type ="email" name="email" value = "<?php echo $info['Email'] ;?>" class="form-control" required="required"/>
                                  </div>
                              </div>

                              <!--END Email Filed-->

                              <!--Start Full Name Filed-->

                              <div class="form-group  from-group-lg">
                                 <label class="col-sm-2 control-label">Full Name</label>
                                  <div class="col-sm-10">
                                        <input type ="text" name="fullName" value =" <?php echo $info['FullName'] ;?> "class="form-control"/>
                                  </div>
                              </div>

                              <!--END Full Name Filed-->

                            <div class="edit-img-pro">
                            <?php 
                                if($info['image'] == 'test')
                                {
                                    echo '<img src="images/personIcon.png">';
                                }
                                else
                                {
                                    echo "<img style='width:200px;' src='admin/upload/avatar/".$info['image']."'class='user-img' alt=''>" ;
                                }
                            ?>
                           </div>
                                <input type="file" class="form-control" name="file">
                             <!--Start Sumbit Filed-->

                              <div class="form-group">
                                  <div class=" col-sm-offset-2 col-sm-10">
                                        <input type ="submit" value="Save" class="btn btn-primary"/>
                                  </div>
                              </div>

                              <!--END Sumbit Filed-->
                            </form>
                </div>
            </div>
      </div>
            <?php
            
                
        }else if($_GET['do'] == 'show' &&  isset($_GET['do']))
        {
            
        
    
?>
<div class=" container pro_cart m-50 ">
    <div class="row " style="margin=0; padding=0 ;">
        <div class="col-lg-6 pro-inside text-center">
            <div class="pro-image">
                <div class="cir-image">
                    <?php 
                        if($info['image'] == 'test')
                        {
                            echo '<img src="images/personIcon.png">';
                        }
                        else
                        {
                            echo "<img src='admin/upload/avatar/".$info['image']."' class='user-img' alt=''>" ;
                        }
                    ?>
                    
                </div>
            </div>
            <div class="info-block m-50">
                <div class="user-table">
                    <ul class = "list-unstyled">
                        <li>
                            <i class="fa fa-unlock-alt fa-fw"></i>
                            <span> Login Name </span>  : <?php echo $info['UserName'] ; ?>   <br/>
                        </li>
                        <li>
                            <i class="fa fa-envelope-o fa-fw"></i>
                            <span> Email </span>  :    <?php echo $info['Email'] ; ?>   <br/>
                        </li>
                        <li>
                            <i class="fa fa-user fa-fw"></i>
                             <span> Full Name </span>  :<?php echo $info['FullName'] ;?> <br>
                        </li>
                        <li>
                            <i class="fa fa-calendar fa-fw"></i>
                            <span> Date </span> :      <?php echo $info['Date'] ; ?>    <br/>
                        </li>
                        <li>
                           <i class="fa fa-tags fa-fw"></i>
                            <span> Fav Category </span> :    
                        </li>
                    </ul>
                </div>
            </div>
         <a href = "profile.php?do=edit"class="btn btn-primary btn-sm">edit</a>
        </div>
        
    </div>
    
</div>

               
      
        
       



<?php
        }
        else if($_GET['do'] == 'Updata')
        {
            echo 'good';
            
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

                  $id     = $_POST['UserId'];
                  $user   = $_POST['username'];
                  $email  = $_POST['email'];
                  $name   = $_POST['fullName'];

                   $pass   = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

                  //Validate the Form 
                $nochang = 0 ; // for change the image or not
                  $formError = array();

                  if(strlen($user) < 4 )
                  {
                      $formError[] = '<div class="alert alert-danger">Username cant be small than 4 charicters</div>';
                  }

                  if (empty($user))
                  {
                      $formError[] = '<div class="alert alert-danger">Username cant Be Empty</div>';
                  }

                  if (empty($email))
                  {
                      $formError[] = '<div class="alert alert-danger">Email cant Be Empty</div>';
                  }

                  if (empty($name))
                  {
                      $formError[] = '<div class="alert alert-danger">Name cant Be Empty</div>';
                  }
                  if( ! !empty($avatarName) && ! in_array( $avatarEx , $avatarExtension ))
                  {
                      $nochang = 1;
                    
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
                    if($nochang == 0)
                    {
                         $avatar = rand(0 , 10000000000000).'_' .$avatarName ;
                    }
                      else
                      {
                           $avatar = $info['image'];
                      }
                     

                      move_uploaded_file($avatarTmp ,"admin\upload\avatar\\".$avatar );
                             //Updata the database with this info
	
							  $stmt = $con->prepare("UPDATE users SET UserName = ? , Email = ? ,FullName = ? ,Password = ? , image = ? WHERE UserID = ?");

							  $stmt->execute(array($user , $email , $name, $pass ,$avatar, $id  ));


                          //echo success massage 
                               $theMsg = '<div class="alert alert-success ">'.$stmt->rowCount() . 'record Updata </div>' ;


                              redirectHome($theMsg  , 'back');
                         
                 }


              }else
              {
                  $theMsg = '<div class="alert alert-danger ">Sorry You Cant Browse This Pages </div>' ;
                  redirectHome($theMsg  , 'back');
              }
        
        }
        else if (! isset($_GET['do']))
        {
            header('location:login.php');
         exit();
        }
    }
    else 
    {
        header('location:login.php');
        exit();
    }
    include  $tpl . 'footer.php';
?>
