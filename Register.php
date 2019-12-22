<html>
	<head>
		<title>Bookworm</title>
	</head>
	<body>
		<h2>Registration Page</h2>
		<a href="Index.php">Click here to go back</a><br/><br/>
		<form action="Register.php" method="post">
			Enter Username: <input type="text" name="username" required="required"/> <br/>
			Enter Password: <input type="password" name="password" required="required" /> <br/>
                        Enter email: <input type="text" name="email" required="required" /> <br/>
			Enter Address: <input type="text" name="address" required="required" /> <br/>
			Enter First name: <input type="text" name="fname" required="required" /> <br/>
			Enter Last name: <input type="text" name="lname" required="required" /> <br/>
			Enter Phone number: <input type="text" name="phn" required="required" /> <br/>


			<input type="submit" value="Register"/>
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
	$username = mysqli_real_escape_string($link,$_POST['username']);
	$password = mysqli_real_escape_string($link,$_POST['password']);
	$email = mysqli_real_escape_string($link,$_POST['email']);
	$address = mysqli_real_escape_string($link,$_POST['address']);
 	$fname = mysqli_real_escape_string($link,$_POST['fname']);
	$lname = mysqli_real_escape_string($link,$_POST['lname']);
	$phn = mysqli_real_escape_string($link,$_POST['phn']);
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
$query = mysqli_query($link,"Select * from Customers" ); 
while($row = mysqli_fetch_array($query))
 {
   $table_users = $row['User_name']; 
   /**
    * checks if there are any matching fields.
    */

   if($username == $table_users){  
	$bool = false; 
	Print '<script>alert("Username has been taken!");</script>'; 
	Print '<script>window.location.assign("Register.php");</script>'; 
        
       }
  }

if($bool){
  mysqli_query($link,"INSERT INTO Customers (User_name,Password,First_name,Last_name,Email,Address,Phone_number) VALUES ('$username','$password','$fname','$lname','$email','$address','$phn')"); 
  
  Print '<script>alert("Successfully Registered!");</script>'; 
  Print '<script>window.location.assign("Register.php");</script>'; 
  }
 
}
?>
