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
    $title = $_POST['title'];
    $borrowDate = $_POST['borrow_date'];

    $deleteQuery = "DELETE FROM borrows WHERE Member_ID= '$memberId' AND Title = '$title' AND Borrow_Date = '$borrowDate'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "Borrow record deleted successfully.<br>";
        $updateQuery = "UPDATE book_count SET Now_available_qty = Now_available_qty + 1 WHERE Title = '$title'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "Book quantity updated successfully.<br>";
        } else {
            echo "Error updating book quantity: " . mysqli_error($conn) . "<br>";
        }
    } else {
        echo "Error deleting borrow record: " . mysqli_error($conn) . "<br>";
    }
} 
    
    mysqli_close($conn);
    ?>