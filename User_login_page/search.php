<?php
// Replace the database connection details with your own
$host = "localhost";
$user = "root";
$password = "";
$db = "librarymanagementsystem";

// Establishing a connection to the database
$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/*// Retrieving data from the "books" table
$sql = "SELECT * FROM book";
$result = mysqli_query($conn, $sql);*/
// Retrieving data from the "book" table and joining with the "book_count" table
$Book = $_POST['search'];
$sql = "SELECT book.ISBN, book.Book_ID, book.Title, book_count.Now_available_qty
        FROM book
        JOIN book_count ON book.Title = book_count.Title
        WHERE book.Title = '$Book'";
$result = mysqli_query($conn, $sql);

// Creating an array to store the retrieved data
$books_data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $books_data[] = $row;
    }
}

// Closing the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Table</title>
    <link rel="stylesheet" href="style_book.css">
</head>
<body>
    <div class="container">
        <h1>Book Table</h1>
        <table>
            <tr>
                <th>ISBN</th>
                <th>Book ID</th>
                <th>Title</th>
                <th>Now Available Quantity</th>
                <!--th>Publisher ID</th>
                <th>Received Date</th-->
            </tr>
            <?php
            // Loop through the retrieved data and display it in the table rows
            foreach ($books_data as $book) {
                echo "<tr>";
                echo "<td>" . $book['ISBN'] . "</td>";
                echo "<td>" . $book['Book_ID'] . "</td>";
                echo "<td>" . $book['Title'] . "</td>";
                echo "<td>" . $book['Now_available_qty'] . "</td>";
                /*echo "<td>" . $book['Publisher_ID'] . "</td>";
                echo "<td>" . $book['Received_date'] . "</td>";*/
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <a href = "Login.php" class=" button">Back HOME</a>
        <a href = "Logout.php" class = "button">Log Out</a>
    </div>
    
</body>
</html>
