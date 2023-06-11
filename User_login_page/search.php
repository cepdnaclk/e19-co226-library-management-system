<?php

//$con = new PDO("mysql:host = localhost;dbname=draft1;port=3306;username= root; password = ");
$host = 'localhost';
$dbname = 'draft1';
$port = '3306';
$username = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;port=$port";
    $con = new PDO($dsn, $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
//if(isset($_POST["submit"])){
function search(){
    $str = $_POST["search"];
    $sth = $con->prepare("SELECT * FROM search WHERE Name = '$str'");
    
    $sth->setFetchMode(PDO::FETCH_OBJ);
    $sth->execute();
    
    if($row = $sth->fetch()){
        ?>
        <br><br><br>
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
            <tr>
                <td><?php echo $row->Name; ?></td>
                <td><?php echo $row->Description; ?></td>
            </tr>
        </table>
<?php
    }
        else{
            echo "Name does not exist";
        }
}

?>