
<!DOCTYPE html>
<html>
     <head>
         <meta charset="UTF-8"/>
		  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <title><?php getTitle() ;?></title>
         <link rel="stylesheet" href="<?php echo $css;?>font-awesome.min.css"/>
         <link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css"/>
         <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <!-- <link rel="stylesheet" href="<?php echo $css;?>style.css"/>-->
		 <link rel="stylesheet" href="<?php echo $css;?>frontend.css?ts=<?=time()?>"/>
         <link rel="stylesheet" href="<?php echo $css;?>responsive.css?ts=<?=time()?>"/>
         
    </head>
    <body>
           
<!-----------loading---------->
<!--<div class="se-pre-con"><img src="../../images/loader2.gif" width="100px"></div>-->
<!--================Header Menu Area =================-->

<div class="upper-bar up_nav">
    <div class="container">
        <?php 
            if(isset($_SESSION['Username']))
            {
                echo '<a class="text-right" href="admin/dashboard.php">Dashoard</a> | ';
            }
               else
               {
                   
               }
            if(isset($_SESSION['User'])){
                echo $_SESSION['User'];
               // echo ' | '; 
                 if(checkUserStatuse($_SESSION['User'])== 1)
                 {
                     echo ' | Your Not activat yet ';
                 }
                else
                {
                    
                
                echo ' | <a href ="profile.php?do=show">My Profile</a>'; 
                
             
                echo ' | ' ;
                
                ?>
                   <div class ="shop-cart"> <a href ="cart.php" ><i class ="fa fa-shopping-cart "> </i> My Cart </a></div> 
                <?php
                }
                 echo ' | <a href="logout.php">Logout</a>';
            }
                 
            else
            {
        ?>
        <a href="login.php"> LOGIN|SINGIUP</a>
        <?php
            }
        ?>
        
    </div> 
</div>



<nav class="navbar  navbar-expand-lg bg-dark  header_area">
    <div class="navbar-header page-scroll">
          <a class="navbar-brand" href="home.php">TrueMax</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"><i class="fa fa-plus"></i></span>
          </button>
    </div>

  <div class="collapse navbar-collapse bg-dark " id="navbarSupportedContent">
    <ul class=" nav navbar-nav navber-right">
		  <?php
                foreach(getCats() as $cat)
                {
                    echo '<li class="nav-item items ">
                        <a class="nav-link"href="Gategories.php?pageid='.$cat['ID'].'&pagename='. str_replace(' ', '-', $cat['Name']) .' ">'. $cat['Name'].'
                        </a>
                    </li> ';
                }
            ?>
	  </ul>  
  </div>
	
</nav>


<!--================Header Menu Area =================-->
        
