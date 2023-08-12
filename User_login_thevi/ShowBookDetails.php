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
$searchFound = false;
if (isset($_GET['searchButton'])) {
    $searchInput = $_GET['searchInput'];

    // Search for the member by Member ID or National ID
    $searchQuery = "SELECT * FROM BOOK WHERE ISBN = '$searchInput' OR Title = '$searchInput'";
    $searchResult = mysqli_query($conn, $searchQuery);

    
    
    if (mysqli_num_rows($searchResult) > 0) {
        $searchFound = true;
    }
}
// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Book details</title>
        <link rel = "stylesheet" href = "Showbookstyle.css">
        

    </head>
    <body>
        <div class="book-page">
        <a href = "Login.php" class="home-button">Home</a>
            <h1>Book Details</u></h1>
            <div class="searchbook">
                <form method="GET" action="" >
                    <label for="searchInput">Search by:</label>
                    <select name="searchBy">
                        <option value="ISBN">ISBN</option>
                        <option value="Title">Title</option>
                    </select>
                    <input type="text" id="searchInput" name="searchInput">
                    <button type="submit" name="searchButton">Search</button>
                </form>
            </div>
            <br>
            <table id="Book">
                <tr>
                    <th>ISBN</th>
                    <th>Book ID</th>
                    <th>Publisher ID</th>
                    <th>Title</th>
                    <th>Received Date</th>
                </tr>
                <?php if ($searchFound): ?>
                    <!-- Display search result -->
                    <?php while ($book = mysqli_fetch_assoc($searchResult)): ?>
                        <tr>
                            <td><?php echo $book['ISBN']; ?></td>
                            <td><?php echo $book['Book_ID']; ?></td>
                            <td><?php echo $book['Publisher_ID']; ?></td>
                            <td><?php echo $book['Title']; ?></td>
                            <td><?php echo $book['Received_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <!-- Display all books -->
                    <?php foreach ($BookArray as $Book): ?>
                        <tr>
                            <td><?php echo $Book['ISBN']; ?></td>
                            <td><?php echo $Book['Book_ID']; ?></td>
                            <td><?php echo $Book['Publisher_ID']; ?></td>
                            <td><?php echo $Book['Title']; ?></td>
                            <td><?php echo $Book['Received_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </table>
        </div>
    </body>
</html> 