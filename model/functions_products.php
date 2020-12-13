<?php
	//create a function to retrieve all products
	function get_products()
	{
		global $conn;
		//query the database to select all data from the product table
		$sql = 'SELECT * FROM product ORDER BY productName LIMIT 0,6';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}
	
	//create a function to retrieve all products in a specific category
	function get_products_by_category()
	{
		global $conn;

		//retrieve the categoryID from the URL
		$categoryID = $_GET['categoryID'];
		
		//query the database to select all data from the product table
		$sql = 'SELECT * FROM product WHERE categoryID = :categoryID ORDER BY productName';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->bindValue(':categoryID', $categoryID);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}
	
	//create a function to retrieve a single product
	function get_product()
	{
		global $conn;
		
		//retrieve the productID from the URL
		$productID = $_GET['productID'];
		
		//query the database to select all data from the product table
		$sql = 'SELECT * FROM product INNER JOIN category USING(categoryID) WHERE productID = :productID ORDER BY productName';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->bindValue(':productID', $productID);
		$statement->execute();
		//use the fetch() method to retrieve a single row
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	//create a function to add a new product
	function add_product($productName, $productDescription, $productPrice, $categoryID)
	{
		global $conn;
		$sql = "INSERT INTO product (productName, productDescription, productPrice, categoryID) VALUES (:productName, :productDescription, :productPrice, :categoryID)";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':productName', $productName);
		$statement->bindValue(':productDescription', $productDescription);
		$statement->bindValue(':productPrice', $productPrice);
		$statement->bindValue(':categoryID', $categoryID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}
	
	//create a function to add a new product with a photo
	function add_product_with_photo($productName, $productDescription, $productPrice, $newPhotoName, $categoryID)
	{
		global $conn;
		$sql = "INSERT INTO product (productName, productDescription, productPrice, productPhoto, categoryID) VALUES (:productName, :productDescription, :productPrice, :productPhoto, :categoryID)";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':productName', $productName);
		$statement->bindValue(':productDescription', $productDescription);
		$statement->bindValue(':productPrice', $productPrice);
		$statement->bindValue(':productPhoto', $newPhotoName);
		$statement->bindValue(':categoryID', $categoryID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}
	
	
	//create a function to update an existing product
	function update_product($productID, $productName, $productDescription, $productPrice, $categoryID)
	{
		global $conn;
		$sql = "UPDATE product SET productName = :productName, productDescription = :productDescription, productPrice = :productPrice, categoryID = :categoryID WHERE productID = :productID";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':productName', $productName);
		$statement->bindValue(':productDescription', $productDescription);
		$statement->bindValue(':productPrice', $productPrice);
		$statement->bindValue(':categoryID', $categoryID);
		$statement->bindValue(':productID', $productID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}

	//create a function to update an existing product with a photo
	function update_product_with_photo($productID, $productName, $productDescription, $productPrice, $newPhotoName, $categoryID)
	{
		global $conn;
		$sql = "UPDATE product SET productName = :productName, productDescription = :productDescription, productPrice = :productPrice, productPhoto = :productPhoto, categoryID = :categoryID WHERE productID = :productID";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':productName', $productName);
		$statement->bindValue(':productDescription', $productDescription);
		$statement->bindValue(':productPrice', $productPrice);
		$statement->bindValue(':productPhoto', $newPhotoName);
		$statement->bindValue(':categoryID', $categoryID);
		$statement->bindValue(':productID', $productID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}

	
	//create a function to delete an existing product
	function delete_product($productID)
	{
		global $conn;
		$sql = "DELETE FROM product WHERE productID = :productID";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':productID', $productID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}
?>