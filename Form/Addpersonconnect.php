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
    $nationalID = $_POST['national_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $profession =$_POST['profession'];

    $insertQuery = "INSERT INTO Person(NationalID, FirstName, LastName, Address, ContactNumber, Email)
                    VALUES
                    ('$nationalID', '$firstName', '$lastName', '$address', '$contactNumber', '$email')";

    $insertQuery1 = "INSERT INTO Member(National_ID,Profession)
                    VALUES
                    ('$nationalID','$profession')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Data inserted successfully.<br>";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
    if (mysqli_query($conn, $insertQuery1)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>







