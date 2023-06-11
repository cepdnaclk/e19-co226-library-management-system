<!DOCTYPE html>
<html lang="en">
<head>
    <title>Librarian Page </title>
    <link rel="stylesheet" href="librarian.css">
</head>
<body>
    <div class="Lib-page">
        <?php
            // Retrieve the name from the URL parameter
            $name = $_GET['name'];
            echo "<h1>Hi, " . htmlspecialchars($name) . "!</h1>";
        ?>
        <p class="para-li">Thank you for logging into the library management system.
         As a librarian, you have access to a wide range of tools and features to efficiently manage the library's resources and assist library patrons.

        You can perform tasks such as adding new books, updating existing book records, managing borrower information,adding new members who are willing to join,
        handling book loans and returns, generating reports, and more.</p>
        <button class="logout-btn"><a href="Login.php">Logout</a></button>
    </div>
</body>
</html>
