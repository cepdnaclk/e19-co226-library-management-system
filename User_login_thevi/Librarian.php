<!DOCTYPE html>
<html lang="en">
<head>
    <title>Librarian Page </title>
    <link rel="stylesheet" href="librarianstyle.css">
</head>
<body>
    <div class="Lib-page">
        <?php
             $host = "localhost";
             $user = "root";
             $password = "";
             $db = "LibraryManagementSystem";
             
             $conn = mysqli_connect($host,$user,$password);
             mysqli_select_db($conn,$db);
             // Retrieve the name from the URL parameter
             $name = $_GET['name'];
             echo "<h1>Hi, " . htmlspecialchars($name) . "!</h1>";
        ?>
        <p class="para-li">Thank you for logging into the library management system.
         As a librarian, you have access to a wide range of tools and features to efficiently manage the library's resources and assist library patrons.

        You can perform tasks such as adding new books, updating existing book records, managing borrower information,adding new members who are willing to join,
        handling book loans and returns, generating reports, and more.</p>
        <button class="logout-btn" onclick="location.href='../Form/Addbookconnect.php'">Add Book +</button><br/><br/>
        <button class="logout-btn" onclick="location.href='../Form/Addpersonconnect.php'">Add Member +</button><br/><br/>
        <button class="logout-btn" onclick="location.href='../Form/Addpublisherconnect.php'">Add Publisher +</button><br/><br/>
        <button class="logout-btn" onclick="location.href='../Form/Borrowbooksconnect.php'">Borrow book +</button><br/><br/>
        <button class="logout-btn" onclick="location.href='../Form/Returnbooksconnect.php'">Return book +</button><br/><br/>
        <button class="logout-btn" onclick="location.href='ShowBookDetails.php'">Show books -></button><br/><br/>
        <button class="logout-btn" onclick="location.href='Memberdetails.php'">Show member details -></button><br/><br/>

        <button class="logout-btn" onclick="location.href='../Form/Returnbooksconnect.php'">Show borrow details -></button><br/><br/>

        <button class="logout-btn"><a href="Login.php">Logout</a></button>
        
    </div>
</body>
</html>
