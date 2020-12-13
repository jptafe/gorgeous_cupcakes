<?php
	//create a function to retrieve the total number of matching usernames
	function count_username($username)
	{
		global $conn;
		$sql = 'SELECT * FROM user WHERE username = :username';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$count = $statement->rowCount();	
		return $count;
	}

	//create a function to add a new user
	function add_user($firstName, $lastName, $email, $username, $password, $salt)
	{
		global $conn;
		$sql = "INSERT INTO user (firstName, lastName, email, username, password, salt) VALUES (:firstName, :lastName, :email, :username, :password, :salt)";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':firstName', $firstName);
		$statement->bindValue(':lastName', $lastName);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':password', $password);
		$statement->bindValue(':salt', $salt);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;			
	}

	//create a function to retrieve salt
	function retrieve_salt($username)
	{
		global $conn;
		$sql = 'SELECT * FROM user WHERE username = :username';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}

	//create a function to login
	function login($username, $password)
	{
		global $conn;
		$sql = 'SELECT * FROM user WHERE username = :username AND password = :password';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':password', $password);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$count = $statement->rowCount();	
		return $count;
	}
?>