<section id="sidebar">
	<h2>Categories</h2>
	<?php		
		//call the get_categories() function
		$result = get_categories();
		
		//display the category data in each row using a foreach loop
		foreach ($result as $row):
			echo "<p><a href = 'category.php?categoryID=" . $row['categoryID'] . "'>" . $row['categoryName'] . " (" . $row['catnum'] . ")</a></p>";
		endforeach;
	?>
</section>