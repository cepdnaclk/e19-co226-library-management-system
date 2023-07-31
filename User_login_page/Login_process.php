<?php

if ($_POST) {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "librarymanagementsystem";

    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $NIC = $_POST['NIC'];
    $Password = $_POST['PASSWORD'];

    // Check login credentials in the "users" table
    $query = "SELECT * FROM users WHERE NationalID = '$NIC' AND Password = '$Password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // Login successful, retrieve user type from "librarian" or "member" table

        // Check if the user is a librarian
        $query_LIB = "SELECT * FROM librarian WHERE National_ID = '$NIC'";
        $result_LIB = mysqli_query($conn, $query_LIB);

        // Check if the user is a member
        $query_MEM = "SELECT * FROM member WHERE National_ID = '$NIC'";
        $result_MEM = mysqli_query($conn, $query_MEM);

        if ($result_LIB && mysqli_num_rows($result_LIB) == 1) {
            // User is a librarian
            session_start();
            $_SESSION['auth'] = 'true';
            header('location: http://localhost/e19-co226-library-management-system/User_login_thevi/Librarian.php');
            exit; // Add exit to stop further execution
        } elseif ($result_MEM && mysqli_num_rows($result_MEM) == 1) {
            // User is a member
            session_start();
            $_SESSION['auth'] = 'true';
            header('location: http://localhost/e19-co226-library-management-system/User_login_thevi/Member.php');
            exit; // Add exit to stop further execution
        } else {
            // Invalid User Type
            $error = "Invalid User Type";
        }
    } else {
        // Wrong Username or Password
        $error = "Wrong Username or Password";
    }

    mysqli_close($conn);
}

?>
