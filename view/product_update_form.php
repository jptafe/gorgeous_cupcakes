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
	$title = "Update Product";
	
	//retrieve the header
	require('header.php');
	//retrieve the navigation
	require('nav.php');
?>

<section id="main">
	<h2>Update Product</h2>
	
	<?php
		//retrieve the productID from the URL
		$productID = $_GET['productID'];

		//call user_message() function
		$message = user_message();
		//call the get_products() function
		$result = get_product();
	?>

	<!-- create a table to store the product data and retrieve the value of each row from the database -->
	<!-- Note the use of HTML5 client-side form validation in the form fields -->
	<form action="../controller/product_update_process.php" method="post" enctype="multipart/form-data">
		<div>
			<label>Name* </label>
			<input id="productName" type="text" name="productName" value="<?php echo $result['productName'] ?>" required />
		</div>
		<div>
			<label>Description* </label>
			<textarea id="productDescription" name="productDescription" required /><?php echo $result['productDescription'] ?></textarea>
		</div>
		<div>
			<label>Price* </label>
			<input id="productPrice" type="text" name="productPrice" value="<?php echo $result['productPrice'] ?>" required />
		</div>
		<div>
			<?php
				//if the productPhoto field in the database is NULL or empty
				if((is_null($result['productPhoto'])) || (empty($result['productPhoto'])))
				{
					//display the default photo
					echo "<p><img src='images/default.jpg' width=200 height=200 alt='default photo' /></p>";
				}
				else
				{ 
					//else display the appropriate product photo
					echo "<p><img src='images/" . ($result['productPhoto']) . "'" . ' width=200 height=200 alt="product photo"'  . "/></p>"; 
				}
			?>
			<label>Photo</label> <input type="file" name="productPhoto" /><br />	
		</div>
		<div>
			<!-- the table has a hidden form field to pass the productID to the next page -->
			<input id="productID" name="productID" type="hidden" value="<?php echo $productID ?>" />
		</div>
		<div>
			<label>Category*</label>
			<!-- create a drop-down list populated by the categories stored in the database -->	
			<select name='categoryID'>
			<option value="<?php echo $result['categoryID']; ?>"><?php echo $result['categoryName']; ?></option>
				<?php
					//retrieve the selected categoryID
					$selected = $result['categoryID'];
					//call the get_category_dropdown() function
					$result = get_category_dropdown();
					//display the category data in each row using a foreach loop
					//do not display duplicates i.e. only display the selected category one time
					foreach($result as $row):
						if($selected != $row['categoryID']){
							echo "<option value=" . $row['categoryID'] . ">" . $row['categoryName'] . "</option>";
						}
					endforeach
				?>		
			</select><br />
		</div>
		<div>
			<input type="submit" value="Update Product" />
		</div>
	</form>
</section> <!-- end main -->

<?php
	//retrieve the sidebar
	require('sidebar.php');
	//retrieve the footer
	require('footer.php');
?>