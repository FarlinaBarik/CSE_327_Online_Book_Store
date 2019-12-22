<?php
$link = mysqli_connect("localhost", "root", "") or die($link);
	session_start();
	
	$username = mysqli_real_escape_string($link,$_POST['username']);
	$password = mysqli_real_escape_string($link,$_POST['password']);
	
	//mysqli_connect("localhost", "root","") or die(mysql_error()); //Connect to server
	mysqli_select_db($link,"Online_Bookstore") or die("Cannot connect to database"); //Connect to database
	$query = mysqli_query($link,"SELECT * from Customers WHERE User_name ='$username'");
$querya = mysqli_query($link,"SELECT * from Admin WHERE User_name ='$username'");  //Query the users table if there are matching rows equal to $username
	$exists = mysqli_num_rows($query); //Checks if username exists
	$table_users = "";
	$table_password = "";
$exists_admin = mysqli_num_rows($querya); //Checks if username exists
		
$table_users_admin = "";
	$table_password_admin = "";
	if($exists > 0 || $exists_admin > 0 ) //IF there are no returning rows or no existing username
	{
		while($row = mysqli_fetch_assoc($query)) //display all rows from query
		{
			$table_users = $row['User_name']; // the first username row is passed on to $table_users, and so on until the query is finished
			$table_password = $row['Password']; // the first password row is passed on to $table_users, and so on until the query is finished
// the first password row is passed on to $table_users, and so on until the query is finished
		}
		if(($username == $table_users) && ($password == $table_password) ) // checks if there are any matching fields
		{                 $_SESSION['user'] = $username; 
				  header("location: Home.php");
		}
		
		while($row = mysqli_fetch_assoc($querya)) //display all rows from query
		{
			$table_users_admin = $row['User_name']; // the first username row is passed on to $table_users, and so on until the query is finished
			$table_password_admin = $row['Password']; // the first password row is passed on to $table_users, and so on until the query is finished
// the first password row is passed on to $table_users, and so on until the query is finished
		}



	      if(($username == $table_users_admin) && ($password == $table_password_admin) ) // checks if there are any matching fields
		{                 $_SESSION['user'] = $username; 
				  header("location: Admin.php");
		}



		else
		{
			Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
			Print '<script>window.location.assign("Login.php");</script>'; // redirects to login.php
		}	
//Print '<script>window.location.assign("Login.php");</script>'; // redirects to login.php
	}




	else 
	{
		Print '<script>alert("Incorrect Username!");</script>'; //Prompts the user
		Print '<script>window.location.assign("Login.php");</script>'; // redirects to login.php
	}
?>
