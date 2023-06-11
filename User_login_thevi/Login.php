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
            $sql2 = "SELECT National_ID FROM Member WHERE National_ID='$NIC' LIMIT 1";
            $sql3="SELECT National_ID FROM Librarian WHERE National_ID='$NIC' LIMIT 1";
            $result1 = mysqli_query($conn, $sql1);
            $result2 = mysqli_query($conn, $sql2);
            $result3 = mysqli_query($conn, $sql3);
            
            if (mysqli_num_rows($result1) == 1 && mysqli_num_rows($result2) == 1) {
                // Retrieve the user's last name from the database
                $row = mysqli_fetch_assoc($result1);
                $name = $row['LastName'];

                // Redirect the user to the welcome page and pass the name as a parameter in the URL
                header("Location: Member.php?name=" . urlencode($name));
                exit();
            }else if(mysqli_num_rows($result1) == 1 && mysqli_num_rows($result3) == 1){
                // Retrieve the user's last name from the database
                $row = mysqli_fetch_assoc($result1);
                $name = $row['LastName'];

                // Redirect the user to the welcome page and pass the name as a parameter in the URL
                header("Location: Librarian.php?name=" . urlencode($name));
                exit();
            }
        } else {
            // Display an error message if the credentials are invalid
            echo "You have entered an incorrect password or username";
        }
    }


?>
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
                        <li><a href = "#">CONTACT</a></li>
                        <li><a href = "Books.php">BOOKS</a></li>
                    </ul>
                </div>
                <div class = "search">
                    <input class = "srch" type="search" name= "Search">
                    <a href = "#">
                        <button class="btn">Search</button>
                    </a>
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
                <!--p class = "par">

                    At our library, we believe in the power of knowledge and the joy of reading. With a vast collection of <br>books, journals, and resources, we strive to create an environment where  learning  and  imagination <br>
                    flourish.Our library serves as a gateway to a world of information, catering to diverse interests  and <br>fostering intellectual curiosity. Whether you're a student seeking academic resources, an avid reader<br> 
                    exploring new literary realms, or a professional looking to expand your knowledge,  we  have something <br>for everyone.With our user-friendly online platform, accessing our extensive  collection  has  never <br>
                    been easier.Browse through various categories, discover new releases, or search for specific titles to <br>find your next literary adventure. Our system ensures seamless borrowing and return processes,providing<br>
                    you with a hassle-free experience.
                </p-->
                 <!--button class = "cn"> <Contact>
                    <a href = "#">JOIN US</a>
                </button-->
            </div>

            <div class="form">
                <h2>Login Here</h2>
                <form method="POST" action="">
                    <input type="text" name="NIC" placeholder="NIC">
                    <input type="password" name="PASSWORD" placeholder="Password">
                    <button class="btnn" type="submit">Login</button>
                </form>
            </div>
        </div>
         <script src = "https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>  
            
    </body>

</html>

