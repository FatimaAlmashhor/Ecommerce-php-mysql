     <?php 
			$pageTitle = 'LogIn';
			$noNavbar = '' ;
          session_start();
          if(isset($_SESSION['Username']))
          {
              header('location:dashboard.php');
          }
          include 'init.php';


         // Check if User Coming From HTTP Post Requst

         if($_SERVER['REQUEST_METHOD'] == 'POST'){
             
             $username = $_POST['user'] ;
             $password = $_POST['pass'] ;
             $hashedPass = sha1($password);
             
             //Check if the user exist in databases
             
             $stmt = $con->prepare("SELECT  UserID , UserName , Password FROM Users WHERE UserName = ? AND Password = ? AND GroupID = 1 LIMIT 1");
             
             $stmt->execute(array($username , $hashedPass )); 
			 $row =  $stmt->fetch();      //جلب للبياات
             $count = $stmt->rowCount();
             
             if($count > 0){
		
                 $_SESSION['Username'] = $username ;  //Register Session Name
				 $_SESSION['ID'] = $row['UserID'];   //Register Session ID
                 header('location:dashboard.php');
                 exit();
             }

         }
?>
	

       <div class="back">
	     <div class="box">
		     <h2><span>LOG IN</span></h2>
		     <div class="inter container">
			     <form  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" autocomplete="on">
				     <label>Name:<input type="text" name="user" placeholder="Fatima" required /></label><br/>
					 <label>Password:<input type="password" name="pass"  placeholder="" required /></label><br/>
					 <input type="submit" value="save" class="submit btn"/>
					 <input type="reset" value="reset" class="reset"/>
				 </form>
			 </div>
		 </div>
	 </div>


	 
	 <?php include $tpl . 'footer.php';?>
