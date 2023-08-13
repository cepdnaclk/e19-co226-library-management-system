<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "LibraryManagementSystem";

$conn = mysqli_connect($host,$user,$password);
mysqli_select_db($conn,$db);
// Assuming you have established a connection to the database

// Fetch member details from the database
$query = "SELECT * FROM MEMBER";
$result = mysqli_query($conn, $query);
$query1 = "SELECT * FROM PERSON";
$result1 = mysqli_query($conn, $query1);



// Check if any rows are returned

$MemberArray = mysqli_fetch_all($result,MYSQLI_ASSOC);
$PersonArray=mysqli_fetch_all($result1,MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_free_result($result1);

// Process search input
$searchFound = false;
if (isset($_GET['searchButton'])) {
    $searchInput = $_GET['searchInput'];

    // Search for the member by Member ID or National ID
    $searchQuery = "SELECT * FROM MEMBER WHERE Member_ID = '$searchInput' OR National_ID = '$searchInput'";
    $searchResult = mysqli_query($conn, $searchQuery);

    // Fetch the matching result
    $searchMember = mysqli_fetch_assoc($searchResult);
    if ($searchMember) {
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
        <link rel = "stylesheet" href = "memberdetailstyle.css">
        

    </head>
    <body>
        <div class="mem-page">
        <a href = "Login.php" class="home-button">Home</a>
            <h1>Member Details</u></h1>
            <!-- Search form -->
            <div class="search">
            <form method="GET" action="">
                <label for="searchInput">Search by:</label>
                <select name="searchBy">
                    <option value="Member_ID">Member ID</option>
                    <option value="National_ID">National ID</option>
                </select>
                <input type="text" id="searchInput" name="searchInput">
                <button type="submit" name="searchButton">Search</button>
            </form>
            </div>
            <br>
            <table id="Book">
                <tr>
                    <th>Member ID</th>
                    <th>National ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Profession</th>
                    
                    
                </tr>
                <?php if ($searchFound): ?>
                <!-- Display search result -->
                <?php foreach ($PersonArray as $Person): ?>
                        <?php if ($searchMember['National_ID'] == $Person['NationalID']): ?>
                <tr>
                    <td><?php echo $searchMember['Member_ID']; ?></td>
                    <td><?php echo $searchMember['National_ID']; ?></td>
                    <td><?php echo $Person['FIrstName']; ?></td>
                    <td><?php echo $Person['LastName']; ?></td>
                    <td><?php echo $Person['Address']; ?></td>
                    <td><?php echo $Person['ContactNumber']; ?></td>
                    <td><?php echo $Person['Email']; ?></td>
                    <td><?php echo $searchMember['Profession']; ?></td>
                </tr>
                <?php endif; ?>
                    <?php endforeach; ?>

                <?php else: ?>
                <?php foreach($MemberArray as $Member): ?>
                    <?php foreach ($PersonArray as $Person): ?>
                        <?php if ($Member['National_ID'] == $Person['NationalID']): ?>
                            <tr>
                                <td><?php echo $Member['Member_ID']; ?></td>
                                <td><?php echo $Member['National_ID']; ?></td>
                                <td><?php echo $Person['FIrstName']; ?></td>
                                <td><?php echo $Person['LastName']; ?></td>
                                <td><?php echo $Person['Address']; ?></td>
                                <td><?php echo $Person['ContactNumber']; ?></td>
                                <td><?php echo $Person['Email']; ?></td>
                                <td><?php echo $Member['Profession']; ?> </td>
                                
                                
                                
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php endif; ?>

            </table>
        </div>
    </body>
</html> 