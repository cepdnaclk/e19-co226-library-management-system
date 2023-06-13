<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LibraryManagementSystem";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
$use_db = "USE LibraryManagementSystem";
if(!mysqli_query($conn,$use_db)){
    //echo "Error using database: " .mysqli_error($conn);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $isbn = $_POST['isbn'];
    $borrow_date = $_POST['borrow_date'];
    $due_date = $_POST['due_date'];

    $insertQuery = "INSERT INTO Borrows(Member_ID,ISBN,Borrow_Date,Due_date)
                    VALUES
                    ('$member_id', '$isbn', '$borrow_date', '$due_date')";
    if (mysqli_query($conn, $insertQuery)) {
        //echo "Data inserted successfully.<br>";
    } else {
        //echo "Error inserting data: " . mysqli_error($conn);
    }
    $get_booktitle = "SELECT Title FROM BOOK WHERE ISBN = '$isbn'";
    $get_booktitle_result = mysqli_query($conn, $get_booktitle);
    
    if ($get_booktitle_result) {
        $row = mysqli_fetch_assoc($get_booktitle_result);
        $booktitle = mysqli_real_escape_string($conn, $row['Title']);
    
        $updateQuery = "UPDATE book_count SET Now_available_qty = Now_available_qty - 1 WHERE Title = '$booktitle'";
        if (mysqli_query($conn, $updateQuery)) {
            //echo "Book quantity reduced successfully.<br>";
        } else {
            //echo "Error updating book quantity: " . mysqli_error($conn) . "<br>";
        }
    } else {
       // echo "Error retrieving book title: " . mysqli_error($conn) . "<br>";
    }

}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang = "en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title> Borrow Books</title>
        <link rel="stylesheet" href="style.css">
        <meta name = "viewport" content ="width=device-width,initial-scale=1.0">
    </head>
<body>
    <h1>Enter the details here</h1>
    <form action="" method="POST">
        <p>Member ID: </p><input type = "text" name="member_id">
        <p>ISBN: </p><input type = "text"name="isbn">
        <p>Borrow Date: </p><input type = "date"name="borrow_date">
        <p>Due Date: </p><input type = "date"name="due_date">
        <br><br>
        <input type ="Reset">
        <input type="Submit">
    </form>
</body>
</html>
