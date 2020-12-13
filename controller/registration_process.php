<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_users.php');
?>

<?php
	//retrieve the registration details into the form
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password']; 
	
	//START SERVER-SIDE VALIDATION
	//check if the password is a minimum of 8 characters long
	if (strlen($password) < 8)
	{
		//if password is less than 8 characters intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Password must be 8 characters or more.'; 
		//redirect to the registration page to display the message
		header("location:../view/registration_form.php");
		exit();	
	}
	//check if all required fields have data
	elseif (empty($email) || empty($username) || empty($password)) 
	{ 
		//if required form fields are blank intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.';
		//redirect to the registration page to display the message
		header("location:../view/registration_form.php");
		exit();
	}
	//check if the email is valid
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		//if the email is not valid intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Please enter a valid email address.';
		//redirect to the registration page to display the message
		header("location:../view/registration_form.php");
		exit();
	}
	
	//call the count_username() function
	$count = count_username($username);
		
	if($count > 0)
	{ 
		//if there are any matching rows intialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Username taken. Please retry.'; 
		//redirect to the registration page to display the message
		header("location:../view/registration_form.php");
		exit();
	}
	//END SERVER-SIDE VALIDATION
	
	//generate a random salt value using the MD5 encryption method and the PHP uniqid() and rand() functions
	$salt = md5(uniqid(rand(), true));
	
	//encrypt the password (with the concatenated salt) using the SHA256 encryption method and the PHP hash() function
	$password = hash('sha256', $password.$salt); //generate the hashed password with the salt value

	//call the add_user() function
	$result = add_user($firstName, $lastName, $email, $username, $password, $salt);
	
	//create user messages
	if($result)
	{
		//if product is successfully added, create a success message to display on the products page
		$_SESSION['success'] = 'Thank you for creating an account. Please login.';
		//redirect to products.php
		header('location:../view/login_form.php');
	}
	else
	{
		//if product is not successfully added, create an error message to display on the add product page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to product_add_form.php
		header('location:../view/registration_form.php');
	}
?>