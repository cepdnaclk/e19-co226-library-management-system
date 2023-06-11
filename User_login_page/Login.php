<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "LibraryManagementSystem";

    $conn = mysqli_connect($host,$user,$password);
    mysqli_select_db($conn,$db);
    if(isset($_POST['NIC'])){
        $NIC = $_POST['NIC'];
        $pw = $_POST['PASSWORD'];

        $sql="SELECT * FROM Users WHERE NationalID='".$NIC."'AND Password='".$pw."'limit 1";
        $result = mysqli_query($conn,$sql);
        
        
        if (mysqli_num_rows($result) == 1) {
            $sql1 = "SELECT LastName FROM Person WHERE NationalID='$NIC' LIMIT 1";
            $result1 = mysqli_query($conn, $sql1);
            
            if (mysqli_num_rows($result1) == 1) {
                // Retrieve the user's last name from the database
                $row = mysqli_fetch_assoc($result1);
                $name = $row['LastName'];

                // Redirect the user to the welcome page and pass the name as a parameter in the URL
                header("Location: welcome.php?name=" . urlencode($name));
                exit();
            }
        } else {
            // Display an error message if the credentials are invalid
            echo "You have entered an incorrect password or username";
        }
    }


?>