<?php
// include database connection
include 'config/database.php';

// select top 3 best sellers
$query = "SELECT p.name,SUM(od.quantity) as total_sold 
                            FROM orders o 
                            JOIN order_detail od ON o.order_id = od.order_id
                            JOIN products p ON od.product_id = p.product_id
                            GROUP BY 
                                p.name
                            ORDER BY 
                                total_sold DESC LIMIT 3";

$stmt = $con->prepare($query);
$stmt->execute();

// this is how to get number of rows returned
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    $best_sellers = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $best_sellers[] = $name;
    }

    // output the results
    echo "<ul>";
    foreach ($best_sellers as $product) {
        echo "<li>" . $product . "</li>";
    }
    echo "</ul>";
} else {
    echo "<div class='alert alert-danger'>No records found.</div>";
}
