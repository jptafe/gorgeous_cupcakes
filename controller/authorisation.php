<?php
	if(!isset($_SESSION['user']))
	{
		//if the user session is not set (i.e. the user is not logged in) redirect to the login page
		header('location:login_form.php');
	}
?>