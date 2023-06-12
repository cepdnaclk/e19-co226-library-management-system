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
$query = "SELECT Librarian_ID FROM Librarian ORDER BY Librarian_ID DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$lastLibrarianId = $row['Librarian_ID'];
$numericPart = intval(substr($lastLibrarianId, 2));
$newNumericPart = $numericPart + 1; 
$formattedId = 'L/' . str_pad($newNumericPart, 3, '0', STR_PAD_LEFT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nationalID = $_POST['national_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];

    $insertQuery = "INSERT INTO Person(NationalID, FirstName, LastName, Address, ContactNumber, Email)
                    VALUES
                    ('$nationalID', '$firstName', '$lastName', '$address', '$contactNumber', '$email')";

    $insertQuery1 = "INSERT INTO Librarian(Librarian_ID, National_ID)
                    VALUES
                    ('$formattedId','$nationalID')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Data inserted successfully.<br>";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
    if (mysqli_query($conn, $insertQuery1)) {
        echo "Data inserted successfully.<br>";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
