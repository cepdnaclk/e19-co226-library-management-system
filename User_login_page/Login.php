<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>
            Library Management System
        </title>
        <link rel = "stylesheet" href = "style.css">
    </head>
    <body>
        <div class="main">
            <div class="navbar">

                <div class="icon">
                    <img src="logo2.png" width="100" height="100">
                </div>
                

                <div class="menu">
                    <ul>
                        <li><a href = "#">HOME</a></li>
                        <li><a href = "about_us.html">ABOUT</a></li>
                        <!--li><a href = "#"></a></li-->
                        <li><a href = "#">CONTACT</a></li>
                        <li><a href = "#">BOOKS</a></li>
                    </ul>
                </div>

                <div class = "search">
                    <form action="search.php" method="POST" target="_blank">
                        <input class = "srch" type="search" name= "search" placeholder="Search">
                        <!--a href = "#">
                            <button class="btn">Search</button>
                        </a-->
                        <button class="btn">Search</button>
                    </form>
                    <!--script src = "search.php"></script-->
                </div>

            </div>

            <div class = "content">
                <h1>Library <br> 
                    <span>Management</span><br>
                    System
                </h1>
                <br> 
                <br>
                <br>  
                <h2>Welcome !!!</h2>
                <br>
            </div>

            <div class="form">
                <h2>Login Here</h2>
                <form method = "POST">
                    <input type = "number" name = "NIC" placeholder="NIC">
                    <input type = "password" name = "PASSWORD" placeholder="Password">
                    <button class = "btnn" type="submit">Login</button>
                </form>
            </div>

        </div>

            
    </body>

</html>

<?php
if ($_POST)
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "auth";

    $NIC = $_POST['NIC'];
    $Password = $_POST['PASSWORD'];

    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM users WHERE User_Name = '$NIC' AND Passwords = '$Password'";

    $result = mysqli_query($conn, $query);
    if ($result) {
        if(mysqli_num_rows($result) == 1){
            session_start();
            $_SESSION['auth'] = 'true';
            header('location:about_us.html');
        }
        else{
            echo "wrong username or password";
        }
    } else {
        echo "Query execution failed: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

