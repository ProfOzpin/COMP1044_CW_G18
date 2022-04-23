<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="library.css">
</head>

<body>
	<br>
	<center><h2 style="color:gold;">Search Results</h2></center>
<br><br>
	<center>
	<table class="table">
		<thead>
			<tr>
				<th>Book ID</th>
				<th>Title</th>
				<th>Category ID</th>
				<th>Author</th>
				<th>Copies</th>
				<th>Book Pub</th>
				<th>Publisher Name</th>
				<th>ISBN</th>
				<th>Copyright Year</th>
				<th>Date Added</th>
				<th>Status</th>
			</tr>
		</thead>
	
		<?php

			$run = true;

			$fields = array('book_title', 'author', 'isbn', 'book_pub', 'status', 'category_id');
			$fieldnames = array("Book Title", "Author", "ISBN", "Publishing Company", "Status", "Category");
			$categories = array('Periodical', 'English', "Math", "Science", "Encyclopedia", "Filipiniana", "Newspaper", "General", "References");
			$i = 0;
			$empty_fields = array();

			foreach($fields as $field){
				if($_GET[$field] == "" or $_GET[$field] == " " or $_GET[$field] == null){
					$i++;
					array_push($empty_fields, $field);
				}     
			}

			if($run == true){
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "sqldatabase";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$send = "SELECT book_id, book_title, category_id, author, book_copies, book_pub, publisher_name, isbn, copyright_year, date_added, status FROM book";
				$current_index = 0;
				if($i != 6){
					$send.= " WHERE ";
					foreach($fields as $field){
						
						if(!in_array($field, $empty_fields)){
							if($current_index > 0){
								$send .= " AND ";
							}
							$send .= $field . "= '" . $_GET[$field] . "'";
							$current_index++;
						}	
						
					}		
				}
				
	  
				$result = $conn->query($send);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
		?>
					<tr>
						<td> <?php echo $row["book_id"];?> </td>
						<td> <?php echo $row["book_title"];?> </td>
						<td> <?php echo $row["category_id"];?> </td>
						<td> <?php echo $row["author"];?> </td>
						<td> <?php echo $row["book_copies"];?> </td>
						<td> <?php echo $row["book_pub"];?> </td>
						<td> <?php echo $row["publisher_name"];?> </td>
						<td> <?php echo $row["isbn"];?> </td>
						<td> <?php echo $row["copyright_year"];?> </td>
						<td> <?php echo $row["date_added"];?> </td>
						<td> <?php echo $row["status"];?> </td>
					</tr>
		<?php				
					}
				} else {
					echo "<h2 style=\"color:red;\">0 results</h2>";
				}
					

				$conn->close();
			}
		?>
	</table>
	<br> <br>
	<button class="button-hover col-3" onclick="location.href='searchbookUser.html'"> Back </button>
	<br> <br>
	</center>
</body>

</html>