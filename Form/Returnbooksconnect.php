<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LibraryManagementSystem";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memberId = $_POST['member_id'];
    $isbn = $_POST['isbn'];
    $returnDate = $_POST['return_date'];
    $borrowDate= $_POST['borrow_date'];


    
    
    $get_booktitle = "SELECT Title FROM BOOK WHERE ISBN = '$isbn'";
    $get_booktitle_result = mysqli_query($conn, $get_booktitle);
    
    if ($get_booktitle_result) {
        $update_return_Query = "UPDATE Borrows SET Return_date = '$returnDate' WHERE Member_ID = '$memberId' AND ISBN = '$isbn' AND Borrow_Date = '$borrowDate'";
        if (mysqli_query($conn, $update_return_Query)) {
            //echo "Successfully added the return date.<br>";
        } else {
            //echo "Error updating book quantity: " . mysqli_error($conn) . "<br>";
        }
        $row = mysqli_fetch_assoc($get_booktitle_result);
        $booktitle = $row['Title'];
    
        $updateQuery = "UPDATE book_count SET Now_available_qty = Now_available_qty + 1 WHERE Title = '$booktitle' ";
        if (mysqli_query($conn, $updateQuery)) {
            //echo "Book quantity increased successfully.<br>";
        } else {
            //echo "Error updating book quantity: " . mysqli_error($conn) . "<br>";
        }
        
    } else {
        //echo "Error retrieving book title: " . mysqli_error($conn) . "<br>";
    }
    
} 
    
    mysqli_close($conn);
    ?>

<!DOCTYPE html>
<html lang = "en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title> Return Books</title>
        <link rel="stylesheet" href="formstyle.css">
        <meta name = "viewport" content ="width=device-width,initial-scale=1.0">
    </head>
<body>
    <h1>Enter the details here</h1>
    <form action="" method="POST">
        <p>Member ID: </p><input type = "text" name="member_id">
        <p>ISBN: </p><input type = "text"name="isbn">
        <p>Borrow Date: </p><input type = "date"name="borrow_date">
        <p>Return Date: </p><input type = "date"name="return_date">
        <br><br>
        <input type ="Reset">
        <input type="Submit">
    </form>
    <br/><br/>
    <button  onclick="goBack()">Back</button><br/><br/>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
