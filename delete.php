<?php
if(isset($_GET["srNo"])){
    $srNo = $_GET["srNo"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myexpense";

    //Creating the connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM expensedata WHERE `srNo` = $srNo";
    $connection->query($sql);
    
}

header("location: /myexpenses/index.php");
exit;

?>