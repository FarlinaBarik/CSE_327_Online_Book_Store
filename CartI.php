<?php
session_start();
//session_destroy();
$product_ids = array();
//if add cart button submitted
if(filter_input(INPUT_POST,'add_to_cart'))
{
    if(isset($_SESSION['shopping_cart']))
    {
        $count = count($_SESSION['shopping_cart']);//how many product in shopping cart
        $product_ids = array_column($_SESSION['shopping_cart'],'id');

//pre_r($product_ids);
        if(!in_array(filter_input(INPUT_GET,'id'),$product_ids))
        {
            $_SESSION['shopping_cart'][$count]= array
                                               (
                                                   'id' =>filter_input(INPUT_GET,'id'),
                                                   'name' => filter_input(INPUT_POST,'name'),
                                                   'price' => filter_input(INPUT_POST,'price'),
                                                   'quantity' => filter_input(INPUT_POST,'quantity')
                                               );

        }
        else
        {
            for($i =0; $i<count($product_ids); $i++)
            {
                if($product_ids[$i] == filter_input(INPUT_GET,'id'))
                {

                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST,'quantity');//add item quantity

                }
            }
        }
    }
    else //if shopping cart doesnt exist
    {
        $_SESSION['shopping_cart'][0]=array

                                      (
                                          'id' =>filter_input(INPUT_GET,'id'),
                                          'name' => filter_input(INPUT_POST,'name'),
                                          'price' => filter_input(INPUT_POST,'price'),
                                          'quantity' => filter_input(INPUT_POST,'quantity')
                                      );
    }
}

pre_r($_SESSION);

function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>
<!DOCTYE html>
<html>
<head>
<title>Cart</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
                            <link rel="stylesheet" href="cart.css" />
                                      </head>
                                      <body>
                                      <div class = "container">
                                                  <?php
                                                  $link = mysqli_connect("localhost", "root", "") or die($link);
mysqli_select_db($link,"Online_Bookstore") or die("Cannot connect to database");
$query= 'Select * from Books ORDER by Book_id ASC';
$result = mysqli_query($link,$query);

if($result)
{
    if(mysqli_num_rows($result)>0)
    {


        while($product= mysqli_fetch_assoc($result))
        {
            //print_r($product);
            ?>
            <div class="col-sm-4 col-md-3">
                           <form method ="post" action ="CartI.php?action=add&id=<?php echo $product["Book_id"]; ?>">
                                                        <div class = "products">
                                                                    <img src="<?php echo $product['image']; ?>" class "img-responsive" />
                                                                                <h4 class = "text-info" ><?php echo $product["Title"];
            ?></h4>
            <h4>$ <?php echo $product["Price"];
            ?> </h4>
            <input type = "text" name = "quantity" class ="form-control" value = "1" />
                                            <input type ="hidden" name="name" value = <?php echo $product["Title"] ;
            ?>" />
            <input type ="hidden" name="price" value = <?php echo $product["Price"] ;
            ?>" />
            <input type ="submit" name="add_to_cart" style="margin-top:5px class="btn btn-ino" value  = "Add to cart" />
                                       </div>
                                       </form>
                                       </div>

                                       <?php

        }
    }

}
?>
<div style ="clear:both"></div>
<br/>
<div class="table-responsive">
<table class = "table">
<tr><th colspan="5"><h3>odrder details</h3>
<tr>
<th width ="10%"> product name</th>
<th width ="10%"> quantity</th>
<th width ="20%"> price</th>
<th width ="15%"> total</th>
<th width ="5%"> Action</th>
</tr>
<?php
if(!empty($_SESSION['shopping_cart'])):
$total=0;
foreach($_SESSION['shopping_cart'] as $key =>$product):

?>
<tr>
<td><?php echo $product['name'];?></td>

<td><?php echo $product['quantity'];?></td>

<td>$ <?php echo $product['price'];?></td>
<td>$ <?php echo number_format ($product['quantity']* $product['price'],2);?></td>
<td>
<a href ="CartI.php?action=delete&id=<?php echo $product['id'];?>">

<div class="btn-danger">remove</div>
</a>
</td>
</tr>
<?php
$total = $total +($product['quantity']*$product['price']);
endforeach;
?>
<tr>
<td colspan ="3" align ="right">Total</td>
<td align ="right>$ <?php echo number_format($total,2); ?> </td>
<td></td>
</tr>
<tr>
<td colspan ="5" >
<?php
if(isset($_SESSION['shopping_cart'])):
if(count($_SESSION['shopping_cart'])>0):
?>
<a href ="#"class="button">checkout</a>
<?php endif;endif; ?>
</td>
</tr>

<?php
endif;
?>
</table>
</div>
</div>
</body>
</html>

