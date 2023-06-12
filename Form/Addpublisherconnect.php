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

$query1 = "SELECT Registration_No FROM Publisher ORDER BY Registration_No DESC LIMIT 1";
$result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_assoc($result1);

$lastRegNo = $row1['Registration_No'];
$numericPart1 = intval(substr($lastRegNo, 3));
$newNumericPart1 = $numericPart1 + 1; 
$formattedReg = 'PUB' . str_pad($newNumericPart1, 3, '0', STR_PAD_LEFT);

$query2 = "SELECT Email FROM Publisher ORDER BY Email DESC LIMIT 1";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);

$baseEmail = 'pub';
$domain = '@gmail.com';
$lastEmail = $row2['Email'];
$numericPart2 = intval(substr($lastEmail, 3, 3));
$newNumericPart2 = $numericPart2 + 1; 
$formattedemail = $baseEmail . str_pad($newNumericPart2, 3, '0', STR_PAD_LEFT) . $domain;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $name = $_POST['name'];

    $insertQuery = "INSERT INTO Publisher(Registration_No, Email, Address, Phone_number, Name)
                    VALUES
                    ('$formattedReg', '$formattedemail','$address', '$phone_number', '$name')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Data inserted successfully.<br>";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>