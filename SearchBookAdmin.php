<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="library.css">
	<script>
    function Return()
    {
        location.href = "homepageadmin.html";
    }
	</script>
</head>

<body>
<br><br><br><br><br><br><br><br><br>
	<center>
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
						
						if(!in_array($field, $empty_fields) and $field != "member_type"){
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
						echo "<h2 style=\"color:green;\">Book ID: " . $row["book_id"]. " - Title: " . $row["book_title"]. " - Author: " . $row["author"] . " - Category: " . $categories[((int) $row["category_id"]) - 1] . " - Publishing Company: " . $row['book_pub'] . " - Publisher's name: " . $row['publisher_name'] . " - ISBN: " . $row['isbn'] . " - Copyright Year: " . $row['copyright_year'] . " - Date Added: " . $row['date_added'] . "<br></h2>";
					}
				} else {
					echo "<h2 style=\"color:green;\">0 results</h2>";
				}
					

				$conn->close();
			}
		?>
	<br> <br> <br>
    <button class="button-hover col-3" onclick="Return()"> Go Back </button>
    </center>
</body>

</html>
