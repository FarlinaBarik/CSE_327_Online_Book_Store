<?php 
session_start();
//require_once('connect.php'); 
include('header.php'); 
include('nav.php'); 

$link = mysqli_connect("localhost", "root", "") or die($link);
mysqli_select_db($link,"Online_Bookstore") or die("Cannot connect to database"); 
$items = $_SESSION['cart'];
$cartitems = explode(",", $items);
?>
<?php
$total = 0;
$i=1;
 foreach ($cartitems as $key=>$id) {
	$sql = "Select * from Books where Book_id = '$id'";
	$res=mysqli_query($link, $sql);
	$r = mysqli_fetch_assoc($res);
?>	  	
	<tr>
		<td><?php echo $i; ?></td>
		<td><a href="delcart.php?remove=<?php echo $key; ?>">Remove</a> <?php echo $r['Title']; ?></td>
		<td>$<?php echo $r['Price']; ?></td>
	</tr>
<?php 
	$total = $total + $r['Price'];
	$i++; 
	} 
?>

<tr>
	<td><strong>Total Price</strong></td>
	<td><strong>$<?php echo $total; ?></strong></td>
	<td><a href="#" class="btn btn-info">Checkout</a></td>
</tr>

