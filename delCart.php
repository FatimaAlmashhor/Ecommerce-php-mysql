

<?php 
session_start();
include 'init.php' ;
$items = $_SESSION['cart'];
$cartitems = explode(",", $items);
if($_GET['remove'] == 0)
{
    $delitem = $_GET['remove'];
    $stmt = $con->prepare("DELETE  FROM order_details  WHERE item_id = :zitem ");
    $stmt->bindParam(
       ":zitem" , $cartitems[0] 
    );
	unset($cartitems[0]);
	$itemids = implode(",", $cartitems);
	$_SESSION['cart'] = $itemids;
    

    $stmt->execute();
    
}
if(isset($_GET['remove']) & !empty($_GET['remove'])){
	$delitem = $_GET['remove'];
    $stmt = $con->prepare("DELETE FROM order_details   WHERE item_id = :zitem  ");
    $stmt->bindParam(
       ":zitem" , $cartitems[$delitem]
    );
	unset($cartitems[$delitem]);
	$itemids = implode(",", $cartitems);
	$_SESSION['cart'] = $itemids;

    $stmt->execute();
}
header('location:cart.php');
?>
