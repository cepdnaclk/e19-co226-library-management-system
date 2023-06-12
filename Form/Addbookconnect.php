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
    $isbn = $_POST['isbn'];
    $book_id = $_POST['book_id'];
    $publisher_id = $_POST['publisher_id'];
    $now_avail_qty = $_POST['now_avail_qty'];
    $title = $_POST['title'];
    $revceived_date = $_POST['revceived_date'];
    $total_qty = $_POST['total_qty'];

    $insertQuery = "INSERT INTO Book(ISBN,Book_ID,Publisher_ID,Available_qty,Title,Received_date,Total_qty)
                    VALUES
                    ('$isbn', '$book_id', '$publisher_id', '$now_avail_qty', '$title', '$revceived_date','$total_qty')";
    if (mysqli_query($conn, $insertQuery)) {
        echo "Data inserted successfully.<br>";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
