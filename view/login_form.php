<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_messages.php');
	
	//provide the value of the $title variable for this page
	$title = "Login";
	
	//retrieve the header
	require('header.php');
?>

<section id="main">
	<h2 class="marginTop20">Welcome</h2>
	<p class="marginBottom20">We're happy to see you return! Please login to continue.</p>
	
	<?php
		//call user_message() function
		$message = user_message();
	?>
	
	<form action="../controller/authentication.php" method="post">
		<input type="text" name="username" id="username" placeholder="Enter your username*" required /><br />
		<input type="password" id="password" name="password" placeholder="Enter your password*" required /><br />
		<p><input type="submit" name="login" value="Login" /></p>
		<p>Don't have an account yet? Please <a href="registration_form.php">sign up</a>.</p>
	</form>
</section> <!-- end main -->

<?php
	//retrieve the footer
	require('footer.php');
?>