<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_products.php');
	
	//retrieve the data that was entered into the form fields using the $_POST array
	$productID = $_POST['productID']; //the value in the hidden form field
	$productName = $_POST['productName'];
	$productDescription = $_POST['productDescription'];
	$productPrice = $_POST['productPrice'];
	$categoryID = $_POST['categoryID'];
	
	//START SERVER-SIDE VALIDATION
	//check if all required fields have data
	if (empty($productName) || empty($productDescription) || empty($productPrice)|| empty($categoryID)) 
	{ 
		//if required fields are empty initialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.'; 
		//redirect to the product_update_form page to display the message
		header("location:../view/product_update_form.php");
		exit();
	}
	//check if a valid price has been entered
	elseif(!is_numeric($productPrice))
	{
		//if invalid data is entered into the price field initialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Please enter a valid price.'; 
		//redirect to the product_update_form page to display the message
		header("location:../view/product_update_form.php");
		exit();
	}
	//check if an image has been uploaded
	if(!empty($_FILES['productPhoto']['name']))
	{
		$productPhoto = $_FILES['productPhoto']['name']; //the PHP file upload variable for a file
		$randomDigit = rand(0000,9999); //generate a random numerical digit <= 4 characters
		$newPhotoName = strtolower($randomDigit . "_" . $productPhoto); //attach the random digit to the front of uploaded images to prevent overriding files with the same name in the images folder and enhance security
		$target = "../view/images/" . $newPhotoName; //the target for uploaded images

		$allowedExts = array('jpg', 'jpeg', 'gif', 'png'); //create an array with the allowed file extensions
		$tmp = explode('.', $_FILES['productPhoto']['name']); //split the file name from the file extension
		$extension = end($tmp); //retrieve the extension of the photo e.g., png
		
		//check if the file is less than the maximum size of 500kb
		if($_FILES['productPhoto']['size'] > 512000)
		{
			//if file exceeds maximum size initialise a session called 'error' with an appropriate user message
			$_SESSION['error'] = 'Your file size exceeds maximum of 500kb.'; 
			//redirect to the product_update_form page to display the message
			header("location:../view/product_update_form.php");
			exit();
		}
		//check that only accepted image formats are being uploaded
		elseif(($_FILES['productPhoto']['type'] == 'image/jpg') || ($_FILES['productPhoto']['type'] == 'image/jpeg') || ($_FILES['productPhoto']['type'] == 'image/gif') || ($_FILES['productPhoto']['type'] == 'image/png') && in_array($extension, $allowedExts))
		{			
			move_uploaded_file($_FILES['productPhoto']['tmp_name'], $target); //move the image to images folder
		}
		else
		{
			//if a disallowed image format is uploaded initialise a session called 'error' with an appropriate user message
			$_SESSION['error'] = 'Only JPG, GIF and PNG files allowed.'; 
			//redirect to the product_update_form page to display the message
			header("location:../view/product_update_form.php");
			exit();
		}
	//END SERVER-SIDE VALIDATION
		
		//call the update_product_with_photo() function
		$result = update_product_with_photo($productID, $productName, $productDescription, $productPrice, $newPhotoName, $categoryID);
		
		//create user messages
		if($result)
		{
			//if product is successfully added, create a success message to display on the products page
			$_SESSION['success'] = 'Product successfully updated.';
			//redirect to products.php
			header('location:../view/products.php');
		}
		else
		{
			//if product is not successfully added, create an error message to display on the add product page
			$_SESSION['error'] = 'An error has occurred. Please try again.';
			//redirect to product_add_form.php
			header('location:../view/products.php');
		}
	}
	//else if no new image uploaded
	else
	{
		//call the update_product() function
		$result = update_product($productID, $productName, $productDescription, $productPrice, $categoryID);
				
		//create user messages
		if($result)
		{
			//if product is successfully added, create a success message to display on the products page
			$_SESSION['success'] = 'Product successfully updated.';
			//redirect to products.php
			header('location:../view/products.php');
		}
		else
		{
			//if product is not successfully added, create an error message to display on the add product page
			$_SESSION['error'] = 'An error has occurred. Please try again.';
			//redirect to product_add_form.php
			header('location:../view/products.php');
		}
	}
?>