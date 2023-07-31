<?php
$error = ""; // Initialize the $error variable
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main">
    <div class="navbar">
        <div class="icon">
            <img src="logo2.png" width="100" height="100">
        </div>
        <div class="menu">
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="about_us.html">ABOUT</a></li>
                <li><a href="Contact.html">CONTACT</a></li>
                <li><a href="Book.php">BOOKS</a></li>
            </ul>
        </div>
        <div class="search">
            <form action="search.php" method="POST" target="_blank">
                <input class="srch" type="search" name="search" placeholder="Search">
                <!--a href = "#">
                    <button class="btn">Search</button>
                </a-->
                <button class="btn">Search</button>
            </form>
            <!--script src = "search.php"></script-->
        </div>
    </div>
    <div class="content">
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
        <form action = "Login_process.php" method="POST">
            <input type="varchar" name="NIC" placeholder="NIC">
            <input type="password" name="PASSWORD" placeholder="Password">
            <button class="btnn" type="submit">Login</button>
            <div class="error">
                <?php echo $error ?>
            </div>
        </form>
    </div>
</div>
</body>
</html>

