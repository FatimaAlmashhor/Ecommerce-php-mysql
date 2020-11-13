<?php
        
        $noNavber = ''; 
        $pageTitle = 'Login';
        session_start();
        if(isset($_SESSION['User']))
        {
            header('Location:home.php');
        }
        include 'init.php' ;

        $formError = '';
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['login']))
            {
                
            
                $username = $_POST['username'] ;
                $password = $_POST['password'] ;
                $hashedPass = sha1($password);


                $stmt = $con->prepare("SELECT  UserID , UserName , Password FROM Users WHERE UserName = ? AND Password = ? ");

                 $stmt->execute(array($username , $hashedPass )); 
                 $count = $stmt->rowCount();
                 
                 if($count > 0){
                          //Check if the user exist in databases is admin

                         $stmt2 = $con->prepare("SELECT  UserID , UserName , Password FROM Users WHERE UserName = ? AND Password = ? AND GroupID = 1 LIMIT 1");

                         $stmt2->execute(array($username , $hashedPass )); 
                         $row =  $stmt2->fetch();      //جلب للبياات
                         $count2 = $stmt2->rowCount();

                         if($count2 > 0){

                             $_SESSION['Username'] = $username ;  //Register Session Name
                             $_SESSION['ID'] = $row['UserID'];   //Register Session ID
                             header('location:admin/dashboard.php');
                             exit();
                         }
                         else
                         {
                              $_SESSION['User'] = $username ;  //Register Session Name

                                 header('location:home.php');
                                 exit();
                         }

                 }
                else
                {
                    $formError [] = 'NO Member Avalid ';
                }
            }
            // for signup 
            else
            {
                
                
                //for all erreo that inter to form
                $formError = array();
                
                $username  = $_POST['username'];
                $password  = $_POST['password']; 
                $password2 = $_POST['password-agian']; 
                $email     = $_POST['email']; 
                
                
                if(isset ($username))
                {
                    //filter help to filtering the name from the scripts 
                    $filterUser = filter_var($username , FILTER_SANITIZE_STRING);
                     if(strlen($filterUser) < 4 )
                     {
                         $formError [] = 'Username Must Be Latger than 4 Characters';
                     }
                    
                    
                }
                //check if the passwords are equle
                if(isset($password) && isset($password2))
                {
                    if(empty($password))
                    {
                        $formError [] = 'Sorry The Password Can Not Be Empty';
                    }
                    if(strlen($password) <= 5 )
                    {
                        $formError [] = 'Sorry The Password Is Very Short';
                    }
                    $pass = sha1($password) ;
                    $pass2= sha1($password2) ;
                   
                    if( $pass !== $pass2)
                    {
                        $formError [] = 'Sorry the Password Is Not Match';
                    }
                }
                if(isset($email))
                {
                    $filterEmail = filter_var($email , FILTER_SANITIZE_EMAIL);
                    
                    if(filter_var($filterEmail , FILTER_VALIDATE_EMAIL) != true )
                    {
                        $formError [] = 'This Email Is Not Valid' ;
                        
                    }
                }
                 if(empty($formError))
                 {
                     $check = checkItem("UserName","users", $username);
                      if($check == 1)
                      {
                          $formError [] = 'Sorry This User Is Exsit ';
                      }
                      else
                      {
                        //Insert the database with this info
                            $stmt = $con->prepare("INSERT INTO users ( Date , UserName , Password , Email , RegState) VALUES (now() , :Fuser , :Fpass , :Fmail , 0)");

                            $stmt->execute(array(
                                'Fuser' => $username ,
                                'Fpass' => $pass ,
                                'Fmail' => $email
                            ));

                      //echo success massage 

                      $succesMsg = 'Congrade You Are Now Registerd User';
                     }
                }
            }
         }
?>
    <div class="container loginPlat">
        <h1 class="text-center ">
            <span  data-class="login">LOGIN</span> | 
            <span class="selected" data-class="signup"> SINGUP </span>
        </h1>
        <div class="row ">
            <div class=" log-col col-lg-6 col-sm-12">
                <form   class="login"  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <input 

                           class="form-control" 
                           type="text" 
                           name="username" 
                           placeholder="Enter Your name" autocomplete="off"
                           requierd 

                           />
                    <input class="form-control" type="password" name="password" placeholder="Enter Your Password" autocomplete="new-password"/>
                    <input class="btn btn-primary btn-block" name = "login" type="submit" value="Login"/>
                </form >
            </div>
            <div class="col-lg-6 col-sm-12">
                 <form class="signup"  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <input 
                           pattern = ".{4 , }"
                           title = "Username Must Be at less four charechters"
                           class="form-control" 
                           type="text" 
                           name="username" 
                           placeholder="Enter Your Name" autocomplete="off"
                           required 
                           />
                    <input 
                           class="form-control" 
                           type="password" 
                           name="password" 
                           placeholder="Enter Your Password"
                           autocomplete="new-password"
                           required 
                           />
                    <input 
                           class="form-control" 
                           type="password" 
                           name="password-agian" 
                           placeholder="Repeat the passwoed"
                           autocomplete="new-password"
                           required 
                           />
                    <input 
                           class="form-control" 
                           type="email" 
                           name="email" 
                           placeholder="Enter Your Email"
                           required 
                           />
                    <input class="btn btn-success btn-block" name ="signup" type="submit" value="SignUp"/>
                </form>
            </div>
        </div>
    </div>
        <div class = "the-errors  text-center">
                             <?php
            if(!empty($formError))
            {
                foreach($formError as $error)
                {
                    echo "<div class='msg error'>" . $error.  '</div>';
                }
                
            }
              if(isset ($succesMsg))
              {
                  echo "<div class='msg success'>" . $succesMsg .  '</div>';
              }
            ?>
        </div>
    

<?php
            include $tpl.'footer.php'
?>