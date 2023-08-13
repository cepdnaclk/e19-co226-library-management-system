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

    // Initialize the error message variable
    //$error = "";

    // Login successful, retrieve user type from "librarian" or "member" table
    if ($result && mysqli_num_rows($result) == 1) {
        /*
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
            //header('location: http://localhost/e19-co226-library-management-system/User_login_thevi/Librarian.php');
            // Redirect the user to the welcome page and pass the name as a parameter in the URL
            header("Location: http://localhost/e19-co226-library-management-system/User_login_thevi/Librarian.php?name=" . urlencode($name));

            exit; // Add exit to stop further execution
        } elseif ($result_MEM && mysqli_num_rows($result_MEM) == 1) {
            // User is a member
            session_start();
            $_SESSION['auth'] = 'true';
            //header('location: http://localhost/e19-co226-library-management-system/User_login_thevi/Member.php');
            // Redirect the user to the welcome page and pass the name as a parameter in the URL
            header("Location: Member.php?name=" . urlencode($name) . "&memID=" . urlencode($memID));
            exit; // Add exit to stop further execution
        } else {
            // Invalid User Type
            $error = "Invalid User Type";
        }*/
        $query1 = "SELECT LastName FROM Person WHERE NationalID='$NIC' LIMIT 1";
        $query2 = "SELECT National_ID FROM Member WHERE National_ID='$NIC' LIMIT 1";
        $query_memid = "SELECT Member_ID FROM Member WHERE National_ID='$NIC' LIMIT 1";
        $query3="SELECT National_ID FROM Librarian WHERE National_ID='$NIC' LIMIT 1";
        $result1 = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);
        $result_mem = mysqli_query($conn, $query_memid);
        $result3 = mysqli_query($conn, $query3);
        
        if (mysqli_num_rows($result1) == 1 && mysqli_num_rows($result2) == 1) {
            // Retrieve the Member last name from the database
            $row = mysqli_fetch_assoc($result1);
            $name = $row['LastName'];
            $row1 = mysqli_fetch_assoc($result_mem);
            $memID = $row1['Member_ID'];

            // Redirect the user to the welcome page and pass the name as a parameter in the URL
            header("Location: http://localhost/e19-co226-library-management-system/User_login_thevi/Member.php?name=" . urlencode($name) . "&memID=" . urlencode($memID));

            exit();
        }else if(mysqli_num_rows($result1) == 1 && mysqli_num_rows($result3) == 1){
            // Retrieve the Librarian last name from the database
            $row = mysqli_fetch_assoc($result1);
            $name = $row['LastName'];

            // Redirect the user to the welcome page and pass the name as a parameter in the URL
            header("Location: http://localhost/e19-co226-library-management-system/User_login_thevi/Librarian.php?name=" . urlencode($name));
            exit();
        }
    } else {
        // Wrong Username or Password
        $error = "Wrong Username or Password";
        // Redirect back to Login.php with the error message as a URL parameter
        header('location: http://localhost/e19-co226-library-management-system/Login.php?error=' . urlencode($error));
        exit;
    }

    mysqli_close($conn);
}

?>
