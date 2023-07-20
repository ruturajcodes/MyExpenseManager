<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Expense Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="container my-5">
        <h2>List of Expenses</h2>
        <a href="/myexpenses/create.php" class="btn btn-primary mt-3 my-4">Add Expense</a>
        <br>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Expense Title</th>
                    <th>Expense Amount</th>
                    <th>Expense Details</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
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

                //Read all data from database
                $sql = "SELECT * from expensedata";
                $result = $connection->query($sql);
                
                //If failed to read data from database execute below statements
                if(!$result){
                    die("Invalid query: ".$connection->error);
                }

                //Read data from each row
                $srNo = 0;
                while($row = $result->fetch_assoc()){
                    //for retrieval, using the variable names as declared during database creation
                    $srNo = $srNo + 1;
                    echo "
                    <tr>
                    <th scope='row'>".$srNo."</th>    
                    <td>$row[title]</td>
                    <td>$row[expAmt]</td>
                    <td>$row[expDesc]</td>
                    <td>$row[tstamp]</td>
                    <td>
                        <a href='/myexpenses/edit.php?srNo=$row[srNo]' class='btn btn-primary btn-sm'>Edit</a>
                        <a href='/myexpenses/delete.php?srNo=$row[srNo]' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                    </tr>
                    ";
                }


                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function(){
      $('#myTable').DataTable();
    });
  </script>
</body>
</html>