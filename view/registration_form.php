<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//provide the value of the $title variable for this page
	$title = "Registration";
	//retrieve the header 
	require('header.php');
?>

<section id="main">
	<h2 class="marginTop20">Registration</h2>
	<p>Complete the details below to sign up for a new account.</p>
	<p>Passwords must have a minimum of 8 characters.</p>
	
	<?php
		//user messages
		if(isset($_SESSION['error'])) //if session error is set
		{ 
			echo '<div class="error">';
			echo '<p>' . $_SESSION['error'] . '</p>'; //display error message
			echo '</div>';
			unset($_SESSION['error']); //unset session error
		}
	?>
	
	<!-- Note the use of HTML5 client-side form validation in the form fields -->
	<form action="../controller/registration_process.php" method="post">
		<input type="text" name="firstName" id="firstName" placeholder="Enter your first name" /><br />
		<input type="text" name="lastName" id="lastName" placeholder="Enter your last name" /><br />
		<input type="email" name="email" id="email" placeholder="Enter your email*" required /><br />
		<input type="text" name="username" id="username" placeholder="Enter your username*" required /><br />
		<input type="password" id="password" name="password" placeholder="Enter your password*" required pattern=".{8,}" /><br />
		<p><input type="submit" name="register" value="Register" /></p>
		<p>Please <a href="login_form.php">login</a> if you already have an account.</p>
	</form>
</section>

<?php
	//retrieve the footer
	require('footer.php');
?>