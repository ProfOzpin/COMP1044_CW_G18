

<!DOCTYPE html>
<html>
<head>
	<?php

		$run = true;

		$fields = array('book_title', 'author', 'isbn', 'book_pub', 'status', 'category_id');
        $fieldnames = array("Book Title", "Author", "ISBN", "Publishing Company", "Status", "Category");
        $categories = array('Periodical', 'English', "Math", "Science", "Encyclopedia", "Filipiniana", "Newspaper", "General", "References");
        $i = 0;

		foreach($fields as $field){
			if($_GET[$field] == "" or $_GET[$field] == " " or $_GET[$field] == null){
				$run = false;
				echo "Error: " . $fieldnames[$i] . " field is empty. Please try again \n";
			}
            $i++;
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

            $val = array();
            foreach($fields as $field){
                array_push($val, $_GET[$field]);
            }
  
			$send = "SELECT book_id, book_title, category_id, author, book_copies, book_pub, publisher_name, isbn, copyright_year, date_added, status FROM book WHERE book_title = '$val[0]' AND author = '$val[1]' AND isbn ='$val[2]' AND book_pub='$val[3]' AND status='$val[4]' AND category_id = $val[5]";
            $result = $conn->query($send);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "Book ID: " . $row["book_id"]. " - Title: " . $row["book_title"]. " - Author: " . $row["author"] . " - Category: " . $categories[((int) $val[5]) - 1] . " - Publishing Company: " . $row['book_pub'] . " - Publisher's name: " . $row['publisher_name'] . " - ISBN: " . $row['isbn'] . " - Copyright Year: " . $row['copyright_year'] . " - Date Added: " . $row['date_added'];
                }
            } else {
                echo "0 results";
            }
                

			$conn->close();
		}
	?>
</head>
</html>
