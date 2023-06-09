<!DOCTYPE HTML>

<?php
session_start();
if (!isset($_SESSION["username"])) {
    // Set the warning message
    $_SESSION["warning"] = "You need to log in to access this page.";

    // Redirect the user to the login page
    header("Location: login.php");
    exit();
}
?>

<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->
</head>

<body>
    <?php include 'nav.php' ?>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Read Orders</h1>
        </div>

        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">

                <div class="col-md-6">
                    <?php echo "<a href='order_create.php' class='btn btn-primary m-b-1em'>Create New Order</a>"; ?>
                </div>
        </nav>


        <?php
        // include database connection
        include 'config/database.php';

        // select all data
        $query = "SELECT * FROM orders ORDER BY order_id DESC";


        $stmt = $con->prepare($query);
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();


        //check if more than 0 record found
        if ($num > 0) {

            echo "<table class='table table-hover table-responsive table-bordered'>"; //start table

            //creating our table heading
            echo "<tr>";
            echo "<th class='col-1'>Order ID</th>";
            echo "<th class='col-4'>Customer Name</th>";
            echo "<th class='col-3'>Order Date & Time</th>";
            echo "<th class='col-4'>Action</th>";
            echo "</tr>";

            // retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);
                // creating new table row per record
                echo "<tr>";
                echo "<td class='col-1'>{$order_id}</td>";
                echo "<td class='col-4'>{$username}</td>";
                echo "<td class='col-4'>{$created}</td>";
                echo "<td class='col-4'>";

                // read one record
                echo "<div class='button-group1'>";
                echo "<a href='order_read_one.php?order_id={$order_id}' class='btn btn-info btn-sm d-inline'>Read</a>&nbsp;";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }


            // end table
            echo "</table>";
        }
        // if no records found
        else {
            echo "<div class='alert alert-danger'>No records found.</div>";
        }

        ?>


    </div> <!-- end .container -->

    <!-- confirm delete record will be here -->

</body>

</html>