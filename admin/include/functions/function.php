<?php


        //this is fuction for give the page indevitual title
        //by avrabal $getTitle
        //but if the page dose not have the $getTitle print defult


      function getTitle()  
	  {
		  global $pageTitle ; 
		  
		  if (isset($pageTitle))
		  {
			  echo $pageTitle ;
			  
		  }
		  else
		  {
			  echo 'Defult' ;
		  }
	  }

		/*
			this is Function for home redirect after $seconds
			
		*/


			function redirectHome($theMsg , $url = null ,$seconds = 3)
			{
				
				if($url === null)
				{
					$url = 'ins.php';
				}
				else 
				{
					if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' )
					   {
						   $url = $_SERVER['HTTP_REFERER'] ;
					   }
					else 
					{
						$url = 'ins.php';
					}
				}
				echo $theMsg ;
				
				echo "<div class='alert alert-info'>You Will Be Redirected to Home Page after $seconds Seconds.</div>";
				
				header("refresh:$seconds;url= $url ");
				
				exit();
			}

		/*
			this is function for check items in database
		*/
			
		  function checkItem($select , $from , $value)
		  {
			  
			  global $con ;
			  $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ? ");
			  
			  $statment->execute(array($value));
			  $count = $statment->rowCount();
			  
			  return $count;
		  }

		/*
			counter of members of otems v1.0
			$item = the item to count
			$table = the table to choose from
		*/
		function countItem($item , $table)
		{
			global $con ;
			
			$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table ");
			  
			  	$stmt2->execute();
			  	
			  	return $stmt2->fetchColumn();
 			
			
		}
		
		/*
			function to get the latest item from database
		*/
			function getLatest($select , $table ,$order, $number = 5 )
			{
				global $con ;
				
				$getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $number");
				
				$getStmt->execute();
				
				$row = $getStmt->fetchAll();
				return $row;
			}
//--------------loading files----------------------------------
     function insertBlob($filePath, $mime) {
        global $con ;
         $fil = 'images/' .$filePath ;
         $blob = fopen($fil, 'rb');
 
        $sql = "INSERT INTO images(mime,data) VALUES(:mime,:data)";
        $stmt = $con->prepare($sql);
 
        $stmt->bindParam(':mime', $mime);
        $stmt->bindParam(':data', $blob, PDO::PARAM_LOB);
 
        return $stmt->execute();
    }

 function updateBlob($id, $filePath, $mime) {
        
        global $con ;
         $fil = 'images/' .$filePath ;
         $blob = fopen($fil, 'rb');
        $sql = "UPDATE images
                SET mime = :mime,
                    data = :data
                WHERE id = :id;";
 
        $stmt = $con->prepare($sql);
 
        $stmt->bindParam(':mime', $mime);
        $stmt->bindParam(':data', $blob, PDO::PARAM_LOB);
        $stmt->bindParam(':id', $id);
 
        return $stmt->execute();
    }

    function selectBlob($id) {
        global $con ;
        $sql = "SELECT mime,
                        data
                   FROM images
                  WHERE id = :id;";
 
        $stmt = $con->prepare($sql);
        $stmt->execute(array(":id" => $id));
        $stmt->bindColumn(1, $mime);
        $stmt->bindColumn(2, $data, PDO::PARAM_LOB);
 
        $stmt->fetch(PDO::FETCH_BOUND);
 
        return array("mime" => $mime,
            "data" => $data);
    }
?>