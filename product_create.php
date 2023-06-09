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
            <h1>Create Product</h1>
        </div>

        <!-- html form to create product will be here -->

        <?php

        if ($_POST) {

            // include database connection
            include 'config/database.php';
            try {
                // posted values
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                if (isset($_POST['category_name'])) $category_name = $_POST['category_name'];
                $price = floatval(htmlspecialchars(strip_tags($_POST['price']))); // Convert to float
                $promotion_price = floatval(htmlspecialchars(strip_tags($_POST['promotion_price'])));;
                $manufacture_date = htmlspecialchars(strip_tags($_POST['manufacture_date']));
                $expiry_date = htmlspecialchars(strip_tags($_POST['expiry_date']));

                $name = trim($_POST['name']);


                // Check if any field is empty
                if (empty($name)) {
                    $name_err = "Please fill out the Name field.";
                }
                if (empty($price)) {
                    $price_err = "Please fill out the Price field.";
                }
                if (empty($manufacture_date)) {
                    $manu_err = "Please fill out the Manufacture Date field.";
                }
                if (empty($category_name)) {
                    $category_err = "Please choose a category.";
                }
                if (empty($description)) { // check if description is empty
                    $description_err = "Description cannot be empty.";
                }

                // check if user fill up promotion price & must cheaper than original price 
                if (!empty($promotion_price)) {
                    if ($promotion_price >= $price) {
                        $promo_err = "Promotion price must be cheaper than original price";
                    }
                }


                // check if expiry date is later than manufacture date
                if (!empty($expiry_date)) {
                    if (strtotime($expiry_date) <= strtotime($manufacture_date)) {
                        $exp_err = "Expired date should be later than manufacture date";
                    }
                }

                // Set default values for non-required fields
                if (empty($promotion_price)) {
                    $promotion_price = 0;
                    $flag = false;
                }
                if (empty($expiry_date)) {
                    $expiry_date  = null;
                    $flag = false;
                }



                // check if there are any errors
                if (!isset($name_err) &&  !isset($price_err) && !isset($promo_err) && !isset($exp_err) && !isset($category_err) && !isset($description_err)) {

                    // insert query
                    $query = "INSERT INTO products SET name=:name, description=:description,category_name=:category_name, price=:price, promotion_price=:promotion_price, manufacture_date=:manufacture_date,expiry_date=:expiry_date,created=:created";
                    // prepare query for execution
                    $stmt = $con->prepare($query);
                    // bind the parameters
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':category_name', $category_name);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':promotion_price', $promotion_price);
                    $stmt->bindParam(':manufacture_date', $manufacture_date);
                    $stmt->bindParam(':expiry_date', $expiry_date);
                    // specify when this record was inserted to the database
                    $created = date('Y-m-d H:i:s');
                    $stmt->bindParam(':created', $created);
                    // Execute the query
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record was saved.</div>";
                        echo "<script>window.location.href = 'product_read.php';</script>";
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                }
            }

            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }





        ?>



        <!-- html form here where the product information will be entered -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' class="form-control" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" />
                        <?php if (isset($name_err)) { ?><span class="text-danger"><?php echo $name_err; ?></span><?php } ?></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td> <textarea class="form-control" name="description"><?php echo htmlspecialchars($description, ENT_QUOTES); ?></textarea>
                        <?php if (isset($description_err)) { ?><span class="text-danger"><?php echo $description_err; ?></span><?php } ?></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <?php
                        // include database connection
                        include 'config/database.php';

                        // select all categories
                        $query = "SELECT category_name FROM product_category";
                        $stmt = $con->prepare($query);
                        $stmt->execute();

                        // fetch the category list
                        $product_category = $stmt->fetchAll(PDO::FETCH_COLUMN);
                        ?>
                        <select name='category_name' class="form-control">
                            <option value=''>--Select Category--</option>
                            <?php foreach ($product_category as $category) { ?>
                                <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                            <?php } ?>
                        </select>
                        <?php if (isset($category_err)) { ?><span class="text-danger"><?php echo $category_err; ?></span><?php } ?>
                    </td>
                </tr>


                <tr>
                    <td>Price</td>
                    <td><input type='number' step='0.01' name='price' value='<?php echo htmlspecialchars($price); ?>' class='form-control' />
                        <?php if (isset($price_err)) { ?><span class="text-danger"><?php echo $price_err; ?></span><?php } ?></td>
                </tr>
                <tr>
                <tr>
                    <td>Promotion price</td>
                    <td><input type='number' step='0.01' name='promotion_price' value='<?php echo htmlspecialchars($promotion_price); ?>' class='form-control' />
                        <?php if (isset($promo_err)) { ?><span class="text-danger"><?php echo $promo_err; ?></span><?php } ?></td>
                </tr>
                <tr>
                <tr>
                    <td>Manufacture date</td>
                    <td><input type='date' name='manufacture_date' class='form-control' value="<?php echo isset($manufacture_date) ? htmlspecialchars($manufacture_date) : ''; ?>" />
                        <?php if (isset($manu_err)) { ?><span class="text-danger"><?php echo $manu_err; ?></span><?php } ?></td>
                </tr>
                <tr>
                    <td>Expiry date</td>
                    <td><input type='date' name='expiry_date' class='form-control' value="<?php echo isset($expiry_date) ? htmlspecialchars($expiry_date) : ''; ?>" />
                        <?php if (isset($exp_err)) { ?><span class="text-danger"><?php echo $exp_err; ?></span><?php } ?></td>
                </tr>


                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='product_read.php' class='btn btn-danger'>Back to read products</a>
                </td>
                </tr>
            </table>
        </form>


    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>