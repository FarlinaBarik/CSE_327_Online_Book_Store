<html>
	<head>
		<title>Bookworm</title>
	</head>
	<body>
		<h2>Admin</h2>
		<a href="Logout.php">Click here to logout</a><br/><br/>
		<form action="Admin.php" method="post">
			Enter Title: <input type="text" name="title" required="required"/> <br/>
			Enter Category: <input type="text" name="category" required="required" /> <br/>
                        Enter Publication year: <input type="number" name="pub_year" required="required" /> <br/>
			Enter Price: <input type="number" name="price" required="required" /> <br/>
			Enter Quantity: <input type="number" name="quantity" required="required" /> <br/>
			Enter About: <input type="text" name="about" required="required" /> <br/>
			Enter Author name: <input type="text" name="auth_name" required="required" /> <br/>


			<input type="submit" value="Submit"/>
		</form>
	</body>
</html>

<?php
/**
 * This is the Register file.This file contains the the fields a user has to fill up to get registered to the website .
 *
 * 
 * 
 * 
 * @author     Farlina Barik Easha <farlinabarik.easha@northsouth.edu> .
 */



/**
 * Address to connect to the database.
 */
$link = mysqli_connect("localhost", "root", "") or die($link);



if($_SERVER["REQUEST_METHOD"] == "POST"){

/**
 * Takes info required to register from the user to store in database.
 * 
 * Then loop works till the suare root of the number.
 * @throws Exception If element is not the correct type.
 */
	$title = mysqli_real_escape_string($link,$_POST['title']);
	$category = mysqli_real_escape_string($link,$_POST['category']);
	$publication_year = mysqli_real_escape_string($link,$_POST['pub_year']);
	$price = mysqli_real_escape_string($link,$_POST['price']);
 	$quantity = mysqli_real_escape_string($link,$_POST['quantity']);
	$about = mysqli_real_escape_string($link,$_POST['about']);
	$author_name = mysqli_real_escape_string($link,$_POST['auth_name']);
        $bool = true;


/**
 * Address to connect to the database table.
 */
mysqli_select_db($link,"Online_Bookstore") or die("Cannot connect to database"); 


/**
 * Address to connect to the database.
 * @param bool    $bool  this is the variable to used for checking the existing username.
 * Two eople can to hae sae username.
 *If the username is taken then it shows the massage the username is not available.
 *If the username is not used before the shows the massage "successfully registerd".
 */
$query = mysqli_query($link,"Select * from Books"); 
while($row = mysqli_fetch_array($query))
 {
   $table_users = $row['Title']; 
   /**
    * checks if there are any matching fields.
    */

   if($title == $table_users){  
	$bool = false; 
	Print '<script>alert("Book already exists");</script>'; 
	Print '<script>window.location.assign("Home.php");</script>'; 
        
       }
  }

if($bool){
  mysqli_query($link,"INSERT INTO Books (Title,Category,Publication_year,Price,Quantity,About,Author_name) VALUES ('$title','$category','$publication_year','$price','$quantity','$about','$author_name')"); 
  
  Print '<script>alert("Successfully Inserted!");</script>'; 
  Print '<script>window.location.assign("Admin.php");</script>'; 
  }
 
}
?>
