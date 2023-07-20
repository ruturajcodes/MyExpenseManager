<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "myexpense";

//Creating the connection
$connection = new mysqli($servername, $username, $password, $database);

//Connection check
if($connection->connect_error){
    die("Connection failed: ". $connection->connect_error );
}



$title = "";
$expAmt = "";
$expDesc = "";
$errorMessage = "";
$successMessage = "";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST["title"];
    $expAmt = $_POST["expAmt"];
    $expDesc = $_POST["expDesc"];

    do{
        if( empty($title) || empty($expAmt) || empty($expDesc)){
            $errorMessage = "All the fields are required!";
            break;
        }

        // Add new expense to database
        $sql = "INSERT INTO `expensedata` (`title`, `expDesc`, `expAmt`, `tstamp`) VALUES ('$title', '$expDesc', '$expAmt', now())";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query : ".$connection->error;
            break;
        }

        $title = "";
        $expAmt = "";
        $expDesc = "";

        $successMessage = "Expense added successfully!";

        header("location: /myexpenses/index.php");
        exit;

    }while(false);

    
    

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Expense Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Expense</h2>

        <?php
        if(!empty($errorMessage)){
            echo "
            <div class = 'alert alert-warning alert-dismissable fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>


        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="title" value="<?php echo $title?>">
                </div>    
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Expense amount</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="expAmt" value="<?php echo $expAmt?>">
                </div>    
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Expense details</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="expDesc" rows = "2" value="<?php echo $expDesc?>"></textarea>
                </div>    
            </div>

            <?php
            if(!empty($successMessage)){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissable fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button'  class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-2 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-2 d-grid">
                    <a class="btn btn-outline-primary" href="/myexpenses/index.php" role="button">Cancel</a>
                </div>    
            </div>

        </form>
    </div>


    
    
</body>
</html>