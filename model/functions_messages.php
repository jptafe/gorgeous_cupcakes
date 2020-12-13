<?php
	//create a function for user messages
	function user_message()
	{
		//display a user message if there is an error
		if(isset($_SESSION['error']))
		{ 
			echo '<div class="error">';
			echo '<p>' . $_SESSION['error'] . '</p>'; 
			echo '</div>';
			//unset the session named 'error' else it will show each time you visit the page
			unset($_SESSION['error']);
		}
		//display a user message if action is successful
		elseif(isset($_SESSION['success'])) 
		{ 
			echo '<div class="success">';
			echo '<p>' . $_SESSION['success'] . '</p>'; 
			echo '</div>';
			//unset the session named 'success' else it will show each time you visit the page
			unset($_SESSION['success']);
		}
	}
?>
