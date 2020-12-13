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
	$title = "Products";
	
	//retrieve the header
	require('header.php');
	//retrieve the navigation
	require('nav.php');
?>

<section id="main">
	<h2>View All Products</h2>
	
	<?php
		//call user_message() function
		$message = user_message();
		//call the get_products() function
		$result = get_products();
	?>
		
	<!-- display all the product data in each row using a foreach loop -->	
	<div id="products">
		<?php foreach($result as $row):?>
			<div class="product">
				<div class="productInfo">
					<?php
						//if the productPhoto field in the database is NULL or empty
						if((is_null($row['productPhoto'])) || (empty($row['productPhoto'])))
						{
							//display the default photo
							echo "<p><img src='images/default.jpg' width=200 height=200 alt='default photo' /></p>"; 
						}
						else
						{ 
							//display the product photo
							echo "<p><img src='images/" . ($row['productPhoto']) . "'" . ' width=200 height=200 alt="product photo"'  . "/></p>";
						}
					?>
					<p class="productName"><?php echo $row['productName']; ?></p>
					<p><?php echo $row['productDescription']; ?></p>
				</div> <!-- productInfo -->
				<div class="productPrice">
					<p><?php echo "$" . (number_format($row['productPrice'], 2)); ?> each</p>
				</div> <!-- end productPrice -->
				<!-- 
				Note that the Update link uses the $_GET array to send the productID to the next page, as well as the use of the JavaScript prompt to ask the user if they really want to delete the product - it is considered best practice to confirm a deletion from a database which is permanent
				-->
				<div class="productUpdate">
					<p><a href = "product_update_form.php?productID=<?php echo $row['productID']; ?>">Update</a> <span class="pink"> | </span><a href = "../controller/product_delete_process.php?productID=<?php echo $row['productID']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a></p>
				</div> <!-- end productUpdate -->
			</div> <!-- end product -->
		<?php endforeach; ?>
	</div> <!-- end products -->
</section> <!-- end main -->

<?php
	//retrieve the sidebar
	require('sidebar.php');
	//retrieve the footer
	require('footer.php');
?>