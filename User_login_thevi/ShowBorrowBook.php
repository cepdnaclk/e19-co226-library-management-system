<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "LibraryManagementSystem";

$conn = mysqli_connect($host,$user,$password);
mysqli_select_db($conn,$db);
// Assuming you have established a connection to the database

// Fetch book details from the database
$query = "SELECT * FROM BORROWS";
$result = mysqli_query($conn, $query);

// Check if any rows are returned

$BookArray = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
$searchFound = false;
if (isset($_GET['searchButton'])) {
    $searchInput = $_GET['searchInput'];

 
    $searchQuery = "SELECT * FROM BORROWS WHERE ISBN = '$searchInput' OR Member_ID = '$searchInput'";
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
        <title>Borrow Book Details</title>
        <link rel = "stylesheet" href = "Showborrowbookstyle.css">
        

    </head>
    <body>
        <div class="borrow-page">
        <a href = "Login.php" class="home-button">Home</a>
            <h1>Borrow Book Details</u></h1>
            <div class="searchbook">
                <form method="GET" action="" >
                    <label for="searchInput">Search by:</label>
                    <select name="searchBy">
                        <option value="ISBN">ISBN</option>
                        <option value="Member_ID">Member ID</option>
                    </select>
                    <input type="text" id="searchInput" name="searchInput">
                    <button type="submit" name="searchButton">Search</button>
                </form>
            </div>
            <br>
            <table id="Borrows">
                <tr>
                    <th>Member ID</th>
                    <th>ISBN</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                </tr>
                <?php if ($searchFound): ?>
                    <!-- Display search result -->
                    <?php while ($borrows = mysqli_fetch_assoc($searchResult)): ?>
                        <tr>
                            <td><?php echo $borrows['Member_ID']; ?></td>
                            <td><?php echo $borrows['ISBN']; ?></td>
                            <td><?php echo $borrows['Borrow_Date']; ?></td>
                            <td><?php echo $borrows['Due_date']; ?></td>
                            <td><?php echo $borrows['Return_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <!-- Display all books -->
                    <?php foreach ($BookArray as $borrows): ?>
                        <tr>
                            <td><?php echo $borrows['Member_ID']; ?></td>
                            <td><?php echo $borrows['ISBN']; ?></td>
                            <td><?php echo $borrows['Borrow_Date']; ?></td>
                            <td><?php echo $borrows['Due_date']; ?></td>
                            <td><?php echo $borrows['Return_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </table>
        </div>
    </body>
</html> 
