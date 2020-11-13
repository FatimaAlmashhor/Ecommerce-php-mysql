<?php include 'init.php' ;

    session_start();
    


        if(isset($_GET['action']) && !empty($_GET['action']))
        {
            if($_GET['action'] == 'insert')
            {
                $file = $_POST['image'] ;
                $mime = 'image/gif' ;
                insertBlob($file, $mime);
            }
        }else
        {
            echo 'error';
        }
        
?>