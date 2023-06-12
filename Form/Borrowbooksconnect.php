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
    echo "Error using database: " .mysqli_error($conn);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $title = $_POST['title'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];

    $insertQuery = "INSERT INTO Borrows(Member_ID,Title,Borrow_Date,Return_Date)
                    VALUES
                    ('$member_id', '$title', '$borrow_date', '$return_date')";
    if (mysqli_query($conn, $insertQuery)) {
        echo "Data inserted successfully.<br>";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }

$updateQuery = "UPDATE book_count SET Now_available_qty = Now_available_qty - 1 WHERE Title = '$title'";
if (mysqli_query($conn, $updateQuery)) {
    echo "Book quantity reduced successfully.<br>";
} else {
    echo "Error updating book quantity: " . mysqli_error($conn) . "<br>";
}

}
mysqli_close($conn);
?>