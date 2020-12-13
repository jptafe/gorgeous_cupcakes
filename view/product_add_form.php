<?php
	//start session management
	session_start();
	//include authorisation management
	require('../controller/authorisation.php');
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_products.php');
	require('../model/functions_category.php');
	require('../model/functions_messages.php');
	
	//provide the value of the $title variable for this page
	$title = "Add Product";
	
	//retrieve the header
	require('header.php');
	//retrieve the navigation
	require('nav.php');
?>

<section id="main">
	<h2>Add Product</h2>
	
	<?php
		//call user_message() function
		$message = user_message();
	?>

	<!-- create a table to enter the new product data -->
	<!-- Note the use of HTML5 client-side form validation in the form fields -->
	<form action="../controller/product_add_process.php" method="post" enctype="multipart/form-data">
		<div>
			<label>Name*</label>
			<input id="productName" type="text" name="productName" required />
		</div>
		<div>
			<label>Description*</label>
			<textarea id="productDescription" name="productDescription" required /></textarea>
		</div>
		<div>
			<label>Price*</label>
			<input id="productPrice" type="text" name="productPrice" required />
		</div>
		<div>
			<label>Photo</label> <input type="file" name="productPhoto" /><br />	
		</div>
		<div>
			<label>Category*</label>
			<!-- create a drop-down list populated by the categories stored in the database -->	
			<select name='categoryID'>
			<option value="">Please select</option>
				<?php
					//call the get_category_dropdown() function
					$result = get_category_dropdown();
					//display the category data in each row using a foreach loop
					foreach($result as $row):
						echo "<option value=" . $row['categoryID'] . ">" . $row['categoryName'] . "</option>";
					endforeach
				?>		
			</select><br />
		</div>
		<div>
			<input type="submit" value="Add Product" />
		</div>
	</form>
</section> <!-- end main -->

<?php
	//retrieve the sidebar
	require('sidebar.php');
	//retrieve the footer
	require('footer.php');
?>