<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_users.php');
	
	//retrieve the username and password entered into the form
	$username = $_POST['username'];
	$password = $_POST['password']; 
	
	//call the retrieve_salt() function
	$result = retrieve_salt($username);
	
	//retrieve the random salt from the database
	$salt = $result['salt'];
	//generate the hashed password with the salt value
    $password = hash('sha256', $password.$salt); 
	
	//call the login() function
	$count = login($username, $password);
	
	//if there is one matching record
	if($count == 1)
	{ 
		//start the user session to allow authorised access to secured web pages
		$_SESSION['user'] = $username;
		//if login is successful, create a success message to display on the products page
		$_SESSION['success'] = 'Hello ' . $username . '. Have a great day!';
		//redirect to products.php
		header('location:../view/products.php');
	}
	else
	{
		//if login not successful, create an error message to display on the login page
		$_SESSION['error'] = 'Incorrect username or password. Please try again.';
		//redirect to login.php
		header('location:../view/login_form.php');
	}	
?>