<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "LibraryManagementSystem";

$conn = mysqli_connect($host,$user,$password);
mysqli_select_db($conn,$db);
// Assuming you have established a connection to the database

// Fetch book details from the database
$query = "SELECT * FROM BOOK";
$result = mysqli_query($conn, $query);

// Check if any rows are returned

$BookArray = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Book details</title>
        <link rel = "stylesheet" href = "book.css">
        

    </head>
    <body>
        <div class="book-page">
        <a href = "Login.php" class="home-button">Home</a>
            <h1>Book Details</u></h1>
            <table id="Book">
                <tr>
                    <th>ISBN</th>
                    <th>Book_ID</th>
                    <th>Publisher_ID</th>
                    <th>Title</th>
                    
                    
                </tr>
                <?php foreach($BookArray as $book): ?>
                <tr>
                    <td><?php echo $book['ISBN']; ?></td>
                    <td><?php echo $book['Book_ID']; ?></td>
                    <td><?php echo $book['Publisher_ID']; ?> </td>
                    <td><?php echo $book['Title'] ; ?> </td>
                    
                    
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </body>
</html> 