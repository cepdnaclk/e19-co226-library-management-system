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
    $isbn = $_POST['isbn'];
    $book_id = $_POST['book_id'];
    $publisher_id = $_POST['publisher_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $revceived_date = $_POST['revceived_date'];
    

    
    $insertQuery = "INSERT INTO Book(ISBN,Book_ID,Publisher_ID,Title,Received_date)
                    VALUES
                    ('$isbn', '$book_id', '$publisher_id', '$title', '$revceived_date')";
     $insertQuery_Count = "INSERT INTO BOOK_COUNT (Title, Now_available_qty, Total_qty)
     SELECT '$title', '0', '0'
     WHERE NOT EXISTS (
        SELECT 1
        FROM BOOK_COUNT
        WHERE Title = '$title'
     )";

    $updateQuery_now = "UPDATE book_count SET Now_available_qty = Now_available_qty + 1  WHERE Title = '$title' ";
    $updateQuery_total = "UPDATE book_count SET Total_qty = Total_qty + 1  WHERE Title = '$title' ";
    if (mysqli_query($conn, $insertQuery)) {
        //echo "Data inserted successfully.<br>";
    } else {
        //echo "Error inserting data: " . mysqli_error($conn);
    }
    if (mysqli_query($conn, $insertQuery_Count)) {
        //echo "New book add to the book table";
    } else {
        
    }
    if(mysqli_query($conn, $updateQuery_now) && mysqli_query($conn, $updateQuery_total)){
            //echo "Book quantity increased successfully.<br>";
    }else{
            //echo "Error updating book quantity: " . mysqli_error($conn) . "<br>";
            //echo "Error inserting data: " . mysqli_error($conn);
    }
    
    

    
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang = "en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title> Add Book</title>
        <link rel="stylesheet" href="style.css">
        <meta name = "viewport" content ="width=device-width,initial-scale=1.0">
    </head>
<body>
    <h1>Enter the book details here</h1>

    <form action="" method="POST">
        <p>ISBN: </p><input type = "text" name="isbn">
        <p>Book ID: </p><input type = "text" name="book_id">
        <p>Publisher ID: </p><input type = "text"name="publisher_id">
        <p>Title: </p><input type = "text"name="title" >
        <p>Received Date: </p><input type = "date"name="revceived_date">
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

