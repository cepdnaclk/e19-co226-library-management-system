<!DOCTYPE html>
<html lang="en">
<head>
    <title>Member Page </title>
    <link rel="stylesheet" href="Memberstyle.css">
</head>
<body>
    <div class="welcome-page">
        <?php
            $host = "localhost";
            $user = "root";
            $password = "";
            $db = "LibraryManagementSystem";
            
            $conn = mysqli_connect($host,$user,$password);
            mysqli_select_db($conn,$db);
            // Retrieve the name from the URL parameter
            $name = $_GET['name'];
            $memID = $_GET['memID'];
            echo "<h1>Hi, " . htmlspecialchars($name) . "!</h1>";

            $query_bor = "SELECT BORROWS.ISBN, BORROWS.Borrow_Date,BORROWS.Due_date, BORROWS.Return_Date, BOOK.Title FROM BORROWS JOIN BOOK ON BORROWS.ISBN = BOOK.ISBN WHERE Member_ID = $memID";
            $result_bor = mysqli_query($conn, $query_bor);

            

            // Check if any rows are returned

            $mem_Array = mysqli_fetch_all($result_bor,MYSQLI_ASSOC);
            mysqli_free_result($result_bor);

            if(isset($_POST['returnDate'])) {
                $returnDate = $_POST['returnDate'];

                // Fine calculation
                $today = date("Y-m-d");
                $fine = 0;
                          

                // Calculate the difference between return date and today
                $interval = date_diff(date_create($returnDate), date_create($today));

                if ($interval) {
                    $daysLate = $interval->format('%r%a');

                    // Calculate fine for each day
                    $finePerDay = 1; // Adjust this value as needed

                    if ($daysLate > 0) {
                        $fine += $daysLate * $finePerDay;
                    }
                }
                
                
            }
        ?>
        <p>You have successfully logged in.
        Here, you can explore our extensive collection of books, journals, and resources.
        Feel free to browse, borrow, and return items using our user-friendly platform.
        Enjoy your reading and learning experience!</p>
        <h3>Your Borrow Activity</h3>
        
        <table id="Member_borrow">
                <tr>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Borrow_Date</th>
                    <th>Due_Date</th>
                    <th>Return_Date</th>
                    
                </tr>
                <?php foreach($mem_Array as $mem): ?>
                <tr>
                    <td><?php echo $mem['Title']; ?></td>
                    <td><?php echo $mem['ISBN']; ?></td>
                    <td><?php echo $mem['Borrow_Date']; ?></td>
                    <td><?php echo $mem['Due_date']; ?></td>
                    <td><?php echo $mem['Return_Date']; ?> </td>
                    
                </tr>
                <?php endforeach; ?>

            </table>
            <br>
            <br>
            <form method="post" action="">
                <label for="returnDate" >Enter Return Date:</label>
                <input type="date" id="returnDate" name="returnDate" required>
                <input type="submit" name="submit" value="Calculate Fine">
            </form>

            <?php if(isset($_POST['returnDate'])): ?>
            <p>Your fine is: $<?php echo $fine; ?></p>
            <?php endif; ?>
        <button class="logout-btn"><a href="Login.php">Logout</a></button>
    </div>
</body>
</html>
