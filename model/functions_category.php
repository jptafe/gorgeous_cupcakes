<?php
	//create a function to retrieve all categories
	function get_categories()
	{
		global $conn;
		//query the database to select all data from the category table
		//count the number of rows in each category in the product table and save this data into a temporary column named 'catnum'
		$sql = 'SELECT category.*, COUNT(product.categoryID) AS catnum FROM category INNER JOIN product USING(categoryID) GROUP BY product.categoryID';
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}	
	
	//create a function to retrieve a single category
	function get_category()
	{
		global $conn;
		
		//retrieve the categoryID from the URL
		$categoryID = $_GET['categoryID'];
		
		$sql = 'SELECT * FROM category WHERE categoryID = :categoryID';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->bindValue(':categoryID', $categoryID);
		$statement->execute();
		//use the fetch() method to retrieve a single row
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	//create a function to retrieve data for the category dropdown menu
	function get_category_dropdown()
	{
		global $conn;
		
		$sql = 'SELECT * FROM category ORDER BY categoryID';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}
?>