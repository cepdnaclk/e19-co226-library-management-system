<!DOCTYPE html>
<html lang="en">
<head>
    <title>Member Page </title>
    <link rel="stylesheet" href="Memberstyle.css">
</head>
<body>
    <div class="welcome-page">
        <?php
            // Retrieve the name from the URL parameter
            $name = $_GET['name'];
            echo "<h1>Hi, " . htmlspecialchars($name) . "!</h1>";
        ?>
        <p>You have successfully logged in.
        Here, you can explore our extensive collection of books, journals, and resources.
        Feel free to browse, borrow, and return items using our user-friendly platform.
        Enjoy your reading and learning experience!</p>
        <button class="logout-btn"><a href="Login.php">Logout</a></button>
    </div>
</body>
</html>
